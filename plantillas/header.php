<?php
include './bd/GetDep.php';
$ClDep = new GetDep();

$data_mun;
if (!empty($depa)) {

    $data_mun = $ClDep->obtenerMun($depa);
    //print_r($data_mun);
}

$tipo = $ClDep->obtenerTipoAnuncio();
$dep = $ClDep->obtenerDep();
?>

<header>

    <!--<script src="/js/header.js" type="text/javascript"></script>-->
    <script src="/js/header.min.js" type="text/javascript"></script>
    <nav class="navbar navbar-default">
        <div class="container-fluid">

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

                if ($idusuario != null) {?>
                
                    <button type="button" class="btn btn-success navbar-btn" onclick="window.location = '/panel'">                    
                        <i class="fa fa-cog" aria-hidden="true"></i></span> Panel</button>
                    </button>
                    <?php
                }
                ?>                     





            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse in" id="bs-example-navbar-collapse-1">

                <form class="navbar-form navbar-left">                    


                    <div class="row" style="margin: 0px 0px;">
                        <select id="categoria2" class="input-sm form-control" style="overflow: hidden; max-width: 33%">
                            <option value = "0">Categoría</option>
                            <?php
                            foreach ($tipo as $pos => $value) {
                                echo '<option ' . (($cat == $value[1]) ? "selected " : "") . 'value = "' . $value[1] . '">' . $value[1] . '</option>';
                            }
                            ?>

                        </select>


                        <select id="dep2" class="input-sm form-control" style="overflow: hidden; max-width: 33%">
                            <option value = "0" >Departamento</option>
                            <?php
                            foreach ($dep as $pos => $value) {
                                echo '<option ' . (($depa == $value[1]) ? "selected " : "") . 'value = "' . $value[1] . '">' . $value[1] . '</option>';
                            }
                            ?>
                        </select>

                        <select id="mun2" class="input-sm form-control" style="overflow: hidden;">   
                            <option value = "0">Ciudad</option>
                            <?php
                            foreach ($data_mun as $pos => $value) {
                                echo '<option ' . (($mun == $value[0]) ? "selected " : "") . 'value = "' . $value[0] . '">' . $value[0] . '</option>';
                            }
                            ?>
                        </select>

                        <input type="text" id="txt_buscar" class="form-control" placeholder="Palabra clave" value="<?php echo ( (isset($buscar) ? (($buscar != '0') ? $buscar : '') : '') ); ?>">
                        <button id="btn_buscar" type="button" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar</button>                                           
                    </div>                       

                </form>                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>



</header>