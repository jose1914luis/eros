<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('./mailin-api-php/V2.0/Mailin.php');
/*
 * This will initiate the API with the endpoint and your access key.
 *
 */
$mailin = new Mailin('jose1914luis@gmail.com','06rgqfk3mSAvG7LF');

/*
 * This will send a transactional email
 *
 */
/** Prepare variables for easy use **/ 

$data = array( "to" => array("jose1914luis@gmail.com"=>"to whom!"),
			"from" => array("noresponder@paginaerotica.com","from email!"),			
			"subject" => "My subject",
			"text" => "This is the text",
			"html" => "This is the <h1>HTML</h1>",
			"attachment" => array(),
			"headers" => array("Content-Type"=> "text/html; charset=iso-8859-1","X-param1"=> "value1", "X-param2"=> "value2","X-Mailin-custom"=>"my custom value", "X-Mailin-IP"=> "102.102.1.2", "X-Mailin-Tag" => "My tag")
);

var_dump($mailin->send_email($data));
