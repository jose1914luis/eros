<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//************Valido si el usuario ingreso
$super = 0;
$salir = 0;
$idusuario = null;
if (isset($_SESSION['user_session'])) {
    $idusuario = $_SESSION['user_session'];
    $salir = 1;
    if ($_SESSION['tipo'] == 'admin') {

        $super = 1;
    }
}
//***************************************

include './bd/GetDep.php';

$ClDep = new GetDep();
$tipo = $ClDep->obtenerTipoAnuncio();
$dep = $ClDep->obtenerDep();
?>

<header>

    <!--<script src="js/header.js?v=<?= time() ?>" type="text/javascript"></script>-->
    <script src="js/header.min.js" type="text/javascript"></script>
    <div id="cabeza">

        <form class="navbar-form" style="margin-top: 0px;padding-top: 10px;">

            <div class="form-group" >
                <a class="navbar-brand" href="index.php" style="padding-top: 0px;">
                    <img id="logo_img" src="pag_ima/pagina4.png" alt="pagina erotica" width="80%" height="80%">
                </a>


                <div class="input-group input-group-sm" style="width: 304px">
                    <input id="txt_buscar" type="text" class="form-control" placeholder="Buscar..." >
                    <span class="input-group-btn">
                        <button id="btn_buscar" class="btn btn-default" type="button">
                            <span class="glyphicon glyphicon-search"/>
                        </button>
                    </span>
                </div><!-- /input-group -->

                <select id="categoria2" class="form-control input-sm" style="width: 180px;">
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
                </select>




                <div>
                    <a class="btn btn-xs" style="font-size: 1.2em; padding-top: 10px" href="anuncio"><span class="label label-danger" style="padding: .5em .5em .5em; cursor: pointer">Publicar anuncio Gratis <i class="fa fa-font-awesome" aria-hidden="true"></i></span></a>
                    <?php if (!isset($session)) { ?>
                        <a id="btn_session" mostrar="<?= $salir ?>" class="btn btn-xs" style="font-size: 1.2em; padding-top: 10px" href="<?php echo ($salir) ? '#' : "session" ?>" >
                            <span class="label label-primary" style="padding: .5em .5em .5em;cursor: pointer">
                                <?php echo ($salir) ? 'Salir <span class="fa fa-lg fa-sign-out" aria-hidden="true"></span>' : 'Iniciar Sesión <span class="fa fa-lg fa-sign-in " aria-hidden="true"></span>'; ?></span></a>                    
                            <?php } ?>
                    <a class="btn btn-social btn-xs btn-facebook" style="top: 5px;padding-bottom: 4.2px;padding-top: 4.3px;"href="https://www.facebook.com/paginaerotica/" target="_blank"><span style="padding-top: 3px;" class="fa fa-facebook"></span><b>Facebook</b></span></a>
                    <!--                    <div style="float: right;padding-right: 20px;padding-top: 8px;">
                                        <span class="label" style="color:#000;padding-top: 5px">siguenos:</a>    
                                        </div>-->

                </div>
            </div>
        </form>                

    </div>



</header>