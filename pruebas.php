<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function resize_image($file, $w, $h, $ext) {
    list($width, $height) = getimagesize($file);
    $dst = '';

    if ($width > 0) {

        $r = $width / $height;

        if ($w / $h > $r) {
            $newwidth = $h * $r;
            $newheight = $h;
        } else {
            $newheight = $w / $r;
            $newwidth = $w;
        }

        $src = '';
        if ($ext == 'png') {
            $src = imagecreatefrompng($file);
        } else if ($ext == 'jpg') {

            $src = imagecreatefromjpeg($file);
        }

        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    }
 

    

    return $dst;
}
//
header('Content-Type: image/png');
imagepng(resize_image('upload/169/imagen1.png', 190, 210, 'png'), null, 9);
?>
<!--<img src="upload/169/imagen1.png" alt=""/>-->