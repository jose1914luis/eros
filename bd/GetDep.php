<?php

require_once 'SQL_EROS.php';

class GetDep {

    public function obtenerTipoAnuncio() {

        $eros = new SQL_EROS();
        $values = ['*'];
        $data = $eros->select('v_cat', $values, null, 0, 0, null, 'all');

        return $data;
    }

    public function obtenerDep() {

        $eros = new SQL_EROS();
        $values = ['*'];
        $data = $eros->select('v_dep', $values, null, 0, 0, null, 'all');

        return $data;
    }

    public function obtenerMun($nombre) {

        $eros = new SQL_EROS();
        $values = ['*'];
        $where = ['d_nombre' => ['=', $nombre]];
        $data = $eros->select('v_mun_num', $values, $where, 0, 0, null, 'all');

        return $data;
    }

    public function obtenerMunID($iddep) {

        $eros = new SQL_EROS();
        $values = ['*'];
        $where = ['iddep' => ['=', $iddep]];
        $order = ['m_nombre', 'desc'];
        $data = $eros->select('v_mun', $values, $where, 0, 0, $order, 'all');

        return $data;
    }

}
