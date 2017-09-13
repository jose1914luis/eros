# -*- coding: utf-8 -*-
# coding: utf-8
#! /usr/bin/env python
""" 
    Copyright (C) 2007-2009 Vladimir Toncar

    Contributors:
        Redirect handling by Pavel "ShadoW" Dvorak

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

"""

import os.path
import sys
import string
import getopt
import urllib2
import urlparse
from HTMLParser import HTMLParser
from HTMLParser import HTMLParseError
import xml.sax.saxutils
import robotparser
import re
import httplib


helpText = """sitemap_gen.py version 1.1.0 (2009-09-05)

This script crawls a web site from a given starting URL and generates
a Sitemap file in the format that is accepted by Google. The crawler
does not follow links to other web sites. It also respects the 'nofollow'
tags and will not crawl into directories disallowed in the robots.txt file.

Command line syntax:

python sitemap_gen.py <options> <starting URL>

Available options:
-h         --help                Print this text and exit

-b <ext>   --block <ext>         Exclude URLs with the given extension;
                                 <ext> must be without the leading dot.
                                 The comparison is case insensitive, so
                                 for example DOC and doc are treated
                                 the same. You can use this option several
                                 times to block several extensions.
                                 
-c <value> --changefreq <value>  Set the change frequency. The given value
                                 is used in all sitemap entries (maybe a
                                 future version of this script will change
                                 that). The allowed values are: always,
                                 hourly, daily, weekly, monthly, yearly,
                                 never.
                                 
-p <prio>  --priority <prio>     Set the priority. The value must be from
                                 the interval between 0.0 and 1.0. The value
                                 will be used in all sitemap entries.
                                 
-m <value> --max-urls <value>    Set the maximum number of URLs to be crawled.
                                 The default value is 1000 and the largest
                                 value that you can set is 50000 (the script
                                 generates only a single sitemap file).
                                 
-o <file>  --output-file <file>  Set the name of the geneated sitemap file.
                                 The default file name is sitemap.xml.

Usage example:
python sitemap_gen.py -b doc -b bmp -o test_sitemap.xml http://www.your-site-name.com/index.html

For more information, visit http://toncar.cz/opensource/sitemap_gen.html

"""

allowedChangefreq = ["always", "hourly", "daily", "weekly", \
                     "monthly", "yearly", "never"]

def getPage(url):
    chek = "http://www.sigmin.co/mineral/ARENAS-Y-GRAVAS-SILÍCEAS-ELABORADAS-(TRITURADAS,-MOLIDAS-O-PULVERIZADAS).-MINERALES-DE-METALES-PRECIOSOS-Y-SUS-CONCENTRADOS."
    if url.encode('utf8') ==  chek:
        print 'url utf8->>>', url
    if url ==  chek:
        print 'url->>>', url
    try:
        f = urllib2.urlopen(url)
        page = ""
        if url ==  chek:
            print 'file---->' , f
        for i in f.readlines():
            page += i
        date = f.info().getdate('Last-Modified')
        if date == None:
            date = (0, 0, 0)
        else:
            date = date[:3]
        f.close()
        return (page, date, f.url)
    except urllib2.URLError, detail:
        print "%s. Skipping..." % (detail)
        return (None, (0,0,0), "")
#end def


def joinUrls(baseUrl, newUrl):
	helpUrl, fragment = urlparse.urldefrag(newUrl)
        return urlparse.urljoin(baseUrl, helpUrl)
#end def


def getRobotParser(startUrl):
	rp = robotparser.RobotFileParser()
	
	robotUrl = urlparse.urljoin(startUrl, "/robots.txt")
	page, date, url = getPage(robotUrl)

	if page == None:
	    print "Could not read ROBOTS.TXT at:", robotUrl
	    return None
	#end if

	rp.parse(page)
	print "Found ROBOTS.TXT at:", robotUrl
	return rp
#end def


class MyHTMLParser(HTMLParser):

    def __init__(self, pageMap, redirects, baseUrl, maxUrls, blockExtensions, robotParser):
        HTMLParser.__init__(self)
        self.pageMap = pageMap
	self.redirects = redirects
        self.baseUrl = baseUrl
        self.server = urlparse.urlsplit(baseUrl)[1] # netloc in python 2.5
        self.maxUrls = maxUrls
        self.blockExtensions = blockExtensions
	self.robotParser = robotParser
    #end def

    def hasBlockedExtension(self, url):
        p = urlparse.urlparse(url)
        path = p[2].upper() # path attribute
        # In python 2.5, endswith() also accepts a tuple,
        # but let's make it backwards compatible
        for i in self.blockExtensions:
            if path.endswith(i):
                return 1
        return 0
    #end def        

    def handle_starttag(self, tag, attrs):
        if len(self.pageMap) >= self.maxUrls:
            return
        
        if (tag.upper() == "BASE"):
	    if (attrs[0][0].upper() == "HREF"):
		self.baseUrl = joinUrls(self.baseUrl, attrs[0][1])
		print "BASE URL set to", self.baseUrl

        if (tag.upper() == "A"):
	    #print "Attrs:", attrs
            url = ""
            # Let's scan the list of tag's attributes
	    for attr in attrs:
                #print "  attr:", attr
                if (attr[0].upper() == "REL") and (attr[1].upper().find('NOFOLLOW') != -1):
                    # We have discovered a nofollow, so we won't continue
                    return  
                elif (attr[0].upper() == "HREF") and (attr[1].upper().find('MAILTO:') == -1):
                    # We have discovered a link that is not a Mailto:
                    url = joinUrls(self.baseUrl, attr[1])
            #end for
            # if the url is empty, there was none in the list of attributes
            if url == "": return
            
            # Check if we want to follow the link
            if urlparse.urlsplit(url.encode('utf8'))[1] <> self.server:                
                return
            if self.hasBlockedExtension(url.encode('utf8')) or self.redirects.count(url.encode('utf8')) > 0:            
                return
            if (self.robotParser <> None) and not(self.robotParser.can_fetch("*", url.encode('utf8'))):
                print "URL restricted by ROBOTS.TXT: ", url
                return
            # It's OK to add url to the map and fetch it later
            if not(self.pageMap.has_key(url)):                
                self.pageMap[url] = ()
        #end if
	    
    #end def
#end class

def getUrlToProcess(pageMap):
    for i in pageMap.keys():
        if pageMap[i] == ():
            return i
    return None

def parsePages(startUrl, maxUrls, blockExtensions):
    pageMap = {}
    pageMap[startUrl] = ()
    redirects = []

    robotParser = getRobotParser(startUrl.encode('utf8'))

    while True:
        url = getUrlToProcess(pageMap).encode('utf8')
        if url == None:
            break            
        print " ", url
        page, date, newUrl = getPage(url)#genera error al mandar url con signos de puntuacion       
        if page == None:
            del pageMap[url.encode('utf8')]
	elif url != newUrl:
	    print "Redirect -> " + newUrl
            del pageMap[url]
	    pageMap[newUrl] = ()
	    redirects.append(url)
        else:
            #aca siempre entra para trer la pagina
            pageMap[url] = date
            parser = MyHTMLParser(pageMap, redirects, url, maxUrls, blockExtensions, robotParser)
            try:
                parser.feed(page)
                parser.close()
            except HTMLParseError:
                print "Error parsing %s, skipping." % (url)
            except UnicodeDecodeError:
                print "Failed decoding %s . Try to check if the page is valid." % (url)
    #end while

    return pageMap
#end def


def generateSitemapFile(pageMap, fileName, changefreq="", priority=0.0):
    fw = open(fileName, "wt")
    fw.write('''<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">\n''')
    for i in pageMap.keys():
        fw.write('<url>\n  <loc>%s</loc>\n' % (xml.sax.saxutils.escape(i)))
        uri = xml.sax.saxutils.escape(i)             
        if pageMap[i] not in [(), (0,0,0)]:
            fw.write('  <lastmod>%4d-%02d-%02d</lastmod>\n' % pageMap[i])
        if changefreq <> "":
             if uri.count('/') == 7:
                fw.write('  <changefreq>%s</changefreq>\n' % ('monthly'))
             else:
                fw.write('  <changefreq>%s</changefreq>\n' % (changefreq))
                #fw.write('  <changefreq>%s</changefreq>\n' % ('weekly'))
        if priority > 0.0:
            if uri.count('/') == 3:
                fw.write('  <priority>%1.1f</priority>\n' % (1.0))                            
            elif uri.count('/') == 5:
                fw.write('  <priority>%1.1f</priority>\n' % (0.8))
            elif uri.count('/') == 6:
                fw.write('  <priority>%1.1f</priority>\n' % (0.7))
            elif uri[29:] == 'Escorts/' or uri[29:] == 'Web Cam/' or uri[29:] == 'Gigolo/'  or uri[29:] == 'Gays/'  or uri[29:] == 'Masajes-Eroticos/' or uri[29:] == 'Travestis/':
                fw.write('  <priority>%1.1f</priority>\n' % (0.9))
            else:
                fw.write('  <priority>%1.1f</priority>\n' % (0.6))
                #fw.write('  <priority>%1.1f</priority>\n' % (priority))
        fw.write('</url>\n')
    #end for
    fw.write('</urlset>')
    fw.close()
#end def
        


def main():
    try:
        opts, args = getopt.getopt(sys.argv[1:],\
                "hb:c:m:p:o:", \
                ["help", "block=", "changefreq=", \
                 "max-urls=", "priority=", "output-file="])
    except getopt.GetoptError:
        print helpText
        return

    blockExtensions = []
    changefreq = ""
    priority = 0.0
    fileName = "sitemap.xml"
    maxUrls = 1000
    pageMap = {}

    for opt,arg in opts:
        if opt in ("-h", "--help"):
            print helpText
            return
        elif opt in ("-b", "--block"):
            blockExtensions.append("." + arg.upper())
        elif opt in ("-c", "--changefreq"):
            if arg in allowedChangefreq:
                changefreq = arg
            else:
                print "Allowed changefreq values are:"
                for i in allowedChangefreq:
                    print i
                print
                return
        elif opt in ("-m", "--max-urls"):
            maxUrls = int(arg)
            if (maxUrls < 0) or (maxUrls > 50000):
                print "The maximum number of URLs must be greater than 0 and smaller than 50000"
                return
        elif opt in ("-p", "--priority"):
            priority = float(arg)
            if (priority < 0.0) or (priority > 1.0):
                print "Priority must be between 0.0 and 1.0"
                return
        elif opt in ("-o", "--output-file"):
            fileName = arg
            if fileName in ("", ".", ".."):
                print "Please provide a sensible file name"
                return
        #end if
        
    if len(args) == 0:
        print "You must provide the starting URL.\nTry the -h option for help."
        return

    # Set user agent string
    opener = urllib2.build_opener()
    opener.addheaders = [('User-agent', 'sitemap_gen/1.0')]
    urllib2.install_opener(opener)

    # Start processing
    print "Crawling the site..."
    pageMap = parsePages(args[0], maxUrls, blockExtensions)
    print "Generating sitemap: %d URLs" % (len(pageMap))
    generateSitemapFile(pageMap, fileName, changefreq, priority)
    print "Finished."
#end def

if __name__ == '__main__': main()
