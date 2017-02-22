<html>
    <head>        

        <title>Página Erotica - Anuncios eroticos gratis en Colombia</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=0.5">

        <meta name="description" content="En www.paginaerotica.com puedes publicar gratuitamente tus anuncios sexuales en Colombia, 
              Si eres escorts, gay, travesti, gigolo o masajista sexual puedes postear tu anuncio y 
              posicionarte dentro de las primeras publicaciones para obtener mejores resultados.">
        <meta name="keywords" content="anuncios gratis, escorts, gay, travesti, gigolo o masajista sexual, anuncios, 
              publicaciones gratis, publicaciones, sexo, colombia, relaciones sexuales, amigas, amigos, eroticos, 
              pagina erotica, contactos sexuales, contactos, prepagos, putas, medellín, bogotá, cali">

        <link href="bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/general.css?v=<?= time(); ?>" rel="stylesheet" type="text/css"/>
        <link href="css/w3.css?v=<?= time(); ?>" rel="stylesheet" type="text/css"/>
        <script src="node_modules/jquery/dist/jquery.js" type="text/javascript"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.js" type="text/javascript"></script>
        <link href="css/bootstrap-social-gh-pages/bootstrap-social.css" rel="stylesheet" type="text/css"/>
        <link href="css/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet" type="text/css"/>

        <script src="js/index.js" type="text/javascript"></script>
        <link rel="shortcut icon" href="pag_ima/fire.ico">
        <!-- Start of StatCounter Code for Default Guide -->
<!--        <script type="text/javascript">
            var sc_project = 11256930;
            var sc_invisible = 0;
            var sc_security = "7c34bf57";
            var scJsHost = (("https:" == document.location.protocol) ?
                    "https://secure." : "http://www.");
            document.write("<sc" + "ript type='text/javascript' src='" +
                    scJsHost +
                    "statcounter.com/counter/counter.js'></" + "script>");
        </script>-->
        <noscript>
    <div class="statcounter">
        <a title="free hit
           counter" href="http://statcounter.com/" target="_blank">
            <img
                style="    visibility: hidden;width: 0;height: 0;"
                class="statcounter"
                src="//c.statcounter.com/11256930/0/7c34bf57/0/" alt="free
                hit counter">
        </a>
    </div>
    </noscript>
    <!-- End of StatCounter Code for Default Guide -->
</head>



<body >       

    <?php
    $cat = filter_input(INPUT_GET, 'cat');
    $depa = filter_input(INPUT_GET, 'depa');
    $buscar = filter_input(INPUT_GET, 'buscar');
    $mun = filter_input(INPUT_GET, 'mun');
    $idanuncio = filter_input(INPUT_GET, 'idanuncio');
    include 'header.php';

    $data_mun;
    if (!empty($depa)) {

        $data_mun = $ClDep->obtenerMun($depa);
        //print_r($data_mun);
    }
    ?>

    <div>




        <nav id="izq_panel" >


            <ul>
                <li><b>Categorias</b></li>
                <?php
                foreach ($tipo as $pos => $value) {
                    echo '<li><a href="index.php?cat=' . $value[0] . '">' . $value[1] . '</a> </li>';
                }
                ?>
            </ul>


            <ul>
                <?php
                if (empty($data_mun)) {
                    echo '<li><b>Departamentos</b></li>';
                    foreach ($dep as $pos => $value) {
                        echo '<li><a href="index.php?depa=' . $value[0] . '">' . $value[1] . '</a> </li>';
                    }
                } else {
                    echo '<li><b>Ciudad</b></li>';
                    foreach ($data_mun as $pos => $value) {
                        echo '<li><a href="index.php?mun=' . $value[0] . '">' . $value[2] . '</a> </li>';
                    }
                }
                ?>

            </ul>

        </nav>  

        <div id="contenido_1">            
            <?php
            if (isset($idanuncio)) {
                include './welcome.php';
            } else {

                include './contenido.php';
            }
            ?>
        </div>  
    </div>

    <?php
    include './footer.php';
    ?>

</body>


</html>
