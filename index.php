<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
        include 'header.php';
        ?>

        <nav id="izq_panel" >


            <ul>
                <li><b>Categorias</b></li>
                <?php
                foreach ($tipo as $pos => $value) {
                    echo '<li><a href="#">' . $value[1] . '</a> </li>';
                }
                ?>
            </ul>

            <ul>
                <li><b>Departamentos</b></li>
                <?php
                foreach ($dep as $pos => $value) {
                    echo '<li><a href="#">' . $value[1] . '</a> </li>';
                }
                ?>
            </ul>

        </nav>  

        <div id="contenido_1">            
            <?php
            include './contenido.php';
            ?>
        </div>

    </body>


</html>
