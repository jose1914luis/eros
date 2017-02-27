<script src="js/funciones.js?v=<?= time(); ?>" type="text/javascript"></script>
<script src="js/contenido.js?v=<?= time(); ?>" type="text/javascript"></script>
<?php
include './bd/Anuncio.php';

$anuncio = new Anuncio();
//renderizar imagen si javascritp
function resize_image($file, $w, $h) {
//    echo 'entro' . $file;
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
        
        $src = imagecreatefrompng($file);
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    }


    return $dst;
}
?>
<div class="row">
<!--    <div id="top_anuncio" class="col-lg-12">        
        <h5><b>Top Anuncios</b></h5>
    </div>    -->
    <?php
//filter_input(INPUT_GET, 'page');

    $total = $anuncio->total($cat, $depa, $mun, $buscar);

// How many items to list per page
    $limit = 40;

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

        $datos = $anuncio->getAnuncioXPagina($limit, $offset, $cat, $depa, $mun, $buscar);

        $i = 1;
        if (is_array($datos) || is_object($datos)) {

            foreach ($datos as $pos => $value) {

                $text_ini = 220;

                $titulo = $value['titulo'];
                if (strlen($titulo) >= 100) {
                    $titulo = substr($titulo, 0, 97) . '...';
                } else {

                    //si el titulo es pequeño aumento contenido
                    if (strlen($titulo) <= 35) {
                        $text_ini = 290;
                    }
                }

                $texto = strtoupper(strip_tags($value['texto']));
                if (strlen($texto) >= $text_ini) {
                    $texto = substr($texto, 0, $text_ini) . '...';
                }

                $img = $anuncio->getUrlImage($value['idanuncio']);


                echo '<div class="col-lg-6 " style="/*margin-right: 60px;*/">';
                echo '<div class="panel panel-danger" style="height: 292px;/*width: 531px;*/">';
                echo '<div class="panel-heading">';
                echo '<a class="hand" href="index.php?idanuncio=' . $value['idanuncio'] . '"><b style="color: #03b;" class="f_15">' . $titulo . '</b></a><br>';
                echo '</div>';
                echo '<table class="table">';
                echo '<tr>';

                // se carga la imagen.
                if (is_array($img) || is_object($img)) {


                    echo '<td style = "width: 205px;"> ';
                    echo '<div class="w3-content w3-display-container" style="text-align: center;height: 250px;">';
                    echo '<div class="helper"></div>';
                    foreach ($img as $pos2 => $url) {

                        $img2 = resize_image(substr($url['url'], 1), 250, 200) or die('Cannot Initialize new GD image stream');

                        ob_start();
                        imagepng($img2);
                        $output = base64_encode(ob_get_contents());
                        ob_end_clean();

                        echo '<img class="render slides_' . $i . '" src="data:image/png;base64,' . $output . '"/>';
                    }
                    if (count($img) > 1) {

                        echo '<a style="opacity: 0.6;" class="w3-btn-floating w3-display-left" onclick="plusDivs_' . $i . '(-1)">&#10094;</a>';
                        echo '<a style="opacity: 0.6;" class="w3-btn-floating w3-display-right" onclick="plusDivs_' . $i . '(1)">&#10095;</a>';

                        echo '<script type="text/javascript">';
                        echo '                            var slide_' . $i . ' = 1;';
                        echo '                            showDivs_' . $i . '(slide_' . $i . ');';
                        echo '                            plusDivs_' . $i . ' = function (n) {';
                        echo '                                showDivs_' . $i . '(slide_' . $i . ' += n);';
                        echo '                            };';
                        echo '                      function showDivs_' . $i . '(n) {';
                        echo '                          var i;';
                        echo '                          var x = $(".slides_' . $i . '");';
                        echo '                          if (n > x.length) {';
                        echo '                              slide_' . $i . ' = 1;';
                        echo '                          }';
                        echo '                          if (n < 1) {';
                        echo '                              slide_' . $i . ' = x.length;';
                        echo '                          }';
                        echo '                          for (i = 0; i < x.length; i++) {';
                        echo '                              x[i].style.display = "none";';
                        echo '                          }';
                        echo '                          x[slide_' . $i . ' - 1].style.display = "inline-block";';
                        echo '                      }';
                        echo '                  </script>';
                    }


                    echo '</div>';
                    echo '</td>';
                }

                $altura = $value['altura'];
                $edad = $value['edad'];
                $tarifa = $value['tarifa'];
                $tel = $value['tel'];

                echo '<td class="td_texto">';
                echo '<b style="font-size: 10px;">' . $value['tipo'] . ' - ' . $value['d_nombre'] . ' - ' . $value['m_nombre'] . '</b>';
//                echo '<a class="hand" href="index.php?idanuncio=' . $value['idanuncio'] . '"><b style="color: #03b;" class="f_15"><u>' . $titulo . '</u></b></a><br>';

                echo '<p class="texto">' . $texto . '</p>';

                if (!empty($edad))
                    echo '<b class="f_15">Edad: </b>' . $value['edad'] . '<br>';
                if (!empty($altura))
                    echo '<b class="f_15">Altura: </b>' . $altura . '<br>';
                if (!empty($tarifa))
                    echo '<b class="f_15">Tarifa minima: </b>' . $value['tarifa'] . '<br>';
                if (!empty($tel))
                    echo '<b class="f_15">Tel: </b>' . $value['tel'] . '<br>';
                echo '</td>';
                echo '</tr>';
                echo '</table>';
                echo '</div>';
                echo '</div>';
                $i = $i + 1;
            }
        }

        echo '</div>';

        $prevlink = ($page > 1) ? '<li><a href="?page=1" aria-label="Previous">&laquo;</a> </li> <li><a href="?page=' . ($page - 1) . '" aria-label="Previous">&lsaquo;</a></li>' : '<li class="disabled"><span aria-label="Previous">&laquo;</span> </li> <li class="disabled"><span aria-label="Previous">&lsaquo;</span></li>';

        $nextlink = ($page < $pages) ? '<li><a href="?page=' . ($page + 1) . '" aria-label="Next">&rsaquo;</a> </li> <li><a href="?page=' . $pages . '" title="Last page">&raquo;</a></li>' : '<li class="disabled"><span class="disabled">&rsaquo;</span> </li> <li class="disabled"><span aria-label="Next">&raquo;</span></li>';

        echo '<div id="pagi" class="text-center">';
        echo '<nav aria-label="Page navigation">';
        echo '    <ul class="pagination">';
        echo $prevlink;

        for ($j = max(1, $page - 5); $j <= min($page + 5, $pages); $j++) {

            echo '<li ' . (($j == $page) ? 'class="active"' : '' ) . '><a href="?page=' . $j . '&cat=' . $cat . '&depa=' . $depa . '&mun=' . $mun . '&buscar =' . $buscar . '">' . $j . '</a></li>';
        }
        echo $nextlink;

        echo '</ul>';
        echo '</nav>';
        echo '</div>';
    } else {

        echo '<div><div class="col-sm-5 alert alert-danger" role="alert"><b>Ups no hay datos!!.</b> Por favor intenta con otra busqueda.</div></div>';
    }
    ?>

</div>


