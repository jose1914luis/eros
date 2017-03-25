<!DOCTYPE html>
<html lang="es">
    <head>        
        <?php include './plantillas/head.php'; ?>

        <script src="/js/session.min.js" type="text/javascript"></script>
    </head>

    <body >       

        <?php
        $session = true;
        include './plantillas/header.php';
        ?>
        <br>
        <br>
        <br>
        <br>        
        <div class="container-fluid">
            <div class="col-lg-4" style="float: none;margin: 0 auto">
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
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <input  type="checkbox" aria-label="Mostrar" onchange="mostrar()">Mostrar
                                        </span>
                                        <input id="contra" type="password" class="form-control" aria-label="...">
                                    </div><!-- /input-group -->
                                </div>                               
                            </div>      
                            <div class="col-lg-12" style="text-align: center">
                                <div class="btn-group" role="group" aria-label="...">                                                                        
                                    <button type="button" class="btn btn-danger">Registrarse</button>                          
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





        <?php
        $style = "style = 'position: absolute;width: 100%;'";
        include './plantillas/footer.php';
        ?>

    </body>


</html>
