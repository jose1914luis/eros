<?php

require_once './bd/Correo.php';

$correo = new Correo();
$correo->bienvenida('importa2colombia@gmail.com', '1234');
//

$response = $correo->enviar();
echo $response->statusCode();
echo $response->headers();
echo $response->body();