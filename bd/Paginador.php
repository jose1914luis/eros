<?php

require_once 'Anuncio.php';

class Paginador {

    public $total = 0;
    public $limit = 0;
    public $pages = 0;
    public $start = 0;
    public $end = 0;
    public $offset = 0;
    public $datos;

    function __construct($limit) {
        $this->limit = $limit;
    }

    public function traerDatos($total, $page, $cat, $dep, $mun, $buscar) {

        if ($total > 0) {

            $this->page = $page;

            $this->total = $total;
// How many pages will there be
            $this->pages = ceil($this->total / $this->limit);

// Calculate the offset for the query
            $this->offset = ($this->page - 1) * $this->limit;

// Some information to display to the user
            $this->start = $this->offset + 1;
            $this->end = min(($this->offset + $this->limit), $this->total);

            $anuncio = new Anuncio();
            $this->datos = $anuncio->getAnuncioXPagina($this->limit, $this->offset, $cat, $dep, $mun, $buscar);
        }
    }

}
