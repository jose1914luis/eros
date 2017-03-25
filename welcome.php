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
        <a><h5 style="display: initial;"><b><?= $titulo ?></b></h5></a><br>   
        <a style="color: #337ab7;font-size: 12px;"><?= $datos['tipo'] . ' - ' . $datos['d_nombre'] . ' - ' . $datos['m_nombre'] ?></a>
    </div>
    <div style="padding: 5px 15px;" class="panel-body">
        <div style="text-align: center">                   
            <ul class="list-inline">
                <?php
                $poner_ = false;
                if (!empty($edad)){
                    echo '<li style="padding-top: 8px;"><a><b>Edad: ' . $edad . ' años</b></a></li>';
                    $poner_ = true;
                }
                if (!empty($altura)){
                    echo ($poner_)?' | ':'';
                    echo '<li style="padding-top: 8px;"><a><b>Altura: ' . $altura . ' cm</b></a></li>';
                    $poner_ = true;
                }
                    
                if (!empty($tarifa)){
                    echo ($poner_)?' | ':'';
                    echo '<li style="padding-top: 8px;"><a href="/0/0/0/' . $tarifa . '"><b>Tarifa: $' . $tarifa . '</b></a></li>';
                }
                    
                ?>
            </ul>

            <h5>
                <span style="padding: 5px 5px;" class="label label-danger">
                    <a href="/0/0/0/<?= $tel ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?= $tel ?></a>    
                </span>
            </h5>

        </div>

        <div><?= $texto ?></div>
        <br>

        <?php
        $img = $anuncio->getUrlImage($idanuncio, 0);

        echo '  <div>';
        if (is_array($img) || is_object($img)) {
            foreach ($img as $pos2 => $url) {

                echo '<div class="cont_img"><img class="render" src="' . substr($url['url'], 0) . '" alt="' . $tel . '" style=" height: auto;width: 100%;"></div>';
            }
        }
        ?>
    </div>
</div>
</div>

