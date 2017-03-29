<nav id="izq_panel">

    <ul>
        <li><b>Categorias</b></li>
        <?php
        foreach ($tipo as $pos => $value) {
            echo '<li itemscope itemtype="http://schema.org/SiteNavigationElement"><a style="color: #337ab7;" href="/' . $value[1] . '/" itemprop="url"><span itemprop="name">' . $value[1] . '<em class="conteo"> (' . $value[2] . ') </em></span><meta itemprop="about" content="' . $value[1] . '"/></a> </li>';
        }
        ?>
    </ul>


    <ul>
        <?php
        if ($mostrar_dep) {

            echo '<li><b>Departamentos</b></li>';
            $conDe = 0;
            foreach ($dep as $pos => $value) {
                echo '<li id="deph_' . $conDe . '" ' . (($conDe > 10) ? 'class="hidden""' : '') . ' itemscope itemtype="http://schema.org/SiteNavigationElement"><a style="color: #337ab7;" href="/' . $value[1] . '/" itemprop="url"><span itemprop="name">' . $value[1] . '<em class="conteo"> (' . $value[2] . ') </em></span></a> </li>';
                $conDe = $conDe + 1;
            }
            echo '<li><a style="color: #666;" href="#" onclick="mostrar_dep()" ><span id="txt_dep">Ver mas... <span class= " conteo glyphicon glyphicon-triangle-bottom"></span></span></a> </li>';
        } else {

            echo '<li><b>Ciudad</b></li>';
            $conMun = 0;
            foreach ($data_mun as $pos => $value) {

                echo '<li id="munh_' . $conMun . '" ' . (($conMun > 10) ? 'class="hidden""' : '') . 'itemscope itemtype="http://schema.org/SiteNavigationElement"><a style="color: #337ab7;" href="/' . $parm1 . '/' . $value[0] . '/" itemprop="url"><span itemprop="name">' . $value[0] . '<em class="conteo"> (' . $value[4] . ') </em></span></a> </li>';
                $conMun = $conMun + 1;
            }
            if ($conMun > 11) {
                echo '<li><a style="color: #666;"  href="#" onclick="mostrar_mun()" ><span id="txt_mun">Ver mas... <span class= " conteo glyphicon glyphicon-triangle-bottom"></span></span></a> </li>';
            }
            echo '<script> var mostrar_m_num = ' . $conMun . '; </script>';
        }
        ?>

    </ul>

</nav>  