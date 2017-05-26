      
<div>                          
    <script src="/js/funciones.min.js?v=<?= VERSION ?>" type="text/javascript"></script>
    <script src="/js/wellcome.js?v=<?= VERSION ?>" type="text/javascript"></script>
    <script src="/js/contenido.js?v=<?= VERSION ?>" type="text/javascript"></script>


    <b>
        <ol id="top_anuncio" class="color_a breadcrumb">
            <?php
            if (isset($parm1)) {
                echo '<li><a href="/"><span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span> Anuncios</a></li>';
                echo '<li><a href="/' . $parm1 . '/"><h1 class="h1_mod">' . $parm1 . '</h1></a></li>';
                if (isset($parm2)) {
                    echo '<li><a href="/' . $parm1 . '/' . $parm2 . '/">' . $parm2 . '</a></li>';
                }
            } else {
                echo '<li><a href="/"><h1 class="h1_mod">Anuncios Eroticos Colombia</h1></a></li>';
            }
            ?>

        </ol>
    </b>   


</div>


<div class="full_row row">
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
                            echo '<li style="padding-top: 8px;"><a href="' . (isset($parm1) ? '/' . $parm1 : '') . (isset($parm2) ? '/' . $parm2 : '') . '/' . $tarifa . '">Tarifa: ' . $tarifa . '</a></li>';
                        }

                        if (!empty($fecha_inicio)) {
                            echo ($poner_) ? ' | ' : '';
                            echo '<li style="padding-top: 8px;">Fecha de publicación: ' . $fecha_inicio . '</li>';
                        }
                        ?>
                    </ul>
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

                            echo '<div class="cont_img"><img class="render" src="' . substr($url['url'], 2) . '" alt="' . $tel . '"></div>';
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