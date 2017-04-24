<!DOCTYPE html>
<html lang="es">
    <head>        
        <?php
        include './plantillas/init.php';
        include './plantillas/iniciar_parametros.php';
        ?>

        <title><?= $title ?></title>        
        <meta name="description" content="<?= $description ?>">
        <meta name="keywords" content="<?= $keywords ?>">
        <link rel="canonical" href="<?= $canonical ?>">
        <meta property="og:url"           content="<?= $canonical ?>" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="<?= $title ?>" />
        <meta property="og:description"   content="<?= $description ?>" />
        <meta property="og:image"         content="http://www.paginaerotica.com/pag_ima/pagina4.png" />

        <script src="/js/index.min.js?v=<?= VERSION ?>" type="text/javascript"></script>
        <?php
        include './plantillas/head.php';
        ?>
    </head>

    <body itemscope itemtype="http://schema.org/WebPage">       

        <div class="wrapper">
            <?php
            $idanuncio = filter_input(INPUT_GET, 'idanuncio');

            include './plantillas/header.php';
            ?>

            <div  class="cuerpo">
                <?php
                include './plantillas/panel_izquierdo.php';
                ?>
                <div id="contenido_1" itemprop="mainContentOfPage">            
                    <?php
                    if (isset($idanuncio)) {

                        include './plantillas/welcome.php';
                    } else {

                        include './plantillas/contenido.php';
                    }
                    ?>

                </div>  

            </div>
            <div class="wrapper_div"></div> <!-- wrapper-->
        </div>

        <?php
        flush();
        include './plantillas/footer.php';
        ?>

    </body>


</html>
