<?php

require_once 'Database.php';

class Anuncio {

    public function construirWhere($cat, $depa, $mun, $buscar){
        
        $consulta = "";       
        if(!empty($cat)){
            $consulta .= "tipo_anuncio = " . intval($cat);
        }
        if(!empty($depa)){
            
            $consulta .= ($consulta == "")? "mun_iddep = " . intval($depa):" AND mun_iddep = " . intval($depa);
        }
        if(!empty($mun)){
            
            
            $consulta .= ($consulta == "")? "mun_idmun = " . intval($mun):" AND mun_idmun = " . intval($mun);
        }
        if(!empty($buscar)){
            
            $consulta .= ($consulta == "")?"(texto LIKE '%" . $buscar . "%' OR tel LIKE '%" . $buscar . "%' OR altura = '" . $buscar . "' OR edad = '" . $buscar . "' OR tarifa = '" . $buscar . "' OR titulo LIKE '%" . $buscar ."%')":
                " AND (texto LIKE '%" . $buscar . "%' OR tel LIKE '%" . $buscar . "%' OR altura = '" . $buscar . "' OR edad = '" . $buscar . "' OR tarifa = '" . $buscar . "' OR titulo LIKE '%" . $buscar ."%')";
        }   
//        echo $consulta;
        $consulta = ($consulta == "")?"":"WHERE ".$consulta;   
        return $consulta;
    }

    public function total($cat, $depa, $mun, $buscar) {
        
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $consulta = $this->construirWhere($cat, $depa, $mun, $buscar);
        
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

        $stmt = $pdo->prepare("INSERT INTO anuncio (tipo_anuncio, titulo, texto, usuario, email, tel, web, mun_idmun, mun_iddep, barrio, edad, altura, tarifa, fecha_inicio) VALUES (:tipo_anuncio, :titulo, :texto, :usuario, :email, :tel, :web, :mun_idmun, :mun_iddep, :barrio, :edad, :altura, :tarifa, (select curdate()))");
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

    public function getAnuncioXPagina($limite, $offset, $cat, $depa, $mun, $buscar) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $this->construirWhere($cat, $depa, $mun, $buscar);
        $sql = "SELECT idanuncio, tipo_anuncio, titulo, texto, edad, altura, tarifa, tel, barrio, m.nombre as m_nombre,  d.nombre as d_nombre, t.tipo
            FROM anuncio as a INNER JOIN mun as m ON (a.mun_idmun = m.idmun) INNER JOIN dep as d ON (d.iddep = m.iddep) 
            INNER JOIN tipo_anuncio as t ON (t.idtipo_anuncio = a.tipo_anuncio) ". $consulta . " ORDER BY fecha_inicio desc, idanuncio desc LIMIT ". intval($limite) ." OFFSET ". intval($offset);
        $query = $pdo->prepare($sql);        
        
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

    public function getUrlImage($idanuncio, $limit) {

        
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT url FROM imagen WHERE idanuncio = ?";
        
        if($limit > 0){
            $sql = $sql . " LIMIT " . $limit;
        }
        
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
