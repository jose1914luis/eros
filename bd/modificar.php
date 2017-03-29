<?php

if (empty($_POST)) {

    echo 0;
    return;
}

include_once 'Anuncio.php';

$operacion = filter_input(INPUT_POST, 'operacion');

session_start();
$usr = $_SESSION['user_session'];
if (isset($_SESSION['user_session'])) {

    if ($operacion == 'delete') {

        eliminar($_SESSION['tipo'], $usr);
    } else if ($operacion == 'republicar') {

        republicar();
    }
} else {

    echo 0;
}

function eliminar($tipo, $usuario) {

//    echo $usuario;
    $id_anuncio = filter_input(INPUT_POST, 'id_anuncio');
    $i = 0;
    if (isset($id_anuncio)) {
        $anuncio = new Anuncio();

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
        if ($tipo == 'admin') {
            
            $i = $anuncio->borrarAnuncio($id_anuncio, null);
        } else {
            
            $i = $anuncio->borrarAnuncio($id_anuncio, $usuario);
        }
    }
    echo $i;
}

function republicar() {

    $id_anuncio = filter_input(INPUT_POST, 'id_anuncio');
    $anuncio = new Anuncio();

    echo $anuncio->republicarAnuncio($id_anuncio);
}
