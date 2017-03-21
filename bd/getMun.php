<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'GetDep.php';
header('Access-Control-Allow-Origin: *');
if (!empty($_GET)) {

    $mun;
    $iddep = $_GET['iddep'];
    $ClDep = new GetDep();
    
    if (isset($_GET['id']) && $_GET['id'] == 1) {
        $mun = $ClDep->obtenerMunID($iddep);
    } else {
        $mun = $ClDep->obtenerMun($iddep);
    }

    header('Content-Type: application/json');
    echo json_encode($mun);
} else {

    echo false;
}








