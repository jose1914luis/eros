<?php

require_once 'Database.php';

class Paginador {

    private $total;

    public function __construct() {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT COUNT(*) as total FROM anuncio";
        $query = $pdo->prepare($sql);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            $this->total = $data['total'];
        }
    }

    public function total() {
        return $this->total;
    }

    public function getAnuncioXPagina($limite, $offset) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $pdo->prepare("SELECT idanuncio, tipo_anuncio, titulo, texto, edad, altura, tarifa, tel, barrio, m.nombre as m_nombre,  d.nombre as d_nombre, t.tipo
            FROM anuncio as a INNER JOIN mun as m ON (a.mun_idmun = m.idmun) INNER JOIN dep as d ON (d.iddep = m.iddep) 
            INNER JOIN tipo_anuncio as t ON (t.idtipo_anuncio = a.tipo_anuncio) ORDER BY idanuncio LIMIT ". intval($limite) ." OFFSET ". intval($offset));
                
        $query->execute();
        $data = $query->fetchAll();

        if (!empty($data)) {

            Database::disconnect();
            return $data;
        } else {

            return false;
        }
    }

}
