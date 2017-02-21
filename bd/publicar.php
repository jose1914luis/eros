<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);

$proceso = 1;

include_once 'Anuncio.php';

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

$anuncio = new Anuncio();
/**
 * Se inserta el anuncio
 */
/**
 * Se crea la carpeta del anuncio
 */
// Desired folder structure
$structure = '../upload/';

for ($i = 1; $i <= 8; $i++) {

    switch ($_FILES['file_' . $i]['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }
    
//    if (is_uploaded_file($_FILES['file_' . $i])) {
//
//        if ($_FILES['file_' . $i]["size"] != 0) {
//
//
//            $validextensions = array("jpeg", "jpg", "png");
//            $temporary = explode(".", $_FILES['file_' . $i]["name"]);
//            $file_extension = end($temporary);
//
//            if ((($_FILES['file_' . $i]["type"] == "image/png") || ($_FILES['file_' . $i]["type"] == "image/jpg") || ($_FILES['file_' . $i]["type"] == "image/jpeg")
//                    ) && ($_FILES['file_' . $i]["size"] < 5000000)//Approx. 5Mb files can be uploaded.
//                    && in_array($file_extension, $validextensions)) {
//
//
//                if ($_FILES['file_' . $i]["error"] > 0) {
//                    echo "Return Code: " . $_FILES["file_1"]["error"] . "<br/><br/>";
//                } else {
//
//                    if (file_exists($structure . "/" . $_FILES['file_' . $i]["name"])) {
//
//                        $proceso = -4;
//                    } else {
//                        $ext = pathinfo($_FILES['file_' . $i]["name"], PATHINFO_EXTENSION);
//                        $sourcePath = $_FILES['file_' . $i]['tmp_name']; // Storing source path of the file in a variable
//                        $targetPath = $structure . "/imagen" . $i . "." . $ext; // Target path where file is to be stored
//                        move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
//                        $anuncio->insertarURLImagen($idanuncio, $targetPath);
//                    }
//                }
//            } else {
//
//                $proceso = -5;
//                echo $_FILES['file_' . $i]["type"] . '    ' . $_FILES['file_' . $i]["size"];
//            }
//        }
//    }
}