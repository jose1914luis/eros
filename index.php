<!DOCTYPE html>
<html lang="es">
    <head>        
        <?php include './plantillas/head.php'; ?>
        <script src="/js/index.js" type="text/javascript"></script>
    </head>

    <body >       

        <?php
        include './bd/GetDep.php';
        $ClDep = new GetDep();
        $cat = filter_input(INPUT_GET, 'cat');
        $depa = filter_input(INPUT_GET, 'depa');
        $buscar = filter_input(INPUT_GET, 'buscar');
        $mun = filter_input(INPUT_GET, 'mun');
        $idanuncio = filter_input(INPUT_GET, 'idanuncio');
        
        
        
        $data_mun;
        if (!empty($depa)) {

            $data_mun = $ClDep->obtenerMun($depa);
            //print_r($data_mun);
        }
        
        include './plantillas/header.php';

        
        ?>

        <div>

            <nav id="izq_panel" >


                <ul>
                    <li><b>Categorias</b></li>
                    <?php
                    foreach ($tipo as $pos => $value) {
                        echo '<li><a href="/' . $value[1] . '">' . $value[1] . '</a> </li>';
                    }
                    ?>
                </ul>


                <ul>
                    <?php
                    if (empty($data_mun)) {
                        echo '<li><b>Departamentos</b></li>';
                        foreach ($dep as $pos => $value) {
                            echo '<li><a href="/0/' . $value[1] . '">' . $value[1] . '</a> </li>';
                        }
                    } else {
                        echo '<li><b>Ciudad</b></li>';
                        foreach ($data_mun as $pos => $value) {
                            echo '<li><a href="/0/0/' . $value[0] . '">' . $value[0] . '</a> </li>';
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

                    include './plantillas/contenido.php';
                }
                ?>
            </div>  
        </div>

        <?php
        include './plantillas/footer.php';
        ?>

    </body>


</html>
