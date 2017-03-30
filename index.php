<!DOCTYPE html>
<html lang="es">
    <head>        
        <?php
        include './plantillas/init.php';
        include './plantillas/head.php';
        include './plantillas/iniciar_parametros.php';        

        //$description = "Busca y Publica gratis tu anuncios  de sexuales en Colombia, Si eres prepago, escorts, gay, travesti, gigolo o masajista sexual, anunciate y consigue clientes.";
        $title = "Anuncios gratis de";   
        $description = "Busca y Publica gratis tus anuncios de";
        if ($paginador->categoria != "") {
            $title .= " $paginador->categoria";
            $description .= " $paginador->categoria";
            if ($paginador->departamento != "") {
                $title .= " en $paginador->departamento";
                $description .= " en $paginador->departamento";
                if ($paginador->municipio != "") {
                    $title .= ", $paginador->municipio";
                    $description .= ", $paginador->municipio";
                }
            }else{
                $title .=" en Colombia";
                $description .=" en Colombia";
            }
        } elseif ($paginador->departamento != "") {
            $title .= " en $paginador->departamento";
            $description = "Busca y Publica gratis tus anuncios eroticos en $paginador->departamento";
            if ($paginador->municipio != "") {
                $title .= ", $paginador->municipio";
                $description .= ", $paginador->municipio";
            }
        } else {
            $title .=" Eroticos gratis en Colombia";
            $description = "Busca y Publica gratis tus anuncios eroticos en Colombia";
        }
        $title .=" - Paginaerotica.com";
        
        $description .= ". Anuncios eroticos gratis en Paginaerotica.com";
        
        ?>
        <!--<script src="/js/index.js?v = <? = time()
            ?>" type="text/javascript"></script>-->
        <script src="/js/index.min.js" type="text/javascript"></script>
        <title><?= $title ?></title>
        <meta name="description" content="<?= $description ?>">
        <meta name="keywords" content="publicaciones,gratis,anuncios,escorts,publicar,gay,travesti,gigolo,masajista sexual,relaciones,ocasionales,encontrar,contactos,sexuales,paginas,publicaciones,quiero,prepago,prepagos,colombia">
        <meta property="og:url"           content="http://www.paginaerotica.com" />
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
