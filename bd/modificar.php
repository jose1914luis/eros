<?php

if (empty($_POST)) {

    echo 0;
    return;
}

include_once 'Anuncio.php';
$id_anuncio = filter_input(INPUT_POST, 'id_anuncio');
$anuncio = new Anuncio();
session_start();
if (isset($_SESSION['user_session'])) {

    $i =  0;
    if ($_SESSION['tipo'] == 'admin') {        
        
        $i = $anuncio->borrarAnuncio($id_anuncio, null);
    }else{
        
        $i = $anuncio->borrarAnuncio($id_anuncio, $_SESSION['user_session']);                                
    }
    echo $i;
} else {
    echo 0;
}
