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
<div>                          
    <script src="/js/contenido.js?v=<?= time() ?>" type="text/javascript"></script>
<!--<script src="/js/contenido.min.js?v=<?= VERSION ?>" type="text/javascript"></script>-->
    <div style="text-align: center">
        <h1 class="h1_modt"><?= $title ?></h1>    
    </div>

    <b>

        <ol id="top_anuncio" class="breadcrumb" class="color_a">
            <?php
            if (isset($parm1)) {
                $pag = $parm1;
                if(substr($parm1, 0 , 3) == "pag"){
                    $pag = "Página " . substr($parm1, 4);
                }
                echo '<li><a href="/"><span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span> Anuncios</a></li>';
                echo '<li><a href="/' . str_replace(' ', '-', $parm1) . '/">' . $pag . '</a></li>';
                if (isset($parm2)) {
                    echo '<li><a href="/' . str_replace(' ', '-', $parm1) . '/' . str_replace(' ', '-', $parm2) . '/">' . $parm2 . '</a></li>';
                }
            } else {
                echo '<li><a href="/">Top Anuncios Eroticos Colombia</a></li>';
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
            <a href=".">TU ANUNCIO AQUI</a>
        </div>
        <div class="panel-body">
            <img src="../pag_ima/masajista.png" alt="masajista"/>
        </div>
    </div>
    <div class="panel panel-danger">
        <div class="panel-heading">
            <a href=".">TU ANUNCIO AQUI</a>
        </div>
        <div class="panel-body">
            <img src="../pag_ima/escorts.png" alt="escorts"/>
        </div>
    </div>
    <div class="panel panel-danger">
        <div class="panel-heading">
            <a href=".">TU ANUNCIO AQUI</a>
        </div>
        <div class="panel-body">
            <img src="../pag_ima/webcam.png" alt="webcam"/>
        </div>
    </div>

</div>

<div id="upper" class="subir">
    <i class="fa fa-chevron-circle-up fa-4x" aria-hidden="true"></i>
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
    <?php
//filter_input(INPUT_GET, 'page');

    if ($total > 0) {

        $i = 1;
        $datos = $paginador->datos;
        if (is_array($datos) || is_object($datos)) {

            $pri = true;
            foreach ($datos as $pos => $value) {

                $text_ini = 250;

                $titulo = $value['titulo'];

                if(strlen($titulo) > 50){
                    $text_ini = 100;                    
                }
               

                $img = $anuncio->getUrlImage($value['idanuncio'], 2);
                $altura = $value['altura'];
                if(isset($altura)){
                    $text_ini = $text_ini - 50;
                }
                $edad = $value['edad'];
                if(isset($edad)){
                    $text_ini = $text_ini - 50;
                }
                $tarifa = $value['tarifa'];
                if(isset($tarifa)){
                    $text_ini = $text_ini - 50;
                }
                $tel = $value['tel'];
                if(isset($tel)){
                    $text_ini = $text_ini - 50;
                }
                
                if($text_ini < 0){
                    
                    $text_ini = 50;
                }
                
                $texto = strip_tags($value['texto']);
                if (strlen($texto) >= $text_ini) {
                    $texto = substr($texto, 0, $text_ini) . '...';
                }
                ?>  
                <div id="panelId<?= $i ?>" class="col-lg-10"> 

                    <table class="table" style="<?= ($pri) ? 'background-color: rgba(199, 225, 247, 0.55)' : '' ?>">
                        <tr>
                            <?php
                            if ($pri) {
                                $pri = false;
                            } else {
                                $pri = true;
                            }
                            // se carga la imagen.
                            if (is_array($img) || is_object($img)) {
                                ?>
                                <td class="tstyle"> 
                                    <div class="stylediv w3-content w3-display-container">
                                        <span class="helper"></span>

                                        <?php
                                        $con = 0;
                                        foreach ($img as $pos2 => $url) {

                                            $con = $con + 1;
                                            if ($con < LIMIT_IMG) {
                                                $ext = pathinfo($url['url'], PATHINFO_EXTENSION);

                                                $img2 = resize_image(substr($url['url'], 1), 160, 190, $ext) or null;

                                                if (isset($img2)) {
                                                    ob_start();
                                                    imagejpeg($img2, null, 75);
                                                    $output = base64_encode(ob_get_contents());
                                                    ob_end_clean();
                                                    echo '<img itemprop="logo" class="slides_' . $i . '" src="data:image/jpeg;base64,' . $output . '" alt="' . $tel . '"/>';
                                                }
                                            }
                                        }
                                        if (count($img) > 1) {
                                            ?>                                                
                                            <script type="text/javascript">
                                                var slideIndex<?= $i ?> = {con: 1, total: <?= count($img) ?>};
                                                init(slideIndex<?= $i ?>, <?= $i ?>);
                                            </script>
                                            <?php
                                        }


                                        echo '</div>';
                                        echo '</td>';
                                    }
                                    ?>

                                    <td class="td_texto">             
                                        <div class="h3_panel">
                                            <a class="hand" href="<?= "/P_AN/" . $value['idanuncio'] . "/" . str_replace(' ', '-', $value['tipo']) . "/" . str_replace(' ', '-', $value['d_nombre']) . "/" ?> ">
                                                <h3 class="h3_mod f_15 color_a"><?= $titulo ?></h3></a>
                                        </div>
                                        <div class="sflex">                           
                                            <?= $value['tipo'] . ' - ' . $value['d_nombre'] . ' - ' . $value['m_nombre'] ?>
                                        </div>

                                        <p class="texto" itemprop="description"><?= $texto ?></p>

                                        <?php
                                        if (!empty($edad)) {
                                            echo '<b class="f_15">Edad: </b>' . $value['edad'] . '<br>';
                                        }
                                        if (!empty($altura))
                                            echo '<b class="f_15">Altura: </b>' . $altura . '<br>';
                                        if (!empty($tarifa))
                                            echo '<b class="f_15" itemprop="price">Tarifa: </b>' . $value['tarifa'] . '<br>';
                                        if (!empty($tel))
                                            echo '<b class="f_15">Tel: </b> <a href="' . '/' . str_replace(' ', '-', $value['tipo']) . '/' . str_replace(' ', '-', $value['d_nombre']) . '/' . $value['tel'] . '"><i class="fa fa-phone" aria-hidden="true"></i>' . $value['tel'] . '</a><br>';
                                        ?>
                                    </td>
                        </tr>
                    </table> 
                </div>                  
                <?php
                $i = $i + 1;
            }

            echo '</div>';
        }

        $prevlink = ($page > 1) ? '<li><a href="' .
                (isset($parm1) ? ((substr($parm1, 0, 4) == 'pag_') ? '' : '/' . str_replace(' ', '-', $parm1)) : '') .
                (isset($parm2) ? ((substr($parm2, 0, 4) == 'pag_') ? '' : '/' . str_replace(' ', '-', $parm2)) : '') .
                (isset($parm3) ? ((substr($parm3, 0, 4) == 'pag_') ? '' : '/' . str_replace(' ', '-', $parm3)) : '') .
                (isset($parm4) ? ((substr($parm4, 0, 4) == 'pag_') ? '' : '/' . str_replace(' ', '-', $parm4)) : '') . '/pag_1/" aria-label="Previous">&laquo;</a> </li> <li><a href="pag_' . ($page - 1) . '" aria-label="Previous">&lsaquo;</a></li>' : '<li class="disabled"><span aria-label="Previous">&laquo;</span> </li> <li class="disabled"><span aria-label="Previous">&lsaquo;</span></li>';

        $nextlink = ($page < $pages) ? '<li><a href="' . (isset($parm1) ? ((substr($parm1, 0, 4) == 'pag_') ? '' : '/' . str_replace(' ', '-', $parm1)) : '') .
                (isset($parm2) ? ((substr($parm2, 0, 4) == 'pag_') ? '' : '/' . str_replace(' ', '-', $parm2)) : '') .
                (isset($parm3) ? ((substr($parm3, 0, 4) == 'pag_') ? '' : '/' . str_replace(' ', '-', $parm3)) : '') .
                (isset($parm4) ? ((substr($parm4, 0, 4) == 'pag_') ? '' : '/' . str_replace(' ', '-', $parm4)) : '') . '/pag_' . ($page + 1) . '" aria-label="Next">&rsaquo;</a> </li> <li><a href="' .
                (isset($parm1) ? ((substr($parm1, 0, 4) == 'pag_') ? '' : '/' . str_replace(' ', '-', $parm1)) : '') .
                (isset($parm2) ? ((substr($parm2, 0, 4) == 'pag_') ? '' : '/' . str_replace(' ', '-', $parm2)) : '') .
                (isset($parm3) ? ((substr($parm3, 0, 4) == 'pag_') ? '' : '/' . str_replace(' ', '-', $parm3)) : '') .
                (isset($parm4) ? ((substr($parm4, 0, 4) == 'pag_') ? '' : '/' . str_replace(' ', '-', $parm4)) : '') . '/pag_' . $pages . '/" title="Last page">&raquo;</a></li>' : '<li class="disabled"><span class="disabled">&rsaquo;</span> </li> <li class="disabled"><span aria-label="Next">&raquo;</span></li>';
        if ($total > $limit) {
            ?>
            <div id="pagi" class="text-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination">


                        <?php
                        echo $prevlink;
                        for ($j = max(1, $page - 5); $j <= min($page + 5, $pages); $j++) {

                            echo '<li ' . (($j == $page) ? 'class="active"' : '' ) . '><a href="' .
                            (isset($parm1) ? ((substr($parm1, 0, 4) == 'pag_') ? '' : '/' . str_replace(' ', '-', $parm1)) : '') .
                            (isset($parm2) ? ((substr($parm2, 0, 4) == 'pag_') ? '' : '/' . str_replace(' ', '-', $parm2)) : '') .
                            (isset($parm3) ? ((substr($parm3, 0, 4) == 'pag_') ? '' : '/' . str_replace(' ', '-', $parm3)) : '') .
                            (isset($parm4) ? ((substr($parm4, 0, 4) == 'pag_') ? '' : '/' . str_replace(' ', '-', $parm4)) : '') . '/pag_' . $j . '/">' . $j . '</a></li>';
                        }
                        echo $nextlink;
                        ?>
                    </ul>
                </nav>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="snohay col-lg-12">
            <div class="cen_text">                                    
                <div class="alert alert-danger" role="alert"><b>Ups no hay datos!!.</b> Por favor intenta con otra busqueda.</div>
            </div>
        </div>

        <?php
    }
    ?>




