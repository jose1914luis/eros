<?php

session_start();
include_once './Usuario.php';

if (empty($_POST)) {

    echo 0;
    return;
}

$usuario = filter_input(INPUT_POST, 'usuario');
$contra = filter_input(INPUT_POST, 'contra');
$cerrar = filter_input(INPUT_POST, 'cerrar');

if ($cerrar == 1) {
    
    unset($_SESSION['user_session']);
    if(session_destroy()){
        echo 1;
    }else{
        echo 0;
    }
    
} else {

    $clusuario = new Usuario();
    echo $clusuario->validarUsuario($usuario, $contra);
}

