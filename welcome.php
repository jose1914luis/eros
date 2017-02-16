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
echo '<div class="panel-heading">';
echo '<span style="font-size: 10px;">' . $datos['tipo'] . ' - ' . $datos['d_nombre'] . ' - ' . $datos['m_nombre'] . '</span><br>';
echo '<b style="font-size: 18px;">' . $titulo . '</b><br><p></p>';
if (!empty($edad))
    echo '<span style="margin-right: 10px;" class="f_15 label label-primary">Edad <span class="glyphicon glyphicon-hourglass" aria-hidden="true">: </span>' . $edad . '</span>';
if (!empty($altura))
    echo '<span style="margin-right: 10px;" class="f_15 label label-primary">Altura <span class="glyphicon glyphicon-resize-vertical" aria-hidden="true">: </span>' . $altura . '</span>';
if (!empty($tarifa))
    echo '<span style="margin-right: 10px;" class="f_15 label label-primary">Tarifa <span class="glyphicon glyphicon-usd" aria-hidden="true">: </span>' . $tarifa . '</span>';
if (!empty($tel))
    echo '<span style="margin-right: 10px;" class="f_15 label label-primary">Tel <span class="glyphicon glyphicon-phone" aria-hidden="true">: </span>' . $tel . '</span>';

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

