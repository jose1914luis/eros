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

    </head>

    <body itemscope itemtype="http://schema.org/WebPage">       

        <?php
        $cat = filter_input(INPUT_GET, 'cat');
        $depa = filter_input(INPUT_GET, 'depa');
        $buscar = filter_input(INPUT_GET, 'buscar');
        $mun = filter_input(INPUT_GET, 'mun');
        $idanuncio = filter_input(INPUT_GET, 'idanuncio');

        include './plantillas/header.php';
        ?>

        <div class="wrapper">
             <?php
             include './plantillas/panel_izquierdo.php';
             ?>
            <div id="contenido_1" itemprop="mainContentOfPage">            
                <?php
                include './plantillas/contenido.php';
                ?>
            </div>  
            <div style=" height: 100px;"></div> <!-- wrapper-->
        </div>

        <?php
        include './plantillas/footer.php';
        ?>

    </body>


</html>
