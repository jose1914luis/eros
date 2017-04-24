<!DOCTYPE html>
<html lang="es">
    <head>        

        <?php
        include './plantillas/init.php';
        if ($idusuario != null) {

            header("Location:/panel");
        }
        include './plantillas/head.php';
        ?>

        <script src="/js/session.min.js?v=<?= VERSION ?>" type="text/javascript"></script>
        <title>Iniciar Sesión - Paginaerotica.com</title>
    </head>

    <body style="background-color: #f2dede;">       

        <div class="wrapper">


            <?php
            $session = true;
            include './plantillas/header.php';
            ?>


            <div class="container-fluid">

                <ol id="top_anuncio" class="breadcrumb" style="color: #337ab7;">
                    <li><a href="http://www.paginaerotica.com/"><h1 class="h1_mod"><span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>Anuncios Eroticos Colombia</h1></a></li>

                </ol>

                <br>
                <br>
                <br>

                <div class="col-md-4 col-lg-4" style="float: none;margin: 0 auto">



                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><b>Iniciar Sesión</b></h3>                       

                        </div>
                        <div class="panel-body">
                            <div id="alt_correo" class="alert alert-info" role="alert">
                                Escribe tu correo electronico y presiona enviar, se te enviara una contraseña temporal.                            
                            </div>
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="usuario" class="col-lg-4 control-label">Correo: </label>
                                    <div class="col-lg-8">
                                        <input id="usuario" type="text" class="form-control">    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="contra" class="col-lg-4 control-label">Contraseña: </label>
                                    <div class="col-lg-8">
                                        <input id="contra" type="password" class="form-control" aria-label="...">                                    
                                        <input  type="checkbox" style="margin-top: 10px;" aria-label="Mostrar" onchange="mostrar()"><span> Mostrar</span>
                                    </div>                               
                                </div>      
                                <div class="col-lg-12" style="text-align: center">
                                    <div class="btn-group" role="group" aria-label="...">                                                                        
                                        <button type="button" class="btn btn-danger" onclick="window.location = '/register'">Crear Cuenta</button>                          
                                        <button id="btn_ini" type="button" class="btn btn-primary" onclick="iniciarSession()">Iniciar Sesión</button>
                                    </div><br>
                                    <br>
                                    <a>olvide mi contraseña</a>
                                </div>    

                            </form>
                        </div>
                    </div>
                </div>
            </div>



            <div class="wrapper_div"></div> <!-- wrapper-->
        </div>
        <?php
        include './plantillas/footer.php';
        ?>

    </body>


</html>
