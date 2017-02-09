<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'GetDep.php';
header('Content-Type: application/json');
if (!empty($_GET)) {

    $iddep = $_GET['iddep'];
    $ClDep = new GetDep();
    
    $mun = $ClDep->obtenerMun($iddep);
    
    echo json_encode($mun);
}else{
    
    echo false;
}








