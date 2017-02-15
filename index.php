<html>
    <head>
        <meta charset="UTF-8">
        <title>Eros</title>
        <link href="bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/general.css?v=<?= time(); ?>" rel="stylesheet" type="text/css"/>
        <link href="css/w3.css" rel="stylesheet" type="text/css"/>
        <script src="node_modules/jquery/dist/jquery.js" type="text/javascript"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.js" type="text/javascript"></script>
        <!--<script src="js/index.js" type="text/javascript"></script>-->
    </head>



    <body id="body_index">       

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

    </body>


</html>
