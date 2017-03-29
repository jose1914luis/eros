<!DOCTYPE html>
<html lang="es">
    <head>        
        <?php
        include './plantillas/init.php';
        include './plantillas/head.php';
        ?>
        <!--<script src="/js/index.js?v=<?= time() ?>" type="text/javascript"></script>-->
        <script src="/js/index.min.js" type="text/javascript"></script>
        <title>Página Erotica - Anuncios eroticos gratis en Colombia</title>
        <meta name="description" content="publica gratuitamente tus anuncios sexuales en Colombia, Si eres prepago, escorts, gay, travesti, gigolo o masajista sexual, anunciate y consigue clientes.">
        <meta name="keywords" content="publicaciones,gratis,anuncios,escorts,publicar,gay,travesti,gigolo,masajista sexual,relaciones,ocasionales,encontrar,contactos,sexuales,paginas,publicaciones,quiero,prepago, prepagos,colombia">

        <meta property="og:url"           content="http://www.paginaerotica.com" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="Página Erotica - Anuncios eroticos gratis en Colombia" />
        <meta property="og:description"   content="publica gratuitamente tus anuncios sexuales en Colombia, Si eres prepago, escorts, gay, travesti, gigolo o masajista sexual, anunciate y consigue clientes." />
        <meta property="og:image"         content="http://www.paginaerotica.com/pag_ima/pagina4.png" />

    </head>

    <body itemscope itemtype="http://schema.org/WebPage">       

        <div class="wrapper">
            <?php
            
              include './plantillas/iniciar_parametros.php';
//            $parm1 = filter_input(INPUT_GET, 'parm_u');
            

//            $cat = filter_input(INPUT_GET, 'cat');
//            $depa_aux = filter_input(INPUT_GET, 'depa_aux');
//            $buscar = filter_input(INPUT_GET, 'buscar');
//            $mun = filter_input(INPUT_GET, 'mun');
//            $idanuncio = filter_input(INPUT_GET, 'idanuncio');
//
//            $buscar = $cat;
//            if (isset($cat)) {
//                $cat = str_replace('-', ' ', $cat);
//            }


            include './plantillas/header.php';
            ?>


            <?php
            include './plantillas/panel_izquierdo.php';
            ?>
            <div id="contenido_1" itemprop="mainContentOfPage">            
                <?php
                include './plantillas/contenido.php';
                ?>
            </div>  
            <div class="wrapper_div"></div> <!-- wrapper-->
        </div>

        <?php
        include './plantillas/footer.php';
        ?>

    </body>


</html>
