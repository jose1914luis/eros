<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include './bd/GetDep.php';

$ClDep = new GetDep();
$tipo = $ClDep->obtenerTipoAnuncio();
$dep = $ClDep->obtenerDep();
?>

<meta name="viewport" content="width=device-width, initial-scale=0.7">

<link href="bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="css/general.css?v=<?= time(); ?>" rel="stylesheet" type="text/css"/>
<link href="css/w3.css?v=<?= time(); ?>" rel="stylesheet" type="text/css"/>
<script src="node_modules/jquery/dist/jquery.js" type="text/javascript"></script>
<script src="bootstrap-3.3.7-dist/js/bootstrap.js" type="text/javascript"></script>
<link href="css/bootstrap-social-gh-pages/bootstrap-social.css" rel="stylesheet" type="text/css"/>
<link href="css/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet" type="text/css"/>

<script src="js/index.js" type="text/javascript"></script>
<link rel="shortcut icon" href="pag_ima/fire.ico">
<script src="js/header.js?v=<?= time(); ?>" type="text/javascript"></script>

<header>




   
</header>