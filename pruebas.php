<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include './bd/Anuncio.php';

$anuncio = new Anuncio();

print_r($anuncio->construirWhere(1, null, null, 1));
