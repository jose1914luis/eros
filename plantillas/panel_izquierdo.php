<div id="izq_panel">

    <nav>

        <ul>
            <li><b>Categorias</b></li>
            <?php
            foreach ($tipo as $pos => $value) {
                echo '<li itemscope itemtype="http://schema.org/SiteNavigationElement"><a class="color_a" href="/'
                . $value[1] . '/" itemprop="url"><span itemprop="name"><h2 class="h2_mod">' . $value[1] . '</h2><em class="conteo"> (' . $value[2] . ') </em></span><meta itemprop="about" content="' . $value[1] . '"/></a> </li>';
            }
            ?>
        </ul>


        <ul>
            <?php
            if ($mostrar_dep) {

                echo '<li><b>Departamentos</b></li>';
                $conDe = 0;
                foreach ($dep as $pos => $value) {
                    echo '<li id="deph_' . $conDe . '" ' . (($conDe > 10) ? 'class="hidden""' : '')
                    . ' itemscope itemtype="http://schema.org/SiteNavigationElement"><a class="color_a" href="/'
                    . $value[1] . '/" itemprop="url"><span itemprop="name">' . $value[1] . '<em class="conteo"> (' . $value[2] . ') </em></span></a> </li>';
                    $conDe = $conDe + 1;
                }
                echo '<li><a class="color_g" href="#" onclick="mostrar_dep()" ><span id="txt_dep">Ver mas... <span class= " conteo glyphicon glyphicon-triangle-bottom"></span></span></a> </li>';
            } else {

                echo '<li><b>Ciudad</b></li>';
                $conMun = 0;
                foreach ($data_mun as $pos => $value) {

                    echo '<li id="munh_' . $conMun . '" ' . (($conMun > 10) ? 'class="hidden""' : '') . 'itemscope itemtype="http://schema.org/SiteNavigationElement"><a style="color: #337ab7;" href="/' . $parm1 . '/' . $value[0] . '/" itemprop="url"><span itemprop="name">' . $value[0] . '<em class="conteo"> (' . $value[4] . ') </em></span></a> </li>';
                    $conMun = $conMun + 1;
                }
                if ($conMun > 11) {
                    echo '<li><a class="color_g"  href="#" onclick="mostrar_mun()" ><span id="txt_mun">Ver mas... <span class= " conteo glyphicon glyphicon-triangle-bottom"></span></span></a> </li>';
                }
                echo '<script> var mostrar_m_num = ' . $conMun . '; </script>';
            }
            ?>

        </ul>        

    </nav>  

    <div class="adsl">
        <!-- JuicyAds v3.0 -->
        <script async src="//adserver.juicyads.com/js/jads.js"></script>
        <ins id="585815" data-width="158" data-height="180"></ins>
        <script>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone': 585815});</script>
        <!--JuicyAds END-->
    </div>

</div>


