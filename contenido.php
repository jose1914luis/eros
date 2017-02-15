<script src="js/funciones.js?v=<?= time(); ?>" type="text/javascript"></script>
<script src="js/contenido.js?v=<?= time(); ?>" type="text/javascript"></script>
<?php
include './bd/Anuncio.php';

$anuncio = new Anuncio();

//filter_input(INPUT_GET, 'page');

$total = $anuncio->total($cat, $depa, $mun, $buscar);

// How many items to list per page
$limit = 4;


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

    echo '<div class="row">';
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

            $texto = strip_tags($value['texto']);
            if (strlen($texto) >= $text_ini) {
                $texto = substr($texto, 0, $text_ini) . '...';
            }

            $img = $anuncio->getUrlImage($value['idanuncio']);


            echo '<div class="col-lg-5 ">';
            echo '<div class="panel panel-danger" style="height: 306;">';
            echo '<div class="panel-heading">';
            echo $value['tipo'] . ' - ' . $value['d_nombre'] . ' - ' . $value['m_nombre'];
            echo '</div>';
            echo '<table class="table">';
            echo '<tr>';


            if (is_array($img) || is_object($img)) {
                echo '<td style = "width: 205px;"> ';
                echo '<div class="w3-content w3-display-container" style="text-align: center;height: 250px;">';
                echo '<div class="helper"></div>';
                foreach ($img as $pos2 => $url) {
                    echo '<img class="render slides_' . $i . '" src="' . substr($url['url'], 1) . '" alt="...">';
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
            echo '<a class="hand" href="index.php?idanuncio=' . $value['idanuncio'] . '"><b class="f_15">' . $titulo . '</b></a><br>';

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

//    echo $pages;
// The "back" link
    //$pages = 20;
    $prevlink = ($page > 1) ? '<li><a href="?page=1" aria-label="Previous">&laquo;</a> </li> <li><a href="?page=' . ($page - 1) . '" aria-label="Previous">&lsaquo;</a></li>' : '<li class="disabled"><span aria-label="Previous">&laquo;</span> </li> <li class="disabled"><span aria-label="Previous">&lsaquo;</span></li>';

// The "forward" link


    $nextlink = ($page < $pages) ? '<li><a href="?page=' . ($page + 1) . '" aria-label="Next">&rsaquo;</a> </li> <li><a href="?page=' . $pages . '" title="Last page">&raquo;</a></li>' : '<li class="disabled"><span class="disabled">&rsaquo;</span> </li> <li class="disabled"><span aria-label="Next">&raquo;</span></li>';

    echo '<div class="text-center" style="margin-left: -225px;">';
    echo '<nav aria-label="Page navigation">';
    echo '    <ul class="pagination">';
    echo $prevlink;

    for ($j = max(1, $page - 5); $j <= min($page + 5, $pages); $j++) {

        echo '<li ' . (($j == $page) ? 'class="active"' : '' ) . '><a href="?page=' . $j . '">' . $j . '</a></li>';
    }
    echo $nextlink;

    echo '    </ul>';
    echo '</nav>';
    echo '</div>';
} else {

    echo '<div><div class="col-sm-5 alert alert-danger" role="alert"><b>Ups no hay datos!!.</b> Por favor intenta con otra busqueda.</div></div>';
}
// Display the paging information
//echo '<div class="text-center" style="margin-left: -225px;">';
//echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';
echo '</div>';
?>


