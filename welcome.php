<!DOCTYPE html>
<html lang="es">
    <head>        
        <?php
        include_once './bd/Anuncio.php';
        if (isset($_GET)) {
            $idanuncio = filter_input(INPUT_GET, 'idanuncio');
            $anuncio = new Anuncio();
            $datos = $anuncio->getAnunciosxID($idanuncio);
            if ($datos == false) {
                header("Location:/");
            }
        } else {
            header("Location:/");
        }

        include './plantillas/init.php';
        include './plantillas/head.php';
        ?>
        <script src="/js/funciones.min.js" type="text/javascript"></script>
        <script src="/js/wellcome.js" type="text/javascript"></script>        
        <!--<script src="js/funciones.js?v=<?= time(); ?>" type="text/javascript"></script>
<script src="js/wellcome.js?v=<?= time(); ?>" type="text/javascript"></script>-->

        <meta name="description" content="<?= trim(preg_replace('/\s\s+/', ' ', strip_tags(substr($datos['texto'], 0, 180)))) ?>">
        <meta name="keywords" content="<?= $datos['tipo'] . ',' . $datos['d_nombre'] . ',' . $datos['m_nombre'] . ',anuncio,gratis,clasificados,' . $datos['tel'] ?> ">
        <link rel="canonical" href="http://www.paginaerotica.com/idanuncio/<?= $idanuncio ?>">
        <title><?= $datos['tel'] . ' - ' . $datos['titulo'] . ' - ' . $idanuncio ?></title>

    </head>
    <body itemscope itemtype="http://schema.org/WebPage">

        <div class="wrapper">
        <?php
        $parm1 = filter_input(INPUT_GET, 'parm1');
        $parm2 = filter_input(INPUT_GET, 'parm2');
        $parm3 = filter_input(INPUT_GET, 'parm3');

        include_once './bd/Correo.php';
        include './plantillas/header.php';
        ?>

        

            <div class="container-fluid">          
                <div>                          
                    <script src="/js/contenido.js" type="text/javascript"></script>

                    <b>
                        <ol id="top_anuncio" class="breadcrumb">
                            <?php
                            echo '<li><a href="http://www.paginaerotica.com/"><span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>Top Anuncios</a></li>';

                            if (isset($parm1)) {
                                echo '<li><a href="/' . $parm1 . '/">' . $parm1 . '</a></li>';
                            }

                            if (isset($parm2)) {
                                echo '<li><a href="/' . $parm2 . '/">' . $parm2 . '</a></li>';
                            }
                            ?>

                        </ol>
                    </b>


                </div>


                <div class="row">
                    <div id="well_pane" class="col-xs-12 col-lg-12" style="float: none;margin: 0 auto">

                        <div itemprop="mainContentOfPage">            
                            <?php
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
                            $fecha_inicio = $datos['fecha_inicio'];
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
                                                echo '<li style="padding-top: 8px;"><a href="/0/0/0/' . $tarifa . '">Tarifa: ' . $tarifa . '</a></li>';
                                            }

                                            if (!empty($fecha_inicio)) {
                                                echo ($poner_) ? ' | ' : '';
                                                echo '<li style="padding-top: 8px;"><a href="/0/0/0/' . $fecha_inicio . '"><i class="fa fa-calendar" aria-hidden="true"></i> ' . $fecha_inicio . '</a></li>';
                                            }
                                            ?>
                                        </ul>

                                        <h5>
                                            <span style="padding: 5px 5px;" class="label label-primary">
                                                <a href="/0/0/0/<?= $tel ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?= $tel ?></a>    
                                            </span>
                                        </h5>

                                    </div>

                                    <div><?= $texto ?></div>
                                    <br>

                                    <?php
                                    $img = $anuncio->getUrlImage($idanuncio, 0);

                                    
                                    if (is_array($img) || is_object($img)) {
                                        foreach ($img as $pos2 => $url) {

                                            echo '<div class="cont_img"><img class="render" src="' . substr($url['url'], 2) . '" alt="' . $tel . '" style=" height: auto;width: 100%;"></div>';
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
                        </div>

                    </div>
                </div>                        
            </div>

            <div class="wrapper_div"></div> <!-- wrapper-->
        </div>
        <?php
        include './plantillas/footer.php';
        ?>                      

    </body>
</html>
