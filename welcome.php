<script src="/js/funciones.min.js" type="text/javascript"></script>
<script src="/js/wellcome.js" type="text/javascript"></script>

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
?>

<div class="panel panel-danger">
    <div class="panel-heading">        
        <a><h2 style="font-size: 18px; color: #03b;display: initial;"><b><?= $titulo ?></b></h2></a>

        <ul class="list-inline">
            <?php
            if (!empty($edad))
                echo '<li style="padding-top: 8px;"><span style="margin-right: 10px;" class="f_15 label label-primary">Edad: ' . $edad . '</span></li>';
            if (!empty($altura))
                echo '<li style="padding-top: 8px;"><span style="margin-right: 10px;" class="f_15 label label-primary">Altura: ' . $altura . '</span></li>';
            if (!empty($tarifa))
                echo '<li style="padding-top: 8px;"><span style="margin-right: 10px;" class="f_15 label label-primary">Tarifa: ' . $tarifa . '</span></li>';
            if (!empty($tel))
                echo '<li style="padding-top: 8px;"><span style="margin-right: 10px;" class="f_15 label label-primary"><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> ' . $tel . '</span></li>';
            ?>

        </ul>
    </div>
    <div class="panel-body">
        <a style="font-size: 10px;"><?= $datos['tipo'] . ' - ' . $datos['d_nombre'] . ' - ' . $datos['m_nombre'] ?></a><br>
        <div><?= $texto ?></div>
        <br>

        <?php
        $img = $anuncio->getUrlImage($idanuncio, 0);

        echo '  <div>';
        if (is_array($img) || is_object($img)) {
            foreach ($img as $pos2 => $url) {

                echo '<div class="cont_img"><img class="render" src="' . substr($url['url'], 0) . '" alt="' . $tel . '" style=""></div>';
            }
        }
        ?>
    </div>
</div>
</div>

