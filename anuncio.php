<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Eros</title>
        <link href="bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="CLEditor1_4_5/jquery.cleditor.css" rel="stylesheet" type="text/css"/>
        <link href="css/general.css" rel="stylesheet" type="text/css"/>
        <script src="node_modules/jquery/dist/jquery.js" type="text/javascript"></script>        
        <script src="bootstrap-3.3.7-dist/js/bootstrap.js" type="text/javascript"></script>
        <script src="CLEditor1_4_5/jquery.cleditor.min.js" type="text/javascript"></script>
        <script src="CLEditor1_4_5/jquery.cleditor.js" type="text/javascript"></script>
        <script src="js/anuncio.js" type="text/javascript"></script>
    </head>
    <body>
        
        <?php
        include 'header.php';
        ?>
        <div id="anuncio">  


            <?php
            include_once './bd/Anuncio.php';

            if (!empty($_POST)) {

                $tipo_anuncio = $_POST['tipo_anuncio'];
                $titulo = $_POST['titulo'];
                $texto = $_POST['texto'];
//    $usuario= $_POST['$usuario']; 
                $email = $_POST['email'];
                $tel = $_POST['tel'];
                $web = $_POST['web'];
                $mun_idmun = $_POST['mun_idmun'];
                $mun_iddep = $_POST['mun_iddep'];
                $barrio = $_POST['barrio'];

                $anuncio = new Anuncio();
                $result = $anuncio->insertAnuncio($tipo_anuncio, $titulo, $texto, null, $email, $tel, $web, $mun_idmun, $mun_iddep, $barrio);

                if ($result > 1) {
                    ?>
                    <div class="alert alert-success" role="alert">
                        Tu anuncio fue creado satisfactoriamente, se te envio un correo con un numero de registro y la informacion
                        adicional para que puedas promover tu anuncio y obtener mejores resultados. 
                        <button class="btn btn-default">ver anuncio</button>
                        <button class="btn btn-warning" onclick="location.href = 'anuncio.php'" >publicar otro anuncio</button>                
                    </div>
                    <?php
                }
            } else {
                ?>


                <form class="form-horizontal" action="anuncio.php" method="post">


                    <div class="form-group">
                        <label for="categoria" class="col-sm-2 control-label">Categoria</label>
                        <div class="col-sm-3">
                            <select id="categoria" class="form-control" name="tipo_anuncio" required>
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
                        <div class="col-sm-3">
                            <select id="dep" class="form-control" required name="mun_iddep">
                                <option value = "0">Selecciona</option>
                                <?php
                                foreach ($dep as $pos => $value) {
                                    echo '<option value = "' . $value[0] . '">' . $value[1] . '</option>';
                                }
                                ?>

                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="mun" class="col-sm-2 control-label" required>Ciudad</label>
                        <div class="col-sm-3">
                            <select id="mun" class="form-control" name="mun_idmun">   
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="barrio" class="col-sm-2 control-label">Barrio</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="barrio" placeholder="Barrio" name="barrio">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="titulo" class="col-sm-2 control-label" required>Titulo</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="titulo" placeholder="Titulo" required name="titulo">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="titulo" class="col-sm-2 control-label">Descripcion</label>
                        <div class="col-sm-6">
                            <textarea id="input" name="texto" style="" required placeholder="Descripcion de tu anuncio"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="web" class="col-sm-2 control-label">Web</label>
                        <div class="col-sm-6">
                            <input type="text" name="web" class="form-control" id="correo" placeholder="Web" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="correo" class="col-sm-2 control-label">Correo</label>
                        <div class="col-sm-6">
                            <input type="email" name="email" class="form-control" id="correo" placeholder="Correo" required>
                        </div>
                    </div>     

                    <div class="form-group">
                        <label for="tel" class="col-sm-2 control-label">Tel</label>
                        <div class="col-sm-4">
                            <input type="tel" class="form-control" name="tel" id="tel" placeholder="Telefono" required>
                        </div>
                    </div> 

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" required> Acepto Terminos y Condiciones
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fotos" class="col-sm-2 control-label">Fotos</label>
                        <div class="col-sm-4">
                            <button id="fotos" type="button" class="btn btn-default">Subir Fotos</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Publicar</button>
                        </div>
                    </div>

                </form>



                <?php
            }
            ?>

        </div>
    </body>
</html>
