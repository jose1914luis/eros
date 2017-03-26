<?php

include 'bd/Anuncio.php';
$anuncio = new Anuncio();
$img = $anuncio->getUrlImage(99, 0);
foreach ($img as $pos2 => $url) {

    echo $url['url'];
    rmdir(substr($url['url'], 0));
    rmdir('var/www/eros/upload/99');
}