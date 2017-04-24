<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//************Valido si el usuario ingreso
$super = 0;
$salir = 0;
$idusuario = null;
if (isset($_SESSION['user_session'])) {
    $idusuario = $_SESSION['user_session'];
    $salir = 1;
    if ($_SESSION['tipo'] == 'admin') {

        $super = 1;
    }
}
//***************************************

//variables globales.
define("LIMIT", 50);
define("LIMIT_IMG", 5);
define("VERSION", 9);