<?php

include 'bd/SQL_EROS.php';

$eros = new SQL_EROS();
$lastupdated = date('Y-m-d');
$values = ['fecha_inicio'=> $lastupdated];
$where = ['idanuncio'=> ['=', 47]];
print_r($eros->update('anuncio', $values, $where, 0));