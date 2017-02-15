<script src="js/funciones.js?v=<?= time(); ?>" type="text/javascript"></script>
<script src="js/wellcome.js?v=<?= time(); ?>" type="text/javascript"></script>
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
if (!empty($edad))
    echo '<b class="f_15">Edad: </b>' . $edad. '<br>';
if (!empty($altura))
    echo '<b class="f_15">Altura: </b>' . $altura . '<br>';
if (!empty($tarifa))
    echo '<b class="f_15">Tarifa minima: </b>' . $tarifa . '<br>';
if (!empty($tel))
    echo '<b class="f_15">Tel: </b>' .$tel. '<br>';

echo '  </div>';
echo '  <div class="panel-body">';
echo $texto;

$img = $anuncio->getUrlImage($idanuncio);

if (is_array($img) || is_object($img)) {
    foreach ($img as $pos2 => $url) {

        echo '<div class="cont_img"><img class="render" src="' . substr($url['url'], 1) . '" alt="..." style=""></div>';
    }
}

echo '  </div>';
echo '</div>';

