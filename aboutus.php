<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head lang="es">
        <?php
        
        include './plantillas/head.php';
        ?>        
        <title>
            Acerca de Nosotros - Paginaerotica.com
        </title>
        <meta name="description" content="es una compañia Colombiana dedicada a la publicación de anuncios en internet. Nace como una alternativa para aquellas personas que desean ofrecer sus servicios a través de internet, utilizando las herramientas tecnológicas para llegar a más clientes.
                Nuestra plataforma permite a los usuarios tener el control sobre sus publicaciones.">
        <meta name="keywords" content="acerca, paginaerotica, paginaerotica.com, about, us">

    </head>
    <body>

        <?php
        include './bd/GetDep.php';
        $ClDep = new GetDep();
        include './plantillas/header.php';
        ?>
        <div>
            <div style="width:100%; text-align: center">
                <a href="index.php" target="_blank"><h1>¿Que es www.paginaerotica.com?</h1></a>
            </div>            

            <p class="lead"><a href="index.php" target="_blank">www.paginaerotica.com</a> es una compañia Colombiana dedicada a la publicación de anuncios en internet. Nace como una alternativa para aquellas personas que desean ofrecer sus servicios a través de internet, utilizando las herramientas tecnológicas para llegar a más clientes.
                Nuestra plataforma permite a los usuarios tener el control sobre sus publicaciones, así como del tipo de clientes que desean contactar.</p>            

            <div class="container-fluid" style="margin: auto; text-align: center">
                <div class="center-block">
                    <div class="col-lg-2">                    
                        <div class="thumbnail">
                            <img src="pag_ima/escorts.png" alt="Escorts">
                            <div class="caption">
                                <p>Acompañantes sexuales y prepagos</p>
                                <p><a href="anuncio" class="btn btn-primary" role="button">Publicar</a> <a href="index?cat=1" class="btn btn-default" role="button">Visitar</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">                    
                        <div class="thumbnail">
                            <img src="pag_ima/masajista.png" alt="Escorts">
                            <div class="caption">
                                <p>Acompañantes sexuales y prepagos</p>
                                <p><a href="anuncio" class="btn btn-primary" role="button">Publicar</a> <a href="index?cat=2" class="btn btn-default" role="button">Visitar</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">                    
                        <div class="thumbnail">
                            <img src="pag_ima/webcam.png" alt="Escorts">
                            <div class="caption">
                                <p>Acompañantes sexuales y prepagos</p>
                                <p><a href="anuncio" class="btn btn-primary" role="button">Publicar</a> <a href="index?cat=3" class="btn btn-default" role="button">Visitar</a></p>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
            <h2>Mision</h2>
            <p class="lead">Brindar una plataforma en la que los usuarios puedan ofrecer sus servicios de una manera confiable y segura a todos sus clientes.</p>

            <h2>Vision</h2>

            <p class="lead">Para el año 2017 ser la página de publicidad erotica mas reconocida en Colombia.</p>
        </div>

        <?php
        include './plantillas/footer.php';
        ?>
    </body>
</html>
