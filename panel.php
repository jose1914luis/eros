<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
        include './plantillas/init.php';
        if ($idusuario == null) {

            header("Location:/session");
        }
        include './plantillas/head.php';
        ?>

        <script src="js/panel.js" type="text/javascript"></script>
        <title>Panel</title>
    </head>

    <body>


        <div class="wrapper">
        <?php
        include './plantillas/header.php';
        ?>

        

            <?php
            include_once './bd/Anuncio.php';

            $anuncio = new Anuncio();

//renderizar imagen sin javascrit
            function resize_image($file, $w, $h, $ext) {
                list($width, $height) = getimagesize($file);
                $dst = '';

                if ($width > 0) {

                    $r = $width / $height;

                    if ($w / $h > $r) {
                        $newwidth = $h * $r;
                        $newheight = $h;
                    } else {
                        $newheight = $w / $r;
                        $newwidth = $w;
                    }

                    $src = '';
                    if ($ext == 'png') {
                        $src = imagecreatefrompng($file);
                    } else if ($ext == 'jpg') {

                        $src = imagecreatefromjpeg($file);
                    }

                    $dst = imagecreatetruecolor($newwidth, $newheight);
                    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                }


                return $dst;
            }
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div id="top_anuncio" class="col-lg-12">        
                        <h1 style="font-size: 18px; padding-left: 10px;text-align: center;"><b>Tus Anuncios</b></h1>
                    </div>
                </div>

                <?php
//filter_input(INPUT_GET, 'page');

                $total = $anuncio->total_usuario($idusuario);

// How many items to list per page
                $limit = 10;

                if ($total > 0) {


// How many pages will there be
                    $pages = ceil($total / $limit);

// What page are we currently on?
                    $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
                        'options' => array(
                            'default' => 1,
                            'min_range' => 1,
                        ),)));

// Calculate the offset for the query
                    $offset = ($page - 1) * $limit;

