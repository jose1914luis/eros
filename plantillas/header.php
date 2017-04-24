<?php
include './bd/GetDep.php';
$ClDep = new GetDep();


$data_mun;

$tipo = $ClDep->obtenerTipoAnuncio();
$dep = $ClDep->obtenerDep();

$mostrar_dep = true;
if (!empty($parm1) || !empty($parm2)) {


    foreach ($dep as $pos => $value) {

        if ($value[1] == $parm1 || $value[1] == $parm2) {
            $mostrar_dep = false;
            $data_mun = $ClDep->obtenerMun($parm1);
            if ($data_mun == false) {
                $data_mun = $ClDep->obtenerMun($parm2);
            }
        }
    }
}
?>


<header class="header_div">

    <!--<script src="/js/header.js?v=<?= time() ?>" type="text/javascript"></script>-->
    <script src="/js/header.min.js?v=<?= VERSION ?>" type="text/javascript"></script>
    <nav class="navbar navbar-default">
        <div class="container-fluid">

            <div>

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">                

                    <a class="navbar-brand" href="/" itemprop="url">
                        <img itemprop="primaryImageOfPage" alt="pagina erotica" src="/../pag_ima/pagina4.png">
                    </a>                

                    <button type="button" class="btn btn-danger navbar-btn" onclick="window.location = '/anuncio'">                    
                        <i class="fa fa-cloud-upload" aria-hidden="true"></i></span> Publicar Anuncio</button>
                    </button>

                    <?php if (!isset($session)) { ?>
                        <button id="btn_session" mostrar="<?= $salir ?>" type="button" onclick="window.location = '<?php echo ($salir) ? '#' : "/session" ?>'" class="btn btn-primary">
                            <?php echo ($salir) ? 'Salir <i class="fa fa-lg fa-sign-out" aria-hidden="true"></i>' : '<i class="fa fa-user" aria-hidden="true"></i> Entrar'; ?></button>                                                            
                        <?php
                    }

                    if ($idusuario != null) {
                        ?>

                        <button type="button" class="btn btn-success navbar-btn" onclick="window.location = '/panel'">                    
                            <i class="fa fa-cog" aria-hidden="true"></i></span> Panel</button>
                        </button>
                        <?php
                    }
                    ?>                     





                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse in" id="bs-example-navbar-collapse-1">

                    <form id="form_buscar" class="navbar-form navbar-left">                    


                        <div class="full_row row">
                            <select id="categoria2" class="header_combox form-control">
                                <option value = "0">Categoría</option>
                                <?php
                                foreach ($tipo as $pos => $value) {
                                    echo '<option ' . (($parm1 == $value[1]) ? "selected " : "") . 'value = "' . $value[1] . '">' . $value[1] . '</option>';
                                }
                                ?>

                            </select>


                            <select id="dep2" class="header_combox form-control">
                                <option value = "0" >Departamento</option>
                                <?php
                                foreach ($dep as $pos => $value) {
                                    echo '<option ' . (($parm1 == $value[1] || $parm2 == $value[1]) ? "selected " : "") . 'value = "' . $value[1] . '">' . $value[1] . '</option>';
                                }
                                ?>
                            </select>

                            <select id="mun2" class="ocultar form-control">   
                                <option value = "0">Ciudad</option>
                                <?php
                                foreach ($data_mun as $pos => $value) {

                                    echo '<option ' . (($parm2 == $value[0] || $parm3 == $value[0]) ? "selected " : "") . 'value = "' . $value[0] . '">' . $value[0] . '</option>';
                                }
                                ?>
                            </select>

                            <input type="text" id="txt_buscar" class="form-control" placeholder="Palabra clave" value="">
                            <button id="btn_buscar" type="button" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar</button>                                           
                        </div>                       

                    </form>                
                </div><!-- /.navbar-collapse -->

            </div>
        </div><!-- /.container-fluid -->
    </nav>



</header>