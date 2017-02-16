<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Página Erotica - Anuncios eroticos gratis en Colombia</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=0.5">

        <meta name="description" content="En PaginaErotica.com puedes publicar gratuitamente tus anuncios sexuales en Colombia, 
              Si eres escorts, gay, travesti, gigolo o masajista sexual puedes postear tu anuncio y 
              posicionarte dentro de las primeras publicaciones para obtener mejores resultados.">
        <meta name="keywords" content="Anuncios gratis, escorts, gay, travesti, gigolo o masajista sexual, 
              anuncios, publicaciones gratis, publicaciones, sexo, colombia, relaciones sexuales, amigas, 
              amigos, eroticos, pagina erotica, contactos sexuales, contactos">
        <link href="bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="CLEditor1_4_5/jquery.cleditor.css" rel="stylesheet" type="text/css"/>
        <link href="css/general.css?v=<?= time(); ?>" rel="stylesheet" type="text/css"/>
        <script src="node_modules/jquery/dist/jquery.js" type="text/javascript"></script>        
        <script src="bootstrap-3.3.7-dist/js/bootstrap.js" type="text/javascript"></script>
        <script src="CLEditor1_4_5/jquery.cleditor.min.js" type="text/javascript"></script>
        <script src="CLEditor1_4_5/jquery.cleditor.js" type="text/javascript"></script>
        <script src="js/jquery.formatCurrency-1.4.0.js" type="text/javascript"></script>
        <script src="js/funciones.js?v=<?= time(); ?>" type="text/javascript"></script>
        <script src="js/anuncio.js?v=<?= time(); ?>" type="text/javascript"></script>
        <link rel="shortcut icon" href="pag_ima/fire.ico">
    </head>
    <body>

        <?php
        include 'header.php';
        ?>
        <div id="anuncio">  


            <div id="div_alerta"role="alert">

            </div>



            <form id="publicar" class="form-horizontal" action="" method="post" enctype="multipart/form-data">

                <legend style="width: 900px; padding-left: 20px">Publicar anuncio</legend>

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
                            <input type="text" class="form-control" id="altura" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="4" placeholder="cm." name="altura">
                        </div>

                        <label for="tarifa" class="col-sm-1 control-label" id="lbl_tarifa">Tarifa Minima</label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="12" onkeyup="$('#tarifa').formatCurrency({roundToDecimalPlace: 0}).val()" id="tarifa" placeholder="pesos" name="tarifa">
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
                            <img id="image_1" class="image" src="" alt="pagina erotica">
                            <span id="btn_mas_1" class="btn_mas glyphicon glyphicon-camera" ></span>
                            <input name = "file_1" id="file_1" class="file" type="file" >
                        </div>
                        <div class="div_img">
                            <span id='btn_close_2' class="close" >&#10006</span>
                            <img id="image_2" class="image" src="" alt="pagina erotica">
                            <span id="btn_mas_2" class="btn_mas glyphicon glyphicon-camera" ></span>
                            <input name = "file_2" id="file_2" class="file" type="file">
                        </div>
                        <div class="div_img">
                            <span id='btn_close_3' class="close" >&#10006</span>
                            <img id="image_3" class="image" src="" alt="pagina erotica">
                            <span id="btn_mas_3" class="btn_mas glyphicon glyphicon-camera" ></span>
                            <input name = "file_3" id="file_3" class="file" type="file" >
                        </div>
                        <div class="div_img">
                            <span id='btn_close_4' class="close" >&#10006</span>
                            <img id="image_4" class="image" src="" alt="pagina erotica">
                            <span id="btn_mas_4" class="btn_mas glyphicon glyphicon-camera" ></span>
                            <input name = "file_4" id="file_4" class="file" type="file">
                        </div>
                        <div class="div_img">
                            <span id='btn_close_5' class="close" >&#10006</span>
                            <img id="image_5" class="image" src="" alt="pagina erotica">
                            <span id="btn_mas_5" class="btn_mas glyphicon glyphicon-camera" ></span>
                            <input name = "file_5" id="file_5" class="file" type="file" >
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" required > <a href="termcondi.php" target="_blank">Acepto Terminos y Condiciones</a>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Publicar</button>
                    </div>
                </div>

            </form>




        </div>
    </body>
</html>
