<script src="js/funciones.min.js" type="text/javascript"></script>
<script src="js/wellcome.js" type="text/javascript"></script>

<!--<script src="js/funciones.js?v=<?= time(); ?>" type="text/javascript"></script>
<script src="js/wellcome.js?v=<?= time(); ?>" type="text/javascript"></script>-->
<?php
include_once './bd/Anuncio.php';
include_once './bd/Correo.php';

$anuncio = new Anuncio();

$datos = $anuncio->getAnunciosxID($idanuncio);

$email = $datos['email'];
$primera = filter_input(INPUT_GET, 'primera');
if ($primera == 1) {

    validar_bienvenida($email);
    ?>


    <div id="div_alerta" role="alert" class="alert alert-success">
        <b>Genial!! Tu anuncio fue creado satisfactoriamente. </b> Revisa tu correo. Si eres nuevo, 
        debes activar tu cuenta para que administres tus anuncios. También se te envió información
        adicional para que puedas promover tu anuncio y obtener mejores resultados.   
    </div>

    <?php
}

$titulo = $datos['titulo'];
$texto = $datos['texto'];
$tel = $datos['tel'];
$edad = $datos['edad'];
$tarifa = $datos['tarifa'];
$altura = $datos['altura'];

echo '<div class="panel panel-danger">';
echo '<div class="panel-heading">';
echo '<a style="font-size: 10px;">' . $datos['tipo'] . ' - ' . $datos['d_nombre'] . ' - ' . $datos['m_nombre'] . '</a><br>';
echo '<b style="font-size: 18px;">' . $titulo . '</b><p></p>';
if (!empty($edad))
    echo '<span style="margin-right: 10px;" class="f_15 label label-primary">Edad <span class="fa fa-address-card-o" aria-hidden="true"> : </span>' . $edad . '</span>';
if (!empty($altura))
    echo '<span style="margin-right: 10px;" class="f_15 label label-primary">Altura <span class="fa fa-long-arrow-up" aria-hidden="true"> : </span>' . $altura . '</span>';
if (!empty($tarifa))
    echo '<span style="margin-right: 10px;" class="f_15 label label-primary">Tarifa <span class="fa fa-usd" aria-hidden="true"> : </span>' . $tarifa . '</span>';
if (!empty($tel))
    echo '<span style="margin-right: 10px;" class="f_15 label label-primary"><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> ' . $tel . '</span>';
echo ' <div class="btn-group pull-right">'
 . '<a style="margin-right: 10px;" class="f_15 label label-danger">Denunciar</a>'
 . '</div>';
echo '  </div>';
echo '  <div class="panel-body">';
echo '<div>' . $texto . '</div>';
echo '<br>';

$img = $anuncio->getUrlImage($idanuncio, 0);

echo '  <div>';
if (is_array($img) || is_object($img)) {
    foreach ($img as $pos2 => $url) {

        echo '<div class="cont_img"><img class="render" src="' . substr($url['url'], 1) . '" alt="' . $tel . '" style=""></div>';
    }
}
echo '  </div>';
echo '  </div>';
echo '</div>';

