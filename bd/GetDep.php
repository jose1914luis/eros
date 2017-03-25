<?php

require_once 'Database.php';

class GetDep {

    
    
    public function obtenerTipoAnuncio() {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM v_cat";
        $query = $pdo->prepare($sql);
        $query->execute();
        $data = $query->fetchAll();


        if (!empty($data)) {    
            
            Database::disconnect();        
            return $data;
        } else{
            
            return false;
        }
    }
    
    public function obtenerDep() {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM v_dep";
        $query = $pdo->prepare($sql);
        $query->execute();
        $data = $query->fetchAll();


        if (!empty($data)) {    
            
            Database::disconnect();        
            return $data;
        } else{
            
            return false;
        }
    }    
    
    public function obtenerMun($nombre){
        
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM v_mun_num where d_nombre =  ?";
        $query = $pdo->prepare($sql);
        $query->execute(array($nombre));
        $data = $query->fetchAll();


        if (!empty($data)) {    
            
            Database::disconnect();        
            return $data;
        } else{
            
            return false;
        }
    } 
    
    
    public function obtenerMunID($iddep){
        
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM v_mun where iddep =  ? order by m_nombre";
        $query = $pdo->prepare($sql);
        $query->execute(array($iddep));
        $data = $query->fetchAll();


        if (!empty($data)) {    
            
            Database::disconnect();        
            return $data;
        } else{
            
            return false;
        }
    } 

}
