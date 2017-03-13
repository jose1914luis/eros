<?php

require_once 'Database.php';

class Usuario {

    //put your code here

    public function validarUsuario($usuario, $contra) {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM usuario WHERE usuario = ?";
        $query = $pdo->prepare($sql);
        $query->execute(array($usuario));
        $data = $query->fetch(PDO::FETCH_ASSOC);


        if (!empty($data)) {

            Database::disconnect();
            if ($data['contra'] == $contra) {
                $_SESSION['user_session'] = $data['idusuario'];
                return 1;
            }
            return 0;
        } else {

            return 0;
        }
    }

    public function getUsuariobyEmail($email) {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM usuario WHERE email = ?";
        $query = $pdo->prepare($sql);
        $query->execute(array($email));
        $data = $query->fetch(PDO::FETCH_ASSOC);


        if (!empty($data)) {

            return $data;
        } else {

            return 0;
        }
    }

}
