<?php

require_once 'SQL_EROS.php';

class Anuncio {

    public function total($tipo, $d_nombre, $m_nombre, $buscar) {

        $eros = new SQL_EROS();
        $values = ['COUNT(*) as total'];
        $where = ['m_nombre' => ['=', $m_nombre],
            'tipo' => ['=', $tipo],
            'd_nombre' => ['=', $d_nombre],
            'grupo2' => ['(*)', 'OR', ['texto' => ['LIKE', (isset($buscar) ? '%' . $buscar . '%' : null)],
                    'tel' => ['LIKE', (isset($buscar) ? '%' . $buscar . '%' : null)],
                    'altura' => ['LIKE', (isset($buscar) ? '%' . $buscar . '%' : null)],
                    'edad' => ['LIKE', (isset($buscar) ? '%' . $buscar . '%' : null)],
                    'tarifa' => ['LIKE', (isset($buscar) ? '%' . $buscar . '%' : null)],
                    'titulo' => ['LIKE', (isset($buscar) ? '%' . $buscar . '%' : null)]]]
        ];
        $data = $eros->select('v_total', $values, $where, 0, 0, null, 'one');

        if (!empty($data)) {
            return $data['total'];
        } else {
            return 0;
        }

        return 0;
    }

    public function total_email($email) {

        $eros = new SQL_EROS();
        $values = ['COUNT(*) as total'];
        $where = ['email' => ['=', $email]];
        $data = $eros->select('v_total', $values, $where, 0, 0, null, 'one');

        if (!empty($data)) {
            return $data['total'];
        } else {
            return 0;
        }
    }

    public function total_usuario($idusuario) {

        $eros = new SQL_EROS();
        $values = ['COUNT(*) as total'];
        $where = ['usuario' => ['=', $idusuario]];
        $data = $eros->select('v_total', $values, $where, 0, 0, null, 'one');

        if (!empty($data)) {
            return $data['total'];
        } else {
            return 0;
        }
    }

    public function insertAnuncio($tipo_anuncio, $titulo, $texto, $usuario, $email, $tel, $web, $mun_idmun, $mun_iddep, $barrio, $edad, $altura, $tarifa) {


        $sql_eros = new SQL_EROS();
        $values = ['tipo_anuncio' => intval($tipo_anuncio),
            'titulo' => $titulo,
            'texto' => $texto,
            'usuario' => intval($usuario),
            'email' => $email,
            'tel' => $tel,
            'web' => $web,
            'mun_idmun' => intval($mun_idmun),
            'mun_iddep' => intval($mun_iddep),
            'barrio' => $barrio,
            'edad' => $edad,
            'altura' => $altura,
            'tarifa' => $tarifa];

        $result = $sql_eros->insertar('anuncio', $values);

        $id = $sql_eros->lastId();

        if ($result == 1) {
            return $id;
        } else {
            return -1;
        }
    }

    public function insertarURLImagen($id_anuncio, $url) {

        $sql_eros = new SQL_EROS();
        $values = ['url' => $url,
            'idanuncio' => $id_anuncio];

        $result = $sql_eros->insertar('imagen', $values);

        return $result;
    }

    public function borrarAnuncio($id_anuncio, $idusuario) {

        $eros = new SQL_EROS();
        if (isset($idusuario)) {

            $where = ['usuario' => ['=', $idusuario],
                'idanuncio' => ['=', $id_anuncio]];
            return $eros->delete('anuncio', $where, 1);
        } else {

            $where = ['idanuncio' => ['=', $id_anuncio]];
            return $eros->delete('anuncio', $where, 1);
        }
    }

    public static function deleteDir($dirPath) {
        if (!is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

    public function getAnuncioXPaginaUsuario($limite, $offset, $idusuario) {

        $eros = new SQL_EROS();
        $values = ['*'];
        $where = ['usuario' => ['=', $idusuario]];
        $order = ['fecha_inicio' => 'desc', 'idanuncio' => 'desc'];
        return $eros->select('v_anuncio', $values, $where, intval($limite), intval($offset), $order, 'all');
    }

    public function getAnuncioXPagina($limite, $offset, $tipo, $d_nombre, $m_nombre, $buscar) {

        $eros = new SQL_EROS();
        $values = ['*'];
        $where = ['m_nombre' => ['=', $m_nombre],
            'tipo' => ['=', $tipo],
            'd_nombre' => ['=', $d_nombre],
            'grupo2' => ['(*)', 'OR', ['texto' => ['LIKE', (isset($buscar) ? '%' . $buscar . '%' : null)],
                    'tel' => ['LIKE', (isset($buscar) ? '%' . $buscar . '%' : null)],
                    'altura' => ['LIKE', (isset($buscar) ? '%' . $buscar . '%' : null)],
                    'edad' => ['LIKE', (isset($buscar) ? '%' . $buscar . '%' : null)],
                    'tarifa' => ['LIKE', (isset($buscar) ? '%' . $buscar . '%' : null)],
                    'titulo' => ['LIKE', (isset($buscar) ? '%' . $buscar . '%' : null)]]]
        ];

        $order = ['fecha_inicio' => 'desc', 'idanuncio' => 'desc'];
        $data = $eros->select('v_anuncio', $values, $where, intval($limite), intval($offset), $order, 'all');

        if (!empty($data)) {
            return $data;
        } else {
            return false;
        }
    }

    public function getAnunciosxID($idanuncio) {

        $eros = new SQL_EROS();
        $values = ['*'];
        $where = ['idanuncio' => ['=', $idanuncio]];
        return $eros->select('v_anuncio', $values, $where, 0, 0, null, 'one');
    }

    public function getUrlImage($idanuncio, $limit) {

        $eros = new SQL_EROS();
        $values = ['url'];
        $where = ['idanuncio' => ['=', $idanuncio]];
        return $eros->select('imagen', $values, $where, 0, 0, null, 'all');
    }

    public function republicarAnuncio($idanuncio) {

        $eros = new SQL_EROS();
        $lastupdated = date('Y-m-d');
        $values = ['fecha_inicio' => $lastupdated];
        $where = ['idanuncio' => ['=', $idanuncio]];
        return $eros->update('anuncio', $values, $where, 0);
    }

}
