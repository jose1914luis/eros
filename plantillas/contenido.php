<?php
include_once './bd/Anuncio.php';

$anuncio = new Anuncio();

//renderizar imagen sin javascrit
function resize_image($file, $w, $h, $ext) {

    if (list($width, $height) = @getimagesize($file)) {

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
    } else {
        return null;
    }
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
                    <!--<script src="/js/contenido.js?v=<?= time() ?>" type="text/javascript"></script>-->
                    <script src="/js/contenido.min.js?v=<?= VERSION ?>" type="text/javascript"></script>


                    <b>
                        <ol id="top_anuncio" class="breadcrumb" style="color: #337ab7;">
                            <?php
                            if (isset($parm1)) {
                                echo '<li><a href="/"><span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span> Anuncios</a></li>';
                                echo '<li><a href="/' . $parm1 . '/">' . $parm1 . '</a></li>';
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

                <div class="row" style="margin-right: 0px;margin-left: 0px; ">                    



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
                <div class="panel_movil col-lg-6">
                    <div class="panel_interno panel panel-danger" itemscope itemtype="http://schema.org/Service">
                        <div class="panel-heading panel_titulo">
                            <div class="h3_panel">
                                <a class="hand" href="<?= "/P_AN/" . $value['idanuncio'] . "/" . $value['tipo'] . "/" . $value['d_nombre'] . "/" ?> ">
                                    <h3 class="h3_mod" style="color: #337ab7;" class="f_15"><?= $titulo ?></h3></a>
                            </div>
                            <div style="display: flex">                           
                                <?= $value['tipo'] . ' - ' . $value['d_nombre'] . ' - ' . $value['m_nombre'] ?>
                            </div>


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
                                            $con = 0;
                                            foreach ($img as $pos2 => $url) {

                                                if ($con < LIMIT_IMG) {
                                                    $ext = pathinfo($url['url'], PATHINFO_EXTENSION);

                                                    $img2 = resize_image(substr($url['url'], 1), 190, 210, $ext) or null;

                                                    if (isset($img2)) {
                                                        ob_start();
                                                        imagejpeg($img2, null, 75);
                                                        $output = base64_encode(ob_get_contents());
                                                        ob_end_clean();
                                                        echo '<img itemprop="logo" class="render slides_' . $i . '" src="data:image/jpeg;base64,' . $output . '" alt="' . $tel . '"/>';
                                                    }
                                                }
                                                $con = $con + 1;
                                            }
                                            if (count($img) > 1) {
                                                ?>

                                                <a style="opacity: 0.6;" class="w3-btn-floating w3-display-left" onclick="<?= 'plusDivs(slideIndex' . $i . ', -1,' . $i . ')' ?>">&#10094;</a>
                                                <a style="opacity: 0.6;" class="w3-btn-floating w3-display-right" onclick="<?= 'plusDivs(slideIndex' . $i . ',1,' . $i . ')' ?>">&#10095;</a>                                                
                                                
                                                <script type="text/javascript">
                                                    var slideIndex<?= $i ?> = {con: 1};
                                                    init(slideIndex<?= $i ?>, <?= $i ?>);
                                                </script>
                                                <?php
                                            }


                                            echo '</div>';
                                            echo '</td>';
                                        }
                                        ?>

                                        <td class="td_texto">                                           

                                            <p class="texto" itemprop="description"><?= $texto ?></p>

                                            <?php
                                            if (!empty($edad)) {
                                                echo '<b class="f_15">Edad: </b>' . $value['edad'] . '<br>';
                                            }
                                            if (!empty($altura))
                                                echo '<b class="f_15">Altura: </b>' . $altura . '<br>';
                                            if (!empty($tarifa))
                                                echo '<b class="f_15">Tarifa mínima: </b itemprop="price">' . $value['tarifa'] . '<br>';
                                            if (!empty($tel))
                                                echo '<b class="f_15">Tel: </b> <a href="' . '/' . $value['tipo'] . '/' . $value['d_nombre'] . '/' . $value['tel'] . '"><i class="fa fa-phone" aria-hidden="true"></i>' . $value['tel'] . '</a><br>';
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
                (isset($parm1) ? ((substr($parm1, 0, 4) == 'pag_') ? '' : '/' . $parm1) : '') .
                (isset($parm2) ? ((substr($parm2, 0, 4) == 'pag_') ? '' : '/' . $parm2) : '') .
                (isset($parm3) ? ((substr($parm3, 0, 4) == 'pag_') ? '' : '/' . $parm3) : '') .
                (isset($parm4) ? ((substr($parm4, 0, 4) == 'pag_') ? '' : '/' . $parm4) : '') . '/pag_1/" aria-label="Previous">&laquo;</a> </li> <li><a href="pag_' . ($page - 1) . '" aria-label="Previous">&lsaquo;</a></li>' : '<li class="disabled"><span aria-label="Previous">&laquo;</span> </li> <li class="disabled"><span aria-label="Previous">&lsaquo;</span></li>';

        $nextlink = ($page < $pages) ? '<li><a href="' . ($page + 1) . '" aria-label="Next">&rsaquo;</a> </li> <li><a href="' .
                (isset($parm1) ? ((substr($parm1, 0, 4) == 'pag_') ? '' : '/' . $parm1) : '') .
                (isset($parm2) ? ((substr($parm2, 0, 4) == 'pag_') ? '' : '/' . $parm2) : '') .
                (isset($parm3) ? ((substr($parm3, 0, 4) == 'pag_') ? '' : '/' . $parm3) : '') .
                (isset($parm4) ? ((substr($parm4, 0, 4) == 'pag_') ? '' : '/' . $parm4) : '') . '/pag_' . $pages . '/" title="Last page">&raquo;</a></li>' : '<li class="disabled"><span class="disabled">&rsaquo;</span> </li> <li class="disabled"><span aria-label="Next">&raquo;</span></li>';
        if ($total > $limit) {
            ?>
            <div id="pagi" class="text-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination">


                        <?php
                        echo $prevlink;
                        for ($j = max(1, $page - 5); $j <= min($page + 5, $pages); $j++) {

                            echo '<li ' . (($j == $page) ? 'class="active"' : '' ) . '><a href="' .
                            (isset($parm1) ? ((substr($parm1, 0, 4) == 'pag_') ? '' : '/' . $parm1) : '') .
                            (isset($parm2) ? ((substr($parm2, 0, 4) == 'pag_') ? '' : '/' . $parm2) : '') .
                            (isset($parm3) ? ((substr($parm3, 0, 4) == 'pag_') ? '' : '/' . $parm3) : '') .
                            (isset($parm4) ? ((substr($parm4, 0, 4) == 'pag_') ? '' : '/' . $parm4) : '') . '/pag_' . $j . '/">' . $j . '</a></li>';
                        }
                        echo $nextlink;
                        ?>
                    </ul>
                </nav>
            </div>
            <?php
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




