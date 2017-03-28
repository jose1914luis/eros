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
        <script src="js/funciones.min.js" type="text/javascript"></script>        
        <script src="js/register.js?v=<?= time() ?>" type="text/javascript"></script>

        <title>
            Crear cuenta  - Paginaerotica.com
        </title>

    </head>
    <body style="background-color: #f2dede;">

        <div class="wrapper">


            <?php
            include './plantillas/header.php';
            ?>

            <div class="row">  

                <div class="col-lg-6" style="float: none;margin: 0 auto">

                    <div style="text-align: center">
                        <h3>Crear Cuenta</h3>
                    </div>

                    <form id="publicar" class="form-horizontal" action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="nombre" class="col-xs-3 col-lg-3 control-label">Nombres</label>
                            <div class="col-xs-6 col-lg-6">
                                <input type="text" class="form-control" id="nombre" maxlength="50" placeholder="Nombres" name="nombre" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barrio" class="col-xs-3 col-lg-3 control-label">Apellidos</label>
                            <div class="col-xs-6 col-lg-6">
                                <input type="text" class="form-control" id="apellidos" maxlength="100" placeholder="Apellidos" name="apellidos">
                            </div>
                        </div>               

                        <div class="form-group">
                            <label for="tel" class="col-xs-3 col-lg-3 control-label" >Tel</label>
                            <div class="col-xs-7 col-lg-6">
                                <input type="tel" class="form-control" required onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="tel" id="tel" placeholder="Telefono" maxlength="25">
                            </div>
                        </div> 

                        <div class="form-group">
                            <label for="correo" class="col-xs-3 col-lg-3 control-label" >Correo</label>
                            <div class="col-xs-7 col-lg-6">
                                <input type="email" name="correo" required class="form-control" id="correo" placeholder="Correo" maxlength="100">
                            </div>
                        </div>    

                        <div class="form-group">
                            <label for="contra" class="col-xs-3 col-lg-3 control-label">Contraseña: </label>
                            <div class="col-xs-7 col-lg-6">
                                <input id="contra" name="contra" maxlength="10" type="password" class="form-control" required>                                                                
                            </div>                               
                        </div>    

                        <div class="form-group">
                            <label for="contra2" class="col-xs-3 col-lg-3 control-label">Repita Contraseña: </label>
                            <div class="col-xs-7 col-lg-6">
                                <input id="contra2" type="password" maxlength="10" name="contra2" class="form-control" required>                                                                
                            </div>                               
                        </div>    

                        <div class="form-group" style="text-align: center">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary">Crear Cuenta</button>
                            </div>
                        </div>

                        <div id="public_label"  class="loader"><b>Creando...</b><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>
                    </form>            

                </div>

                <div id="public_div" class="loader_div">


                </div>
            </div>
            <div style=" height: 100px;"></div> <!-- wrapper-->
        </div>

        <?php
//        $style = "style='position: fixed;width: 100%;'";
        include './plantillas/footer.php';
        ?>

    </body>
</html>
