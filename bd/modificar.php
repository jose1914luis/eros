<?php

if (empty($_POST)) {

    echo 0;
    return;
}

include_once 'Anuncio.php';

$operacion = filter_input(INPUT_POST, 'operacion');

session_start();
if (isset($_SESSION['user_session'])) {

    if ($operacion == 'delete') {

        eliminar();
    } else if ($operacion == 'republicar') {
        
        republicar();
    }
    
} else {
    
    echo 0;
}

function eliminar() {

    $id_anuncio = filter_input(INPUT_POST, 'id_anuncio');
    $anuncio = new Anuncio();
    $i = 0;
    $img = $anuncio->getUrlImage($id_anuncio, 0);
    $claves;
    foreach ($img as $pos2 => $url) {

        substr($url['url']);
        $claves = explode("/", $url['url']);
        unlink('/var/www/eros' . substr($url['url'], 2));
    }
    if (isset($claves)) {
        rmdir('/var/www/eros/upload/' . $claves[2]);
    }
    if ($_SESSION['tipo'] == 'admin') {

        $i = $anuncio->borrarAnuncio($id_anuncio, null);
    } else {

        $i = $anuncio->borrarAnuncio($id_anuncio, $_SESSION['user_session']);
    }
    echo $i;
}


function republicar() {

    $id_anuncio = filter_input(INPUT_POST, 'id_anuncio');
    $anuncio = new Anuncio();
    
    echo $anuncio->republicarAnuncio($id_anuncio);    
}