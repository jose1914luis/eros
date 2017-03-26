<?php

/**
 * Description of Insertar
 *
 * @author josegh
 */
require_once 'Database.php';

class SQL_EROS {
    
    
    private $lastId = -1;
    
    public function lastId(){
        return $this->lastId;
    }

    public function insertar($table, $values) {

        $result = 0;
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $insert = "INSERT INTO " . $table;

        $colums = "";
        $ban = true;
        $data = "";
        foreach ($values as $key => $value) {
            $colums .= ($ban) ? $key : ", " . $key;
            $data .= ($ban) ? ":" . $key : ", :" . $key;
            $ban = false;
        }
        $insert .= "(" . $colums . ") ";
        $insert .= "VALUES(" . $data . ") ";
        
        $stmt = $pdo->prepare($insert);
        
        try {
//            print_r($values);
            $result = $stmt->execute($values);
        } catch (PDOException $ex) {
            
//            echo $ex;
            $result = $ex->getCode();
        }
        
        $this->lastId = $pdo->lastInsertId();

        Database::disconnect();

        return $result;
    }

}
