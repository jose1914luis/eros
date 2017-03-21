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


$tipo = $ClDep->obtenerTipoAnuncio();
$dep = $ClDep->obtenerDep();
?>

<header>

    <!--<script src="/js/header.js" type="text/javascript"></script>-->
    <script src="js/header.min.js" type="text/javascript"></script>
    <nav class="navbar navbar-default">
        <div class="container-fluid">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">                
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">                    
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Filtrar</button>
                </button>
                <a class="navbar-brand" href="/">
                    <img alt="pagina erotica" src="/../pag_ima/pagina4.png">
                </a>

                <button type="button" class="btn btn-danger navbar-btn" onclick="window.location = '/anuncio'">                    
                    <i class="fa fa-cloud-upload" aria-hidden="true"></i></span> Publicar Anuncio Gratis</button>
                </button>

            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <form class="navbar-form navbar-left">                    

                    <select id="categoria2" class="form-control" style="overflow: hidden; max-width: 160px">
                        <option value = "0">Categoría</option>
                        <?php
                        foreach ($tipo as $pos => $value) {
                            echo '<option '. (($cat==$value[1])?"selected ":"") .  'value = "' . $value[1] . '">' . $value[1] . '</option>';
                        }
                        ?>

                    </select>


                    <select id="dep2" class="form-control" style="overflow: hidden; max-width: 150px">
                        <option value = "0" >Departamento</option>
                        <?php
                        foreach ($dep as $pos => $value) {
                            echo '<option '. (($depa==$value[1])?"selected ":"") .  'value = "' . $value[1] . '">' . $value[1] . '</option>';
                        }
                        ?>
                    </select>

                    <select id="mun2" class="form-control" style="overflow: hidden; max-width: 120px">   
                        <option value = "0">Ciudad</option>
                        <?php
                        foreach ($data_mun as $pos => $value) {
                            echo '<option '. (($mun==$value[0])?"selected ":"") .  'value = "' . $value[0] . '">' . $value[0] . '</option>';
                        }
                        ?>
                    </select>
                    <div class="form-group">
                        <input type="text" id="txt_buscar" class="form-control" placeholder="Palabra clave" value="<?php echo ((isset($buscar))?$buscar:''); ?>">
                        <button id="btn_buscar" type="button" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar</button>

                        <?php if (!isset($session)) { ?>
                        <button id="btn_session" mostrar="<?= $salir ?>" type="button" onclick="window.location = '<?php echo ($salir) ? '#' : "session" ?>'" class="btn btn-primary">
                        <?php echo ($salir) ? 'Salir <i class="fa fa-lg fa-sign-out" aria-hidden="true"></i>' : '<i class="fa fa-sign-in" aria-hidden="true"></i> Iniciar Sesión'; ?></button>                                                            
                        <?php } ?>                        
                    </div>                       

                </form>                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>



</header>