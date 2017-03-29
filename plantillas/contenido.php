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

<?php
//filter_input(INPUT_GET, 'page');


if ($total > 0) {

    $i = 1;
    $datos = $paginador->datos;
    if (is_array($datos) || is_object($datos)) {

        $pri = true;
        foreach ($datos as $pos => $value) {
            if ($pri) {
                ?>

                <div>                          
                    <script src="/js/contenido.js" type="text/javascript"></script>

                    <b>
                        <ol id="top_anuncio" class="breadcrumb">
                            <?php
                            echo '<li><a href="http://www.paginaerotica.com/">Top Anuncios</a></li>';

                            if (isset($parm1)) {
                                echo '<li><a href="/' . $parm1 . '/">' . $parm1 . '</a></li>';
                            }

                            if (isset($parm2)) {
                                echo '<li><a href="/' . $parm2 . '">' . $parm2 . '</a></li>';
                            }
                            ?>

                        </ol>
                    </b>


                </div>

                <div class="row">                    



                    <?php
                    $pri = false;
                }
                $text_ini = 220;

                $titulo = $value['titulo'];

                $texto = strip_tags($value['texto']);
                if (strlen($texto) >= $text_ini) {
                    $texto = substr($texto, 0, $text_ini) . '...';
                }

                $img = $anuncio->getUrlImage($value['idanuncio'], 2);
                $altura = $value['altura'];
                $edad = $value['edad'];
                $tarifa = $value['tarifa'];
                $tel = $value['tel'];
                ?>
                <div class="col-lg-6 ">
                    <div class="panel panel-danger" style="height: 292px;" itemscope itemtype="http://schema.org/Service">
                        <div class="panel-heading panel_titulo">
                            <a class="hand" href="<?= "/idanuncio/" . $value['idanuncio'] ?>"><h2  style="color: #337ab7;display: initial;" class="f_15"><b itemprop="name"><?= $titulo ?></b></h2></a>
                            <?php if ($super) { ?>

                                <div style="float: right">
                                    <button type="button" onclick="eliminarAnuncio(<?= $value['idanuncio'] ?>)" class="btn btn-xs btn-default" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <table class="table">
                            <tr>
                                <?php
                                // se carga la imagen.
                                if (is_array($img) || is_object($img)) {
                                    ?>
                                    <td style = "width: 205px;padding: 0;"> 
                                        <div class="w3-content w3-display-container" style="text-align: center;height: 250px;">
                                            <div class="helper"></div>

                                            <?php
                                            foreach ($img as $pos2 => $url) {

                                                $ext = pathinfo($url['url'], PATHINFO_EXTENSION);

                                                $img2 = resize_image(substr($url['url'], 1), 200, 220, $ext) or die('Cannot Initialize new GD image stream');

                                                ob_start();
                                                imagepng($img2);
                                                $output = base64_encode(ob_get_contents());
                                                ob_end_clean();
                                                if ($ext == 'png') {
                                                    echo '<img itemprop="logo" class="render slides_' . $i . '" src="data:image/png;base64,' . $output . '" alt="' . $tel . '"/>';
                                                } else if ($ext == 'jpg') {

                                                    echo '<img itemprop="logo" class="render slides_' . $i . '" src="data:jpeg/png;base64,' . $output . '" alt="' . $tel . '"/>';
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
                                                echo '<b class="f_15">Tarifa minima: </b itemprop="price">' . $value['tarifa'] . '<br>';
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

        $prevlink = ($page > 1) ? '<li><a href="' . 
                                    (isset($parm1) ? ((substr($parm1, 0, 4) == 'pag_')?'':'/' . $parm1): '') . 
                                    (isset($parm2) ? ((substr($parm2, 0, 4) == 'pag_')?'':'/' . $parm2): '') . 
                                    (isset($parm3) ? ((substr($parm3, 0, 4) == 'pag_')?'':'/' . $parm3): '') . 
                                    (isset($parm4) ? ((substr($parm4, 0, 4) == 'pag_')?'':'/' . $parm4) : '') . '/pag_1/" aria-label="Previous">&laquo;</a> </li> <li><a href="pag_' . ($page - 1) . '" aria-label="Previous">&lsaquo;</a></li>' : '<li class="disabled"><span aria-label="Previous">&laquo;</span> </li> <li class="disabled"><span aria-label="Previous">&lsaquo;</span></li>';

        $nextlink = ($page < $pages) ? '<li><a href="' . ($page + 1) . '" aria-label="Next">&rsaquo;</a> </li> <li><a href="' . 
                                    (isset($parm1) ? ((substr($parm1, 0, 4) == 'pag_')?'':'/' . $parm1): '') . 
                                    (isset($parm2) ? ((substr($parm2, 0, 4) == 'pag_')?'':'/' . $parm2): '') . 
                                    (isset($parm3) ? ((substr($parm3, 0, 4) == 'pag_')?'':'/' . $parm3): '') . 
                                    (isset($parm4) ? ((substr($parm4, 0, 4) == 'pag_')?'':'/' . $parm4) : '') . '/pag_' . $pages . '/" title="Last page">&raquo;</a></li>' : '<li class="disabled"><span class="disabled">&rsaquo;</span> </li> <li class="disabled"><span aria-label="Next">&raquo;</span></li>';
        if ($total > $limit) {
            ?>
            <div id="pagi" class="text-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination">


                        <?php
                        echo $prevlink;
                        for ($j = max(1, $page - 5); $j <= min($page + 5, $pages); $j++) {

                            echo '<li ' . (($j == $page) ? 'class="active"' : '' ) . '><a href="' . 
                                    (isset($parm1) ? ((substr($parm1, 0, 4) == 'pag_')?'':'/' . $parm1): '') . 
                                    (isset($parm2) ? ((substr($parm2, 0, 4) == 'pag_')?'':'/' . $parm2): '') . 
                                    (isset($parm3) ? ((substr($parm3, 0, 4) == 'pag_')?'':'/' . $parm3): '') . 
                                    (isset($parm4) ? ((substr($parm4, 0, 4) == 'pag_')?'':'/' . $parm4) : '') . '/pag_' . $j . '/">' . $j . '</a></li>';
                        }
                        echo $nextlink;

                        echo '</ul>';
                        echo '</nav>';
                        echo '</div>';
                    }
                } else {
                    $style = "style='position: fixed;width: 100%;'";
                    ?>
                    <div class="col-lg-12" style="float: none;margin: 0 auto">
                        <div style="text-align: center">                                    
                            <div class="alert alert-danger" role="alert"><b>Ups no hay datos!!.</b> Por favor intenta con otra busqueda.</div>
                        </div>
                    </div>

                    <?php
                }
                ?>




