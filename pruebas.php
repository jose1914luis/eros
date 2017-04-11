<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'bd/Correo.php';
require 'bd/Usuario.php';
require 'bd/Anuncio.php';

$anuncio = new Anuncio();

$total = $anuncio->total_email('admin@paginaerotica.com');

$usuarioEros = new Usuario();
$correo = new Correo();
$datos = $usuarioEros->getUsuariobyEmail('admin@paginaerotica.com');
echo $datos['contra'];
echo $datos['email'];


/* Primera ves que publica un anuncio */
try {
    print_r($correo->bienvenida($datos['email'], $datos['contra']));
        $correo->enviar();
} catch (Exception $ex) {

    echo $ex;
}