// Some information to display to the user
                    $start = $offset + 1;
                    $end = min(($offset + $limit), $total);

                    $datos = $anuncio->getAnuncioXPaginaUsuario($limit, $offset, $idusuario);

                    $i = 1;
                    if (is_array($datos) || is_object($datos)) {

                        echo '<div class="row">';
                        foreach ($datos as $pos => $value) {


                            $text_ini = 220;

                            $titulo = $value['titulo'];

                            $texto = strtoupper(strip_tags($value['texto']));
                            if (strlen($texto) >= $text_ini) {
                                $texto = substr($texto, 0, $text_ini) . '...';
                            }

                            $img = $anuncio->getUrlImage($value['idanuncio'], 2);
                            $altura = $value['altura'];
                            $edad = $value['edad'];
                            $tarifa = $value['tarifa'];
                            $tel = $value['tel'];
                            ?>

                            <div class="col-lg-12 ">
                                <div class="panel panel-danger" style="/*width: 531px;*/">
                                    <div class="panel-heading" style="    overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">
                                        <a class="hand" href="index.php?idanuncio=<?= $value['idanuncio'] ?>"><h2  style="color: #03b;display: initial;" class="f_15"><b><?= $titulo ?></b></h2></a>

                                        <div style="float: right">
                                            <!--                                        <button type="button" onclick="eliminarAnuncio()" class="btn btn-xs btn-success" aria-label="Left Align">
                                                                                        <span class="glyphicon glyphicon-king" aria-hidden="true"></span> Promocionar
                                                                                    </button>                            -->

                                            <button type="button" onclick="promocionar(<?= $value['idanuncio'] ?>)" class="btn btn-xs btn-warning" aria-label="Left Align">
                                                <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Promocionar
                                            </button>

                                            <button type="button" onclick="republicar(<?= $value['idanuncio'] ?>)" class="btn btn-xs btn-primary" aria-label="Left Align">
                                                <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Republicar
                                            </button>

                                            <button type="button" onclick="eliminarAnuncio(<?= $value['idanuncio'] ?>)" class="btn btn-xs btn-danger" aria-label="Left Align">
                                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar
                                            </button>
                                        </div>

                                    </div>
                                    <table class="table">
                                        <tr>
                                            <?php
                                            // se carga la imagen.
                                            if (is_array($img) || is_object($img)) {


                                                echo '<td style = "width: 205px;padding: 0;"> ';
                                                echo '<div class="w3-content w3-display-container" style="text-align: center;height: 250px;">';
                                                echo '<div class="helper"></div>';
                                                foreach ($img as $pos2 => $url) {

                                                    $ext = pathinfo($url['url'], PATHINFO_EXTENSION);

                                                    $img2 = resize_image(substr($url['url'], 1), 200, 220, $ext) or die('Cannot Initialize new GD image stream');

                                                    ob_start();
                                                    imagepng($img2);
                                                    $output = base64_encode(ob_get_contents());
                                                    ob_end_clean();
                                                    if ($ext == 'png') {
                                                        echo '<img class="render slides_' . $i . '" src="data:image/png;base64,' . $output . '" alt="' . $tel . '"/>';
                                                    } else if ($ext == 'jpg') {

                                                        echo '<img class="render slides_' . $i . '" src="data:jpeg/png;base64,' . $output . '" alt="' . $tel . '"/>';
                                                    }
                                                }
                                                if (count($img) > 1) {
                                                    ?>

                                                <a style="opacity: 0.6;" class="w3-btn-floating w3-display-left" onclick="<?= 'plusDivs_' . $i . '( - 1)' ?>">&#10094;</a>
                                                <a style="opacity: 0.6;" class="w3-btn-floating w3-display-right" onclick="<?= 'plusDivs_' . $i . '(1)' ?>">&#10095;</a>

                                                <script type="text/javascript">
                                                        var i_ = <?= $i ?>;
                                                        var slide_<?= $i ?> = 1;
                                                        showDivs_<?= $i ?>(slide_<?= $i ?>);
                                                        function plusDivs_<?= $i ?>(n) {
                                                            showDivs_<?= $i ?>(slide_<?= $i ?> += n);
                                                        }
                                                        ;
                                                        function showDivs_<?= $i ?>(n) {
                                                            var i;
                                                            var x = $(".slides_<?= $i ?>");
                                                            if (n > x.length) {
                                                                slide_<?= $i ?> = 1;
                                                            }
                                                            if (n < 1) {
                                                                slide_<?= $i ?> = x.length;
                                                            }
                                                            for (i = 0; i < x.length; i++) {
                                                                x[i].style.display = "none";
                                                            }
                                                            x[slide_<?= $i ?> - 1].style.display = "inline-block";
                                                        }
                                                </script>
                                                <?php
                                            }


                                            echo '</div>';
                                            echo '</td>';
                                        }
                                        ?>

                                        <td class="td_texto">
                                            <div>
                                                <b style="font-size: 10px;" itemprop="serviceType"><?= $value['d_nombre'] . ' - ' . $value['m_nombre'] ?></b>
                                            </div>

                                            <p class="texto" itemprop="description"><?= $texto ?></p>

                                            <?php
                                            if (!empty($edad))
                                                echo '<b class="f_15">Edad: </b>' . $value['edad'] . '<br>';
                                            if (!empty($altura))
                                                echo '<b class="f_15">Altura: </b>' . $altura . '<br>';
                                            if (!empty($tarifa))
                                                echo '<b class="f_15">Tarifa minima: </b>' . $value['tarifa'] . '<br>';
                                            if (!empty($tel))
                                                echo '<b class="f_15">Tel: </b>' . $value['tel'] . '<br>';
                                            ?>
                                        </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <?php
                            $i = $i + 1;
                        }

                        echo '</div>';
                    }

                    $prevlink = ($page > 1) ? '<li><a href="?page=1" aria-label="Previous">&laquo;</a> </li> <li><a href="?page=' . ($page - 1) . '" aria-label="Previous">&lsaquo;</a></li>' : '<li class="disabled"><span aria-label="Previous">&laquo;</span> </li> <li class="disabled"><span aria-label="Previous">&lsaquo;</span></li>';

                    $nextlink = ($page < $pages) ? '<li><a href="?page=' . ($page + 1) . '" aria-label="Next">&rsaquo;</a> </li> <li><a href="?page=' . $pages . '" title="Last page">&raquo;</a></li>' : '<li class="disabled"><span class="disabled">&rsaquo;</span> </li> <li class="disabled"><span aria-label="Next">&raquo;</span></li>';

                    if ($total > $limit) {
                        ?>
                        <div id="pagi" class="text-center">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <?php
                                    echo $prevlink;

                                    for ($j = max(1, $page - 5); $j <= min($page + 5, $pages); $j++) {

                                        echo '<li ' . (($j == $page) ? 'class="active"' : '' ) . '><a href="?page=' . $j . '">' . $j . '</a></li>';
                                    }
                                    echo $nextlink;

                                    echo '</ul>';
                                    echo '</nav>';
                                    echo '</div>';
                                }
                            } else {
//                                $style = "style='position: fixed;width: 100%;'";
                                ?>
                                <div class="col-lg-12" style="float: none;margin: 0 auto">


                                    <div style="text-align: center">                                    
                                        <div class="alert alert-dismissable" role="alert"><b>Ups no hay datos!!.</b> Por favor intenta con otra busqueda.</div>
                                    </div>


                                </div>

                                <?php
                            }
                            ?>

                            </div>


                            <div style=" height: 100px;"></div> <!-- wrapper-->
                            </div>
                            <?php
                            include './plantillas/footer.php';
                            ?>


                            </body>

                            </html>