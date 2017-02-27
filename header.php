<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include './bd/GetDep.php';

$ClDep = new GetDep();
$tipo = $ClDep->obtenerTipoAnuncio();
$dep = $ClDep->obtenerDep();
?>

<header>

    <script src="js/header.js?v=<?= time(); ?>" type="text/javascript"></script>
    <div id="cabeza">

        <form class="navbar-form" style="margin-top: 0px;padding-top: 10px;">

            <div class="form-group" >
                <a class="navbar-brand" href="index.php" style="padding-top: 0px;">
                    <img id="logo_img" src="pag_ima/pagina4.png" alt="pagina erotica" >
                </a>
                <select id="categoria2" class="form-control input-sm" style="width: 180px; float: left">
                    <option value = "0">Categoria</option>
                    <?php
                    foreach ($tipo as $pos => $value) {
                        echo '<option value = "' . $value[0] . '">' . $value[1] . '</option>';
                    }
                    ?>

                </select>

                <select id="dep2" class="form-control input-sm" style="width: 180px">
                    <option value = "0">Departamento</option>
                    <?php
                    foreach ($dep as $pos => $value) {
                        echo '<option value = "' . $value[0] . '">' . $value[1] . '</option>';
                    }
                    ?>

                </select>

                <select id="mun2" class="form-control input-sm" style="overflow: hidden; max-width: 120px">   
                    <option value = "0">Ciudad</option>
                </select>


                <div class="input-group input-group-sm" style="width: 304px">
                    <input id="txt_buscar" type="text" class="form-control" placeholder="Buscar..." >
                    <span class="input-group-btn">
                        <button id="btn_buscar" class="btn btn-default" type="button">
                            <span class="glyphicon glyphicon-search"/>
                        </button>
                    </span>
                </div><!-- /input-group -->

                <div>
                    <a class="btn btn-xs" style="font-size: 1.2em; padding-top: 10px" href="anuncio"><span class="label label-danger" style="cursor: pointer">Publicar anuncio Gratis</span></a>
                    <a class="btn btn-xs" style="font-size: 1.2em; padding-top: 10px" href="#" data-toggle="modal" data-target="#myModal"><span class="label label-primary" style="cursor: pointer">Iniciar Sesión</span></a>
                    <div style="float: right;padding-right: 6px;padding-top: 8px;">
                    <span class="label" style="color:#000;padding-top: 5px">siguenos en:</span><a class="btn btn-social btn-xs btn-facebook" style="top: 5px"href="https://www.facebook.com/paginaerotica/" target="_blank"><span class="fa fa-facebook"></span>Facebook</a>    
                    </div>
                    
                </div>


<!--<a href="https://www.facebook.com/paginaerotica/" target="_blank" style="padding-top: 12px !important;"> <h5 style="font-size: 20px;"><span class="label" style="cursor: pointer; color: #333;" >Siguenos en :</span><span class="label" style="cursor: pointer; background-color: #3b5998; color: #fff;" ><span class="fa fa-facebook fa-1x"></span> | Facebook</span></h5></a>-->

            </div>
        </form>

        <div class="modal fade"  id="myModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding: 2px 5px;"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Iniciar Sesión</h4>
                    </div>
                    <div class="modal-body">
                        <div id="alt_correo" class="alert alert-info" role="alert">
                            Escribe tu correo electronico y presiona enviar, se te enviara una contraseña temporal.                            
                        </div>
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="usuario" class="col-sm-2 control-label">Correo: </label>
                                <div class="col-sm-10">
                                    <input id="usuario" type="text" class="form-control">    
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="contra" class="col-sm-2 control-label">Contraseña: </label>
                                <div class="col-sm-10">
                                    <input id="contra" type="password" class="form-control">    
                                </div>
                            </div>                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" onclick="$('#alt_correo').show()" style="float: left;">Olvide la contraseña</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary">Iniciar Sesión</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>



</header>