<?php

require_once 'Database.php';
require_once 'SQL_EROS.php';

class Anuncio {

    private $param = array();

    public function construirWhere($cat, $depa, $mun, $buscar) {

        $consulta2 = "";
        if (!empty($cat)) {

            $consulta2 .= "tipo = :tipo";
            $this->param["tipo"] = $cat;
        }
        if (!empty($depa)) {

            $consulta2 .= ($consulta2 == "") ? "d_nombre = :d_nombre" : " AND d_nombre = :d_nombre";
            $this->param["d_nombre"] = $depa;
        }
        if (!empty($mun)) {

            $consulta2 .= ($consulta2 == "") ? "m_nombre = :m_nombre" : " AND m_nombre = :m_nombre";
            $this->param["m_nombre"] = $mun;
        }
        if (!empty($buscar)) {

            $consulta2 .= ($consulta2 == "") ? "(texto LIKE :texto OR tel LIKE :tel OR altura = :altura OR edad = :edad OR tarifa = :tarifa OR titulo LIKE :titulo)" :
                    " AND (texto LIKE :texto OR tel LIKE :tel OR altura = :altura OR edad = :edad OR tarifa = :tarifa OR titulo LIKE :titulo)";

            $this->param["texto"] = '%' . $buscar . '%';
            $this->param["tel"] = $buscar;
            $this->param["altura"] = $buscar;
            $this->param["edad"] = $buscar;
            $this->param["tarifa"] = $buscar;
            $this->param["titulo"] = '%' . $buscar . '%';
        }

        $consulta2 = ($consulta2 == "") ? "" : "WHERE " . $consulta2;
        return $consulta2;
    }

    public function total($cat, $depa, $mun, $buscar) {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $this->construirWhere($cat, $depa, $mun, $buscar);

        $sql = "SELECT COUNT(*) as total FROM v_anuncio " . $consulta;

        $query = $pdo->prepare($sql);
        $query->execute($this->param);

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            return $data['total'];
        } else {
            return 0;
        }
    }

    public function total_email($email) {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $sql = "SELECT COUNT(*) as total FROM anuncio WHERE email = '" . $email . "'";
        $query = $pdo->prepare($sql);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            return $data['total'];
        } else {
            return 0;
        }
    }

    public function total_usuario($idusuario) {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $sql = "SELECT COUNT(*) as total FROM anuncio WHERE usuario = '" . $idusuario . "'";
        $query = $pdo->prepare($sql);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            return $data['total'];
        } else {
            return 0;
        }
    }

    public function insertAnuncio($tipo_anuncio, $titulo, $texto, $usuario, $email, $tel, $web, $mun_idmun, $mun_iddep, $barrio, $edad, $altura, $tarifa) {


        $sql_eros = new SQL_EROS();
        $values = ['tipo_anuncio' => intval($tipo_anuncio),
            'titulo' => $titulo,
            'texto' => $texto,
            'usuario' => intval($usuario),
            'email' => $email,
            'tel' => $tel,
            'web' => $web,
            'mun_idmun' => intval($mun_idmun),
            'mun_iddep' => intval($mun_iddep),
            'barrio' => $barrio,
            'edad' => $edad,
            'altura' => $altura,
            'tarifa' => $tarifa];

        $result = $sql_eros->insertar('anuncio', $values);

        $id = $sql_eros->lastId();

        if ($result == 1) {
            return $id;
        } else {
            return $result;
        }
    }

    public function insertarURLImagen($id_anuncio, $url) {

        $sql_eros = new SQL_EROS();
        $values = ['url' => $url,
            'idanuncio' => $id_anuncio];


        $result = $sql_eros->insertar('imagen', $values);

        return $result;
    }

    public function borrarAnuncio($id_anuncio, $idusuario) {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = null;
        if (isset($idusuario)) {
            $stmt = $pdo->prepare("DELETE FROM anuncio WHERE idanuncio = :idanuncio AND usuario =  :idusuario");
            $stmt->bindParam(':idanuncio', $id_anuncio);
            $stmt->bindParam(':idusuario', $idusuario);
        } else {
            $stmt = $pdo->prepare("DELETE FROM anuncio WHERE idanuncio = :idanuncio");
            $stmt->bindParam(':idanuncio', $id_anuncio);
        }


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

    public function getAnuncioXPaginaUsuario($limite, $offset, $idusuario) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM v_anuncio WHERE usuario = ? ORDER BY fecha_inicio desc, idanuncio desc LIMIT " . intval($limite) . " OFFSET " . intval($offset);
        $query = $pdo->prepare($sql);
        $query->execute(array($idusuario));
        $data = $query->fetchAll();

        if (!empty($data)) {

            Database::disconnect();
            return $data;
        } else {

            return false;
        }
    }

    public function getAnuncioXPagina($limite, $offset, $cat, $depa, $mun, $buscar) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $this->construirWhere($cat, $depa, $mun, $buscar);
        $sql = "SELECT * FROM v_anuncio " . $consulta . " ORDER BY fecha_inicio desc, idanuncio desc LIMIT " . intval($limite) . " OFFSET " . intval($offset);
        $query = $pdo->prepare($sql);

        $query->execute($this->param);
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

        $query = $pdo->prepare("SELECT * FROM v_anuncio WHERE idanuncio = ?;");

        $query->execute(array($idanuncio));
        $data = $query->fetch(PDO::FETCH_ASSOC);


        if (!empty($data)) {

            Database::disconnect();
            return $data;
        } else {

            return false;
        }
    }

    public function getUrlImage($idanuncio, $limit) {


        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT url FROM imagen WHERE idanuncio = ?";

        if ($limit > 0) {
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
