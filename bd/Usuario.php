<?php

require_once 'SQL_EROS.php';

class Usuario {

    //put your code here

    public function validarUsuario($usuario, $contra) {

        $eros = new SQL_EROS();
        $values = ['*'];
        $where = ['usuario' => ['=', $usuario]];
        $data =  $eros->select('usuario', $values, $where, 0, 0, null, 'one');


        if (!empty($data)) {
            
            if ($data['contra'] == $contra) {
                $_SESSION['user_session'] = $data['idusuario'];
                $_SESSION['tipo'] = $data['tipo'];
                return 1;
            }
            return 0;
        } else {

            return 0;
        }
    }

    public function getUsuariobyEmail($email) {

        $eros = new SQL_EROS();
        $values = ['*'];
        $where = ['email' => ['=', $email]];
        return $eros->select('usuario', $values, $where, 0, 0, null, 'one');             
    }
    
    
    public function insertarUsuario($nombre, $apellidos, $cel, $email, $usuario, $contra, $tipo) {

        $sql_eros = new SQL_EROS();
        $values = ['nombre'=>$nombre, 
            'apellidos'=>$apellidos, 
            'cel'=>$cel, 
            'email'=>$email, 
            'usuario'=>$usuario, 
            'contra'=>$contra, 
            'tipo'=>$tipo];
        
        return $sql_eros->insertar('usuario', $values);        
    }

}
