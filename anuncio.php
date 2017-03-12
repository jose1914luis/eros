<!DOCTYPE html>
<html lang="es">
    <head>

        <?php
        include './plantillas/head.php';
        ?>
        <link href="CLEditor1_4_5/jquery.cleditor.css" rel="stylesheet" type="text/css"/>
        <script src="CLEditor1_4_5/jquery.cleditor.min.js" type="text/javascript"></script>
        <script src="js/jquery.formatCurrency-1.4.0.js" type="text/javascript"></script>
        <script src="js/funciones.min.js" type="text/javascript"></script>
        <script src="js/anuncio.min.js" type="text/javascript"></script>
        <!--<script src="js/anuncio.js?v=<?= time() ?>" type="text/javascript"></script>-->
    </head>
    <body>

        <?php
        include './plantillas/header.php';
        ?>

        <div id="anuncio">  


            <form id="publicar" class="form-horizontal" action="" method="post" enctype="multipart/form-data">


                <legend style="width: 900px; padding-left: 20px">Publicar anuncio</legend>
                <div id="div_alerta" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>                    
                </div>
                <div class="form-group">
                    <label for="categoria" class="col-sm-2 control-label">Categoria</label>
                    <div class="col-sm-2">
                        <select id="categoria" required class="form-control" name="tipo_anuncio" >
                            <?php
                            foreach ($tipo as $pos => $value) {
                                echo '<option value = "' . $value[0] . '">' . $value[1] . '</option>';
                            }
                            ?>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="dep" class="col-sm-2 control-label">Departamento</label>
                    <div class="col-sm-2">
                        <select id="dep" class="form-control"  name="mun_iddep" required>
                            <option value = "0">Selecciona</option>
                            <?php
                            foreach ($dep as $pos => $value) {
                                echo '<option value = "' . $value[0] . '">' . $value[1] . '</option>';
                            }
                            ?>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="mun" class="col-sm-1 control-label" >Ciudad</label>
                        <div class="col-sm-2">
                            <select id="mun" class="form-control" required name="mun_idmun">   
                            </select>
                        </div>
                    </div>

                </div>                  

                <div class="form-group">
                    <label for="barrio" class="col-sm-2 control-label">Barrio</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="barrio" maxlength="50" placeholder="Barrio" name="barrio">
                    </div>
                </div>

                <div class="form-group">
                    <label for="titulo" class="col-sm-2 control-label" >Titulo</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="titulo" required maxlength="100" placeholder="Titulo"  name="titulo">
                    </div>
                </div>


                <div class="form-group">
                    <label for="titulo" class="col-sm-2 control-label">Descripcion</label>
                    <div class="col-sm-6">
                        <textarea id="editor" name="texto" style="" placeholder="Descripcion de tu anuncio"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="barrio" class="col-sm-2 control-label">Datos (Opcionales):</label>
                    <div class="form-group">
                        <label for="edad" class="col-sm-1 control-label" id="lbl_edad">Edad</label>
                        <div class="col-sm-1">
                            <input type="text" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" class="form-control" id="edad" maxlength="3" placeholder="años" name="edad">
                        </div>

                        <label for="altura" class="col-sm-1 control-label" id="lbl_altura">Altura</label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="altura" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="4" placeholder="altura cm." name="altura">
                        </div>

                        <label for="tarifa" class="col-sm-1 control-label" id="lbl_tarifa">Tarifa Minima</label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="12" onkeyup="$('#tarifa').formatCurrency({roundToDecimalPlace: 0}).val()" id="tarifa" placeholder="tarifa COP" name="tarifa">
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label for="web" class="col-sm-2 control-label">Pagina Web</label>
                    <div class="col-sm-6">
                        <input type="text" name="web" class="form-control" id="correo" placeholder="Web" maxlength="100">
                    </div>
                </div>

                <div class="form-group">
                    <label for="correo" class="col-sm-2 control-label" >Correo</label>
                    <div class="col-sm-6">
                        <input type="email" name="email" required class="form-control" id="correo" placeholder="Correo" maxlength="100">
                    </div>
                </div>     

                <div class="form-group">
                    <label for="tel" class="col-sm-2 control-label" >Tel</label>
                    <div class="col-sm-3">
                        <input type="tel" class="form-control" required onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="tel" id="tel" placeholder="Telefono" maxlength="15">
                    </div>
                </div> 

                <div class="form-group">
                    <label for="fotos" class="col-sm-2 control-label">Fotos</label>
                    <div id="con_img">
                        <div class="div_img">
                            <span id='btn_close_1' class="close" >&#10006</span>
                            <img id="image_1" name="image_1" class="image" src="" alt="pagina erotica">
                            <span id="btn_mas_1" class="btn_mas fa fa-camera-retro fa-3x" ></span>
                            <input id="file_1" class="file" type="file" >
                        </div>
                        <div class="div_img">
                            <span id='btn_close_2' class="close" >&#10006</span>
                            <img id="image_2" class="image" src="" alt="pagina erotica">
                            <span id="btn_mas_2" class="btn_mas fa fa-camera-retro fa-3x" ></span>
                            <input id="file_2" class="file" type="file">
                        </div>
                        <div class="div_img">
                            <span id='btn_close_3' class="close" >&#10006</span>
                            <img id="image_3" class="image" src="" alt="pagina erotica">
                            <span id="btn_mas_3" class="btn_mas fa fa-camera-retro fa-3x" ></span>
                            <input  id="file_3" class="file" type="file" >
                        </div>
                        <div class="div_img">
                            <span id='btn_close_4' class="close" >&#10006</span>
                            <img id="image_4" class="image" src="" alt="pagina erotica">
                            <span id="btn_mas_4" class="btn_mas fa fa-camera-retro fa-3x" ></span>
                            <input id="file_4" class="file" type="file">
                        </div>
                        <div class="div_img">
                            <span id='btn_close_5' class="close" >&#10006</span>
                            <img id="image_5" class="image" src="" alt="pagina erotica">
                            <span id="btn_mas_5" class="btn_mas fa fa-camera-retro fa-3x" ></span>
                            <input  id="file_5" class="file" type="file" >
                        </div>
                        <div class="div_img">
                            <span id='btn_close_6' class="close" >&#10006</span>
                            <img id="image_6" class="image" src="" alt="pagina erotica">
                            <span id="btn_mas_6" class="btn_mas fa fa-camera-retro fa-3x" ></span>
                            <input  id="file_6" class="file" type="file" >
                        </div>
                        <div class="div_img">
                            <span id='btn_close_7' class="close" >&#10006</span>
                            <img id="image_7" class="image" src="" alt="pagina erotica">
                            <span id="btn_mas_7" class="btn_mas fa fa-camera-retro fa-3x" ></span>
                            <input  id="file_7" class="file" type="file" >
                        </div>
                        <div class="div_img">
                            <span id='btn_close_8' class="close" >&#10006</span>
                            <img id="image_8" class="image" src="" alt="pagina erotica">
                            <span id="btn_mas_8" class="btn_mas fa fa-camera-retro fa-3x" ></span>
                            <input  id="file_8" class="file" type="file" >
                            <input type="hidden" name="numfiles" id="numfiles" value="0">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" checked="true" required > <a href="termcondi.php" target="_blank">Acepto Terminos y Condiciones</a>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Publicar</button>
                    </div>
                </div>

                <div id="public_label"  class="loader"><b>Publicando...</b><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>
            </form>            

        </div>

        <div id="public_div" class="loader_div">
            
        </div>
        <?php
        include './plantillas/footer.php';
        ?>

    </body>
</html>
