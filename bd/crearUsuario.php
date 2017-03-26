<?php

require_once 'Usuario.php';
if (!empty($_POST)) {


    $nombre = filter_input(INPUT_POST, 'nombre');
    $apellidos = filter_input(INPUT_POST, 'apellidos');
    $cel = filter_input(INPUT_POST, 'cel');
    $email = filter_input(INPUT_POST, 'correo');
    $usuario = filter_input(INPUT_POST, 'email');
    $contra = filter_input(INPUT_POST, 'contra');
    $tipo = 'usr';

    $CLusuario = new Usuario();

    echo $CLusuario->insertarUsuario($nombre, $apellidos, $cel, $email, $usuario, $contra, $tipo);
    
}else{
    
    echo 0;
}