<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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