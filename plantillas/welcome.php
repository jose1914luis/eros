<?php
if (isset($_POST)) {
    $enviar = filter_input(INPUT_POST, 'correo');
    if (isset($enviar)) {
        include_once 'bd/Correo.php';
        $correo = new Correo();
        $correo->pagoinfo($enviar);
        $correo->enviar();
    }
}

//renderizar imagen sin javascrit
function whatermark_image($file1, $file2, $tel) {

    $stamp = imagecreatefrompng($file2);
    $im = imagecreatefromjpeg($file1);
    $marge_right = 10;
    $marge_bottom = 10;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);
    imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
    //imagecopy($im, $stamp, (imagesx($im)- $sx)/2, imagesy($im)/2 - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
    imagecopy($im, $stamp, 10, 10, 0, 0, imagesx($stamp), imagesy($stamp));
    if (isset($tel)) {

// Replace path by your own font path
        $font = '/var/www/eros/font-awesome-4.7.0/fonts/ComicRelief.ttf';
//        $imagetobewatermark = imagecreatefrompng("images/muggu.png");
        $watermarktext = $tel;
        $fontsize = "25";
        $white = imagecolorallocate($im, 230, 33, 23);
        imagettftext($im, $fontsize, 0, (imagesx($im)- $sx)/2, (imagesy($im)/2), $white, $font, $watermarktext);
       
    }
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

<div class="adsr">
    <!-- JuicyAds v3.0 -->
    <script async src="//adserver.juicyads.com/js/jads.js"></script>
    <ins id="585806" data-width="160" data-height="612"></ins>
    <script>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone': 585806});</script>
    <!--JuicyAds END-->
    <div class="panel panel-danger">
        <div class="panel-heading">
            <a>TU ANUNCIO AQUI</a>
        </div>
        <div class="panel-body">
            <img src="/pag_ima/masajista.png" alt="masajista"/>
        </div>
    </div>
    <div class="panel panel-danger">
        <div class="panel-heading">
            <a>TU ANUNCIO AQUI</a>
        </div>
        <div class="panel-body">
            <img src="/pag_ima/escorts.png" alt="escorts"/>
        </div>
    </div>
    <div class="panel panel-danger">
        <div class="panel-heading">
            <a>TU ANUNCIO AQUI</a>
        </div>
        <div class="panel-body">
            <img src="/pag_ima/webcam.png" alt="webcam"/>
        </div>
    </div>

</div>
<div class="full_row row">
    <div class="col-lg-10">
        <div class="adsc">
            <!-- JuicyAds v3.0 -->
            <script async src="//adserver.juicyads.com/js/jads.js"></script>
            <ins id="599486" data-width="300" data-height="62"></ins>
            <script>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone': 599486});</script>
            <!--JuicyAds END-->

        </div>
    </div>

    <div class="panel_movil col-lg-10">

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
                    <center>
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
                    </center>
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
                            $img2 = whatermark_image(substr($url['url'], 1), './pag_ima/pagina4.png', $tel) or null;

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
                </div>
            </div>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h5><b>ACTUALIZA TU ANUNCIO POR SOLO 10.000$ COP</b></h5>
                </div>
                <div class="panel-body">     
                    <div class="alert alert-success" style="text-align: center">
                        <p>En paginaerotica.com puedes hacer que tu anuncio sea más visible y obtener múltiples beneficios:<br><br>
                        <h4><b>Gana mas clientes:</b> Aumenta la visión de tu publicidad.</h4><i class="fa fa-2x fa-eye" aria-hidden="true"></i><br>
                        <h4><b>Subscricion para clientes:</b> Aumenta el número de clientes potenciales.</h4><i class="fa fa-2x fa-usd" aria-hidden="true"></i><br>
                        <h4><b>Permanencia en la página:</b> Tu anuncio permanecerá con nosotros 3 meses. </h4><i class="fa fa-2x fa-clock-o" aria-hidden="true"></i><br>
                        <h4><b>Ahorra tiempo:</b> Re-publicaciones automaticas diarias.</h4><i class="fa fa-2x fa-reply-all" aria-hidden="true"></i><br>
                        </p>
                    </div>
                    <form action="." method="post">
                        <div class="form-group">
                            <div class="col-lg-8">
                                <input type="email" required name="correo" class="form-control" placeholder="Ingresa tu email"/>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-primary" >
                                    Enviar información <i class="fa fa-external-link" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>                                   