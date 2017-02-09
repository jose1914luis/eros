<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        resultados:
        <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        include './bd/Anuncio.php';

        $anuncio = new Anuncio();
        $result = $anuncio->insertAnuncio(1, 'blablabla', '$texto', null, '$email', '$tel', '$web', 1, 22, '$barrio');
        echo $result;
        ?>
    </body>
</html>
