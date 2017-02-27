
<!--<link href="css/general.min.css?v=<?= time(); ?>" rel="stylesheet" type="text/css"/>-->
<!--<link href="css/w3.css?v=<?= time(); ?>" rel="stylesheet" type="text/css"/>-->
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include './bd/Usuario.php';

$usuario = new Usuario();

print_r($usuario->validarUsuario('admin', ''));