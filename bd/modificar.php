<?php

if (empty($_POST)) {

    echo 0;
    return;
}

include_once 'Anuncio.php';
$id_anuncio = filter_input(INPUT_POST, 'id_anuncio');
$anuncio = new Anuncio();

if ($anuncio->borrarAnuncio($id_anuncio) == 1){
    
    echo 1;
}else{
    echo 0;
}