<?php

require_once 'Database.php';

class Anuncio {

    //put your code here

    public function insertAnuncio($tipo_anuncio, $titulo, $texto, $usuario, $email, $tel, $web, $mun_idmun, $mun_iddep, $barrio) {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO anuncio (tipo_anuncio, titulo, texto, usuario, email, tel, web, mun_idmun, mun_iddep, barrio) VALUES (:tipo_anuncio, :titulo, :texto, :usuario, :email, :tel, :web, :mun_idmun, :mun_iddep, :barrio)");
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

        $result = $stmt->execute();

        $id = $pdo->lastInsertId();

        Database::disconnect();

        if ($result == 1) {
            return $id;
        } else {
            return $result;
        }
    }

}
