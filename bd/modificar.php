<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (empty($_POST)) {

    echo 0;
    return;
}

include_once 'Anuncio.php';

$operacion = filter_input(INPUT_POST, 'operacion');
$id_anuncio = filter_input(INPUT_POST, 'id_anuncio');
$anuncio = new Anuncio();

session_start();
$usr = $_SESSION['user_session'];
if (isset($_SESSION['user_session'])) {

    if ($operacion == 'delete') {


        if (isset($id_anuncio)) {


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

                $i = $anuncio->borrarAnuncio($id_anuncio, $usr);
            }
        }
        echo $i;
    } else if ($operacion == 'republicar') {

        echo $anuncio->republicarAnuncio($id_anuncio);
    } else if ($operacion == 'promocion') {

        $promo = filter_input(INPUT_POST, 'promo');
        echo $anuncio->promocion($id_anuncio, $promo);
    }
} else {

    echo 0;
}

