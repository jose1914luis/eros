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
                <a class="navbar-brand" href="index.php">
                    <img src="pag_ima/pagina4.png" alt="pagina erotica" width="245px" height="83px">
                </a>
                <select id="categoria2" class="form-control input-sm" style="width: 180px; float: left">
                    <option value = "0">Selecciona</option>
                    <?php
                    foreach ($tipo as $pos => $value) {
                        echo '<option value = "' . $value[0] . '">' . $value[1] . '</option>';
                    }
                    ?>

                </select>

                <select id="dep2" class="form-control input-sm" style="width: 180px">
                    <option value = "0">Selecciona</option>
                    <?php
                    foreach ($dep as $pos => $value) {
                        echo '<option value = "' . $value[0] . '">' . $value[1] . '</option>';
                    }
                    ?>

                </select>

                <select id="mun2" class="form-control input-sm" style="overflow: hidden; max-width: 120px">   
                    <option value = "0">Selecciona</option>
                </select>


                <div class="input-group input-group-sm" style="width: 200px">
                    <input id="txt_buscar" type="text" class="form-control" placeholder="Buscar..." >
                    <span class="input-group-btn">
                        <button id="btn_buscar" class="btn btn-default" type="button">
                            <span class="glyphicon glyphicon-search"/>
                        </button>
                    </span>
                </div><!-- /input-group -->

                <div>
                    <a class="btn btn-xs" style="font-size: 1.2em; padding-top: 10px" href="anuncio"><span class="label label-danger" style="cursor: pointer">Publicar anuncio Gratis</span></a>                
                    <span class="label" style="color:#000;padding-top: 5px">siguenos en:</span><a class="btn btn-social btn-xs btn-facebook" style="top: 5px"href="https://www.facebook.com/paginaerotica/" target="_blank"><span class="fa fa-facebook"></span>Facebook</a>
                </div>


<!--<a href="https://www.facebook.com/paginaerotica/" target="_blank" style="padding-top: 12px !important;"> <h5 style="font-size: 20px;"><span class="label" style="cursor: pointer; color: #333;" >Siguenos en :</span><span class="label" style="cursor: pointer; background-color: #3b5998; color: #fff;" ><span class="fa fa-facebook fa-1x"></span> | Facebook</span></h5></a>-->

            </div>
        </form>

    </div>
</header>