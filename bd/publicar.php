<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$proceso = 1;

include_once 'Anuncio.php';

if (empty($_POST)) {
    echo 0;
    return;
}

$tipo_anuncio = $_POST['tipo_anuncio'];
$titulo = $_POST['titulo'];
$texto = $_POST['texto'];
//$usuario= $_POST['$usuario']; 
$email = $_POST['email'];
$tel = $_POST['tel'];
$web = $_POST['web'];
$mun_idmun = $_POST['mun_idmun'];
$mun_iddep = $_POST['mun_iddep'];
$barrio = $_POST['barrio'];
$edad = $_POST['edad'];
$altura = $_POST['altura'];
$tarifa = $_POST['tarifa'];

$anuncio = new Anuncio();
/**
 * Se inserta el anuncio
 */
$idanuncio = $anuncio->insertAnuncio($tipo_anuncio, $titulo, $texto, null, $email, $tel, $web, $mun_idmun, $mun_iddep, $barrio, $edad, $altura, $tarifa);

if ($idanuncio < 1) {

    echo 0;
    return;
}

/**
 * Se crea la carpeta del anuncio
 */
// Desired folder structure
$structure = '../upload/' . $idanuncio;

// To create the nested structure, the $recursive parameter 
// to mkdir() must be specified.

if (!mkdir($structure, 0777, true)) {

    //se debe borrar el registro de la BD   
    $anuncio->borrarAnuncio($idanuncio);
    echo 0;
    return;
}

for ($i = 1; $i <= 8; $i++) {
    
    $fallo = 0;
    if ($_FILES['file_' . $i]["size"] != 0) {
        
        $validextensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES['file_' . $i]["name"]);
        $file_extension = end($temporary);

        if ((($_FILES['file_' . $i]["type"] == "image/png") || ($_FILES['file_' . $i]["type"] == "image/jpg") || ($_FILES['file_' . $i]["type"] == "image/jpeg")
                ) && ($_FILES['file_' . $i]["size"] < 5000000)//Approx. 5Mb files can be uploaded.
                && in_array($file_extension, $validextensions)) {

            if ($_FILES['file_' . $i]["error"] > 0) {
                echo "Return Code: " . $_FILES["file_1"]["error"] . "<br/><br/>";
            } else {

                if (file_exists($structure . "/" . $_FILES['file_' . $i]["name"])) {
                    
                    $proceso = 0;
                    $fallo = 1;
                } else {
                    $ext = pathinfo($_FILES['file_' . $i]["name"], PATHINFO_EXTENSION);
                    $sourcePath = $_FILES['file_' . $i]['tmp_name']; // Storing source path of the file in a variable
                    $targetPath = $structure . "/imagen" . $i . "." .$ext; // Target path where file is to be stored
                    move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
                    $anuncio->insertarURLImagen($idanuncio, $targetPath);                                        
                }
            }
        } else {
                        
            $proceso = 0;
            return;
        }
    }
    
    if($proceso == 0){
        //si falla en alguna insercion se borra el anuncio y la carpeta
        $anuncio->borrarAnuncio($idanuncio);
        $anuncio->deleteDir('/var/www/eros/upload/' . $idanuncio);
        echo 0;    
        return;
    }
}

if($proceso != 0){
    echo $idanuncio;
}  else {
    echo $proceso;
}

