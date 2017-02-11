<?php

require_once 'Database.php';

class Anuncio {

    //put your code here

    public function insertAnuncio($tipo_anuncio, $titulo, $texto, $usuario, $email, $tel, $web, $mun_idmun, $mun_iddep, $barrio, $edad, $altura, $tarifa) {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO anuncio (tipo_anuncio, titulo, texto, usuario, email, tel, web, mun_idmun, mun_iddep, barrio, edad, altura, tarifa) VALUES (:tipo_anuncio, :titulo, :texto, :usuario, :email, :tel, :web, :mun_idmun, :mun_iddep, :barrio, :edad, :altura, :tarifa)");
        $stmt->bindParam(':tipo_anuncio', $tipo_anuncio);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':texto', $texto);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':web', $web);
        $stmt->bindParam(':mun_idmun', $mun_idmun);
        $stmt->bindParam(':mun_iddep', $mun_iddep);
        $stmt->bindParam(':barrio', $barrio);
        $stmt->bindParam(':edad', $edad);
        $stmt->bindParam(':altura', $altura);
        $stmt->bindParam(':tarifa', $tarifa);

        $result = $stmt->execute();

        $id = $pdo->lastInsertId();

        Database::disconnect();

        if ($result == 1) {
            return $id;
        } else {
            return $result;
        }
    }

    public function insertarURLImagen($id_anuncio, $url) {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO imagen (url, idanuncio) VALUES (:url, :idanuncio)");
        $stmt->bindParam(':idanuncio', $id_anuncio);
        $stmt->bindParam(':url', $url);

        $result = $stmt->execute();


        Database::disconnect();

        return $result;
    }

    public function borrarAnuncio($id_anuncio) {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("DELETE FROM anuncio WHERE idanuncio = :idanuncio");
        $stmt->bindParam(':idanuncio', $id_anuncio);
        $result = $stmt->execute();

        Database::disconnect();

        return $result;
    }

    public static function deleteDir($dirPath) {
        if (!is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

    public function getAnuncios(){
        
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $pdo->prepare("SELECT * FROM anuncio");
        
        $query->execute();
        $data = $query->fetchAll();


        if (!empty($data)) {    
            
            Database::disconnect();        
            return $data;
        } else{
            
            return false;
        }
        
    }
}
