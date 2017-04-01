<!DOCTYPE html>
<html lang="es">
    <head>        
        <?php
        include './plantillas/init.php';
        include './plantillas/head.php';
        include './plantillas/iniciar_parametros.php';

        //$description = "Busca y Publica gratis tu anuncios  de sexuales en Colombia, Si eres prepago, escorts, gay, travesti, gigolo o masajista sexual, anunciate y consigue clientes.";
        ?>
        <!--<script src="/js/index.js?v = <? = time()
            ?>" type="text/javascript"></script>-->
        <script src="/js/index.min.js" type="text/javascript"></script>
        <title><?= $title ?></title>
        <meta name="description" content="<?= $description ?>">
        <meta name="keywords" content="<?= $keywords ?>">
        <link rel="canonical" href="<?= $canonical ?>">

        <meta property="og:url"           content="<?= $canonical ?>" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="<?= $title ?>" />
        <meta property="og:description"   content="<?= $description ?>" />
        <meta property="og:image"         content="http://www.paginaerotica.com/pag_ima/pagina4.png" />

    </head>

    <body itemscope itemtype="http://schema.org/WebPage">       

        <div class="wrapper">
            <?php
            $idanuncio = filter_input(INPUT_GET, 'idanuncio');

            include './plantillas/header.php';
            ?>


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
            <div class="wrapper_div"></div> <!-- wrapper-->
        </div>

        <?php
//        ob_flush();
        flush();
        include './plantillas/footer.php';
        ?>

    </body>


</html>
