<?php

//renderizar imagen sin javascrit
function whatermark_image($file1, $file2) {

    $stamp = imagecreatefrompng($file2);
    $im = imagecreatefromjpeg($file1);
    $marge_right = 10;
    $marge_bottom = 10;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);
    imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
    return $im;
}
?> 
<div>                          
    <script src="/js/funciones.min.js?v=<?= VERSION ?>" type="text/javascript"></script>
    <script src="/js/wellcome.js?v=<?= VERSION ?>" type="text/javascript"></script>
    <script src="/js/contenido.js?v=<?= VERSION ?>" type="text/javascript"></script>


    <b>
        <ol id="top_anuncio" class="color_a breadcrumb">
            <?php
            if (isset($parm1)) {
                echo '<li><a href="/"><span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span> Anuncios</a></li>';
                echo '<li><a href="/' . str_replace(' ', '-', $parm1) . '/"><h1 class="h1_mod">' . $parm1 . '</h1></a></li>';
                if (isset($parm2)) {
                    echo '<li><a href="/' . str_replace(' ', '-', $parm1) . '/' . str_replace(' ', '-', $parm2) . '/">' . $parm2 . '</a></li>';
                }
            } else {
                echo '<li><a href="/"><h1 class="h1_mod">Anuncios Eroticos Colombia</h1></a></li>';
            }
            ?>

        </ol>
    </b>   


</div>


<div class="full_row row">
    <div class="adsc">
        <!-- JuicyAds v3.0 -->
        <script async src="//adserver.juicyads.com/js/jads.js"></script>
        <ins id="598758" data-width="728" data-height="102"></ins>
        <script>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone': 598758});</script>
        <!--JuicyAds END-->
    </div>
    <div class="panel_movil col-xs-12 col-lg-12">

        <div itemprop="mainContentOfPage">            
            <?php
            $titulo = $datos['titulo'];
            $texto = $datos['texto'];
            $tel = $datos['tel'];
            $edad = $datos['edad'];
            $tarifa = $datos['tarifa'];
            $altura = $datos['altura'];
            $email = $datos['email'];
            $fecha_inicio = $datos['fecha_inicio'];
//            print_r($datos)
            ?>

            <div class="panel panel-danger">
                <div class="panel-heading">        
                    <a><h4 style="color: #333;display: initial;"><b><?= $titulo ?></b></h4></a><br>   
                    <ul class="list-inline">
                        <?php
                        $poner_ = false;
                        if (!empty($edad)) {
                            echo '<li style="padding-top: 8px;"><a>Edad: ' . $edad . ' años</li>';
                            $poner_ = true;
                        }
                        if (!empty($altura)) {
                            echo ($poner_) ? ' | ' : '';
                            echo '<li style="padding-top: 8px;"><a>Altura: ' . $altura . ' cm</li>';
                            $poner_ = true;
                        }

                        if (!empty($tarifa)) {
                            echo ($poner_) ? ' | ' : '';
                            echo '<li style="padding-top: 8px;"><a href="' . (isset($parm1) ? '/' . str_replace(' ', '-', $parm1) : '') . (isset($parm2) ? '/' . str_replace(' ', '-', $parm2) : '') . '/' . $tarifa . '">Tarifa: ' . $tarifa . '</a></li>';
                        }

                        if (!empty($fecha_inicio)) {
                            echo ($poner_) ? ' | ' : '';
                            echo '<li style="padding-top: 8px;">Fecha de publicación: ' . $fecha_inicio . '</li>';
                        }
                        ?>
                    </ul>

                    <?php if ($super) { ?>

                        <form class="form-inline">

                            <div class="form-group-sm">
                                <button type="button" onclick="eliminarAnuncio(<?= $idanuncio ?>)" class="btn btn-sm btn-danger" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </button>
                                <input type="number" min="1" max="3" class="form-control input-sm" id="promo" value="<?= $datos['promocion'] ?>"/>
                                <button type="button" onclick="promocion(<?= $idanuncio ?>, $('#promo').val())" class="btn btn-sm btn-primary" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                                </button>
                            </div>
                        </form>


                    <?php } ?>

                </div>
                <div style="padding: 5px 15px;" class="panel-body">
                    <div style="text-align: center">                   



                        <a class="btn btn-sm btn-social btn-reddit" href="<?= (isset($parm1) ? '/' . $parm1 : '') . (isset($parm2) ? '/' . $parm2 : '') . '/' . $tel ?>">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <?= $tel ?>
                        </a>

                        <a class="btn btn-sm btn-social btn-reddit" href="mailto:<?= $email ?>?Subject=Hola!" target="_top">
                            <i class="fa fa-envelope" aria-hidden="true"></i>Email
                        </a>

                        <a href="whatsapp://send?text=Hola!&phone=<?= '+57' . $tel ?>" class="fcolor wpp btn btn-sm btn-social btn-facebook">
                            <i class="fa fa-whatsapp"></i>WhatsApp
                        </a>                        


                    </div>

                    <div><?= $texto ?></div>
                    <br>

                    <?php
                    $img = $anuncio->getUrlImage($idanuncio, 0);


                    if (is_array($img) || is_object($img)) {
                        foreach ($img as $pos2 => $url) {

                            $ext = pathinfo($url['url'], PATHINFO_EXTENSION);

//                                echo substr($url['url'], 1);
                            $img2 = whatermark_image(substr($url['url'], 1), './pag_ima/pagina4.png') or null;

                            if (isset($img2)) {
                                ob_start();
                                imagejpeg($img2, null, 75);
                                $output = base64_encode(ob_get_contents());
                                ob_end_clean();
                                echo '<div class="cont_img"><img itemprop="logo" class="render" src="data:image/jpeg;base64,' . $output . '" alt="' . $tel . '"/></div>';
                            }
                            //echo '<div class="cont_img"><img class="render" src="' . substr($url['url'], 2) . '" alt="' . $tel . '"></div>';
                        }
                    }
                    ?>

                    <div class="col-xs-12 col-lg-12" style="text-align: center">
                        <br>
                        <div class="btn-group" role="group" aria-label="...">                                                                        
                            <!--<button type="button" class="btn btn-xs btn-primary">Compartir anuncio</button>-->                          
                            <button id="btn_ini" type="button" class="btn btn-xs btn-danger" onclick="window.location = '/denunciar/<?= $idanuncio ?>'" >Denunciar</button>
                        </div>
                    </div>  

                    <!--                    <b>Actualiza tu anuncio y obtener multiples beneficios:</b>
                                        <ol>
                                            <li>Aumenta la visión de tu publicidad.</li>    
                                            <li>Aumenta el número de clientes potenciales.</li>    
                                            <li>Tu anuncio permanecerá con nosotros 3 meses.</li>    
                                            <li>Re-publicaciones automaticas diarias.</li>    
                                        </ol>                    -->


                </div>
            </div>
        </div>

    </div>
</div>                                   