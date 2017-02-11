<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include './bd/Anuncio.php';

$anuncio = new Anuncio();
echo $anuncio->deleteDir('/var/www/eros/upload/31');