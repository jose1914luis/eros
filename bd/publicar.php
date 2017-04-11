<?php

$proceso = 1;

include_once 'Anuncio.php';
include_once 'Correo.php';
include_once 'Usuario.php';

if (empty($_POST)) {

    echo -1;
    return;
}

$tipo_anuncio = filter_input(INPUT_POST, 'tipo_anuncio');
$titulo = filter_input(INPUT_POST, 'titulo');
$texto = filter_input(INPUT_POST, 'texto');
//$usuario= $_POST['$usuario']; 
$email = filter_input(INPUT_POST, 'email');
$tel = filter_input(INPUT_POST, 'tel');
$web = filter_input(INPUT_POST, 'web');
$mun_idmun = filter_input(INPUT_POST, 'mun_idmun');
$mun_iddep = filter_input(INPUT_POST, 'mun_iddep');
$barrio = filter_input(INPUT_POST, 'barrio');
$edad = filter_input(INPUT_POST, 'edad');
$altura = filter_input(INPUT_POST, 'altura');
$tarifa = filter_input(INPUT_POST, 'tarifa');
$numfiles = filter_input(INPUT_POST, 'numfiles');
$url = filter_input(INPUT_POST, 'url');


$anuncio = new Anuncio();
/**
 * Se inserta el anuncio
 */
$idanuncio = $anuncio->insertAnuncio($tipo_anuncio, $titulo, $texto, null, strtolower($email), preg_replace('/\s+/', '', $tel), $web, $mun_idmun, $mun_iddep, $barrio, $edad, $altura, $tarifa);

//echo 'idanuncio' .$idanuncio;
if ($idanuncio < 1) {

    echo -2;
    return;
}

$crearCarpeta = true;
$structure = '../upload/' . $idanuncio;

for ($i = 1; $i <= strval($numfiles); $i++) {


    if ($_FILES['file_' . $i]["size"] != 0) {

        $temporary = explode(".", $_FILES['file_' . $i]["name"]);
        //Approx. 5Mb files can be uploaded 
        if ($_FILES['file_' . $i]["type"] == "image/jpeg" && ($_FILES['file_' . $i]["size"] < 5000000)) {


            if ($_FILES['file_' . $i]["error"] > 0) {
                echo "Return Code: " . $_FILES["file_1"]["error"] . "<br/><br/>";
            } else {

                if (file_exists($structure . "/" . $_FILES['file_' . $i]["name"])) {

                    $proceso = -4;
                } else {

                    if ($crearCarpeta) {

                        /* Se crea la carpeta del anuncio si hay algun archivo 
                          Desired folder structure
                          To create the nested structure, the $recursive parameter
                          to mkdir() must be specified. */
                        if (!mkdir($structure, 0777, true)) {

                            //se debe borrar el registro de la BD   
                            $anuncio->borrarAnuncio($idanuncio);
                            echo -3;
                            return;
                        } else {
                            $crearCarpeta = false;
                        }
                    }
                    $ext = pathinfo($_FILES['file_' . $i]["name"], PATHINFO_EXTENSION);
                    $sourcePath = $_FILES['file_' . $i]['tmp_name']; // Storing source path of the file in a variable
                    $targetPath = $structure . "/imagen" . $i . ".jpg"; // Target path where file is to be stored
                    move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
                    $anuncio->insertarURLImagen($idanuncio, $targetPath);
                }
            }
        } else {

            $proceso = -5;
        }
    }

    if ($proceso < 0) {
        //si falla en alguna insercion se borra el anuncio y la carpeta
        $anuncio->borrarAnuncio($idanuncio);
        $anuncio->deleteDir('/var/www/eros/upload/' . $idanuncio);
        echo $proceso;
        return;
    }
}

if ($proceso > 0) {
    /* Enviar correo despues de la creacion del anuncio */


    $total = $anuncio->total_email($email);

    $usuarioEros = new Usuario();
    $correo = new Correo();
    $datos = $usuarioEros->getUsuariobyEmail($email);
    if ($total == 1) {

        /* Primera ves que publica un anuncio */
        try {
            $correo->bienvenida($email, $datos['contra']);
            $correo->enviar();
        } catch (Exception $ex) {

            echo $ex;
        }
    }

    try {
        $correo->pago($email, $idanuncio, $url);
        $correo->enviar();
    } catch (Exception $ex) {

        echo $ex;
    }

    echo $idanuncio;
} else {

    echo $proceso;
}