<!DOCTYPE html>
<html lang="es">
    <head>

        <?php
        if(!isset($_GET)){
            header("Location:/");
        }
        
        include './plantillas/head.php';
        ?>                
        <script src="/js/denunciar.js?v=<?= time() ?>" type="text/javascript"></script>

        </noscript>

    </head>
    <body style="background-color: #f2dede;">

        <?php
        include './plantillas/header.php';                
        include './bd/Anuncio.php';
        $idanuncio = filter_input(INPUT_GET, 'idanuncio');
        $anuncio = new Anuncio();
        $datos = $anuncio->getAnunciosxID($idanuncio);
        
        ?>

        <div class="row">  

            <div class="col-lg-6" style="float: none;margin: 0 auto">

                <div style="text-align: center">
                    <h3>Denunciar</h3>
                </div>

                <form id="publicar" class="form-horizontal" action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="nombre" class="col-xs-4 col-lg-4 control-label">Nombres</label>
                        <div class="col-xs-6 col-lg-6">
                            <input type="text" class="form-control" id="nombre" maxlength="50" placeholder="Nombres" name="nombre" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="barrio" class="col-xs-4 col-lg-4 control-label">Apellidos</label>
                        <div class="col-xs-6 col-lg-6">
                            <input type="text" class="form-control" id="apellidos" maxlength="100" placeholder="Apellidos" name="apellidos" required>
                        </div>
                    </div>               

                    <div class="form-group">
                        <label for="correo" class="col-xs-4 col-lg-4 control-label" >Correo</label>
                        <div class="col-xs-7 col-lg-6">
                            <input type="email" name="correo" required class="form-control" id="correo" placeholder="Correo" maxlength="100">
                        </div>
                    </div>    
                    
                    <div class="form-group">
                        <label for="correo" class="col-xs-4 col-lg-4 control-label" >Anuncio</label>
                        <div class="col-lg-8">
                            <input type="text" disabled name="correo" required class="form-control" id="correo" value="<?= $datos['titulo']?>" required>
                            <input type="hidden" value="<?= $datos['idanuncio']?>" required>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label for="correo" class="col-xs-4 col-lg-4 control-label" >¿Por que denuncias?</label>
                        <div class="col-lg-8">
                            <textarea id="editor" style="" class="form-control" rows="8" placeholder="Descripcion de tu anuncio" ></textarea>
                        </div>
                    </div>
                  
                    <div class="form-group" style="text-align: center">
                        <div class="col-lg-12">
                            <button type="submit" id="denunciar" class="btn btn-danger">Denunciar</button>
                        </div>
                    </div>

                    <div id="public_label"  class="loader"><b>Denunciando...</b><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>
                </form>            

            </div>

            <div id="public_div" class="loader_div">


            </div>
        </div>
        <?php
        $style = "style='position: fixed;width: 100%;'";
        include './plantillas/footer.php';
        ?>

    </body>
</html>
