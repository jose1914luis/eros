<?php

error_reporting(-1);
ini_set('display_errors', 'On');

require './bd/Usuario.php';

$usuario = new Usuario();

echo $usuario->insertarUsuario('abc', 'apll', 'cel', 'email6', 'email6', 'contra', 'usr6');