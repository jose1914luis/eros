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
    <div>


        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">

                    <a class="navbar-brand" href="index.php">
                        <img src="pag_ima/pagina4.png" alt="pagina erotica" width="245px" height="83px">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#">
                                <select id="categoria2" class="form-control input-sm">
                                    <option value = "0">Selecciona</option>
                                    <?php
                                    foreach ($tipo as $pos => $value) {
                                        echo '<option value = "' . $value[0] . '">' . $value[1] . '</option>';
                                    }
                                    ?>

                                </select>
                            </a>
                        </li> 

                        <li>
                            <a href="#">
                                <select id="dep2" class="form-control input-sm">
                                    <option value = "0">Selecciona</option>
                                    <?php
                                    foreach ($dep as $pos => $value) {
                                        echo '<option value = "' . $value[0] . '">' . $value[1] . '</option>';
                                    }
                                    ?>

                                </select>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <select id="mun2" class="form-control input-sm" style="overflow: hidden; max-width: 120px">   
                                    <option value = "0">Selecciona</option>
                                </select>
                            </a>
                        </li>

                    </ul>
                    <form class="navbar-form navbar-left" style="margin-top: 15.5px;">
                        <div class="input-group input-group-sm">
                            <input id="txt_buscar" type="text" class="form-control" placeholder="Buscar..." >
                            <span class="input-group-btn">
                                <button id="btn_buscar" class="btn btn-default" type="button">
                                    <span class="glyphicon glyphicon-search"/>
                                </button>
                            </span>
                        </div><!-- /input-group -->
                    </form>
                    <ul class="nav navbar-nav navbar-left">

<!--<a class="btn btn-social btn-xs btn-facebook" ><span class="fa fa-facebook"></span>Facebook</a>-->


                        <li><a href="anuncio" style="padding-top: 12px !important; margin-right: 35px"><h5 style="font-size: 20px;"> <span class="label label-danger" style="cursor: pointer">Publicar anuncio Gratis</span></h5></a></li>                           
                        <li><h5 style="font-size: 20px; padding-top: 12px !important;"><span class="label" style="cursor: pointer; color: #333;" >Siguenos en :</span></h5></li>
                        <li><a href="https://www.facebook.com/paginaerotica/" target="_blank" style="padding-top: 12px !important;"> <h5 style="font-size: 20px;"><span class="label" style="cursor: pointer; background-color: #3b5998; color: #fff;" ><span class="fa fa-facebook fa-1x"></span> | Facebook</span></h5></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>
</header>