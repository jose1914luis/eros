<?php

include './bd/Anuncio.php';

$anuncio = new Anuncio();

$datos = $anuncio->getAnunciosxID($idanuncio);
$titulo = $datos['titulo'];
$texto = $datos['texto'];
$tel = $datos['tel'];
$edad = $datos['edad'];
$tarifa = $datos['tarifa'];
$altura = $datos['altura'];

echo '<div class="panel panel-warning" style="width: 1000px;">';
echo '  <div class="panel-heading">';
echo '    <h3 class="panel-title">' . $titulo . '</h3>';
echo '<b>Edad: </b>' . $edad . '<br>';
echo '<b>Altura: </b>' . $altura . '<br>';
echo '<b>Tarifa minima: </b>' . $tarifa . '<br>';
echo '<b>Tel: </b>' . $tel . '<br>';
echo '  </div>';
echo '  <div class="panel-body">';
echo $texto;
$img = $anuncio->getUrlImage($idanuncio);
foreach ($img as $pos2 => $url) {
    echo '<img src="' . substr($url['url'], 1) . '" alt="..." style="" width="200px" height="250px">';
}
echo '  </div>';
echo '</div>';

