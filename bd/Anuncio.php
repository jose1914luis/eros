<?php

require_once 'Database.php';

class Anuncio {

    //put your code here

    public function total($cat, $depa) {
        
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $consulta = '';
        if(isset($cat)){
            $consulta = "WHERE tipo_anuncio = " . intval($cat);
        }
        if(isset($depa)){
            
            $consulta = "WHERE mun_iddep = " . intval($depa);
        }
        
        $sql = "SELECT COUNT(*) as total FROM anuncio " . $consulta;
        $query = $pdo->prepare($sql);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            return $data['total'];
        }else{
            return 0;
        }
            
    }

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

    public function getAnuncioXPagina($limite, $offset, $cat, $depa) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = '';
        if(isset($cat)){
            $consulta = "WHERE tipo_anuncio = " . intval($cat);
        }
        if(isset($depa)){
            
            $consulta = "WHERE mun_iddep = " . intval($depa);
        }
        $query = $pdo->prepare("SELECT idanuncio, tipo_anuncio, titulo, texto, edad, altura, tarifa, tel, barrio, m.nombre as m_nombre,  d.nombre as d_nombre, t.tipo
            FROM anuncio as a INNER JOIN mun as m ON (a.mun_idmun = m.idmun) INNER JOIN dep as d ON (d.iddep = m.iddep) 
            INNER JOIN tipo_anuncio as t ON (t.idtipo_anuncio = a.tipo_anuncio) ". $consulta . " ORDER BY idanuncio LIMIT ". intval($limite) ." OFFSET ". intval($offset));
        
        $query->execute();
        $data = $query->fetchAll();

        if (!empty($data)) {

            Database::disconnect();
            return $data;
        } else {

            return false;
        }
    }
    
    public function getAnunciosxID($idanuncio) {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $pdo->prepare("SELECT idanuncio, tipo_anuncio, titulo, texto, edad, altura, tarifa, tel, barrio, m.nombre as m_nombre,  d.nombre as d_nombre, t.tipo
            FROM anuncio as a INNER JOIN mun as m ON (a.mun_idmun = m.idmun) INNER JOIN dep as d ON (d.iddep = m.iddep) 
            INNER JOIN tipo_anuncio as t ON (t.idtipo_anuncio = a.tipo_anuncio) WHERE idanuncio = ?;");

        $query->execute(array($idanuncio));
        $data = $query->fetch(PDO::FETCH_ASSOC);


        if (!empty($data)) {    
            
            Database::disconnect();        
            return $data;
        } else{
            
            return false;
        }
        
    }

    public function getUrlImage($idanuncio) {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT url FROM imagen WHERE idanuncio = ?";
        $query = $pdo->prepare($sql);
        $query->execute(array($idanuncio));
        $data = $query->fetchAll();


        if (!empty($data)) {

            Database::disconnect();
            return $data;
        } else {

            return false;
        }
    }

}
