<?php

include_once './bd/Anuncio.php';
include_once './bd/Paginador.php';

$total = 0;
// How many items to list per page
$limit = LIMIT;
$paginador = new Paginador(LIMIT);
$page = 0;
$title = "";
$description = "";
$canonical = "";
$keywords = "";

//$ayuda_local = "";

if (isset($_GET)) {

    $parm1 = filter_input(INPUT_GET, 'parm1');
    $parm2 = filter_input(INPUT_GET, 'parm2');
    $parm3 = filter_input(INPUT_GET, 'parm3');
    $parm4 = filter_input(INPUT_GET, 'parm4');
    $parm5 = filter_input(INPUT_GET, 'parm5');

    $parm1 = (isset($parm1)) ? str_replace('-', ' ', $parm1) : $parm1;
    $parm2 = (isset($parm2)) ? str_replace('-', ' ', $parm2) : $parm2;
    $parm3 = (isset($parm3)) ? str_replace('-', ' ', $parm3) : $parm3;
    $parm4 = (isset($parm4)) ? str_replace('-', ' ', $parm4) : $parm4;
    $parm5 = (isset($parm5)) ? str_replace('-', ' ', $parm5) : $parm5;

    $idanuncio = filter_input(INPUT_GET, 'idanuncio');

//    echo $parm1;
//    echo $parm2;
//    echo $parm3;
//    echo $parm4;
    if (isset($idanuncio)) {

        $idanuncio = filter_input(INPUT_GET, 'idanuncio');
        $anuncio = new Anuncio();
        $datos = $anuncio->getAnunciosxID($idanuncio);
        if ($datos == false) {
            header("Location:/");
        } else {

            $description = trim(preg_replace('/\s\s+/', ' ', strip_tags(substr($datos['texto'], 0, 180))));
            $title = $datos['tel'] . ' - ' . $datos['titulo'] . ' - ' . $idanuncio . ' - Paginaerotica.com';
            $canonical = "http://www.paginaerotica.com/P_AN/" . $idanuncio . "/" . $parm1 . "/" . $parm2 . "/";
            $keywords = $datos['tipo'] . ',' . $datos['d_nombre'] . ',' . $datos['m_nombre'] . ',anuncio,gratis,clasificados,' . $datos['tel'];
        }
    } else {

        if (isset($parm4)) {

            //pregunto si el 4 parametro no es de paginacion
            if (substr($parm4, 0, 4) != 'pag_') {

                //si no es de paginacion se hace busqueda completa
                //Cat/Depa/Mun/buscar
                $total = $paginador->contarResultados($parm1, $parm2, $parm3, $parm4);

                //pregunto si tiene 5 parametro debe ser de busqueda
                if (isset($parm5)) {

                    if (substr($parm5, 0, 4) == 'pag_') {

                        $page = (intval(substr($parm5, 4)) >= 0) ? intval(substr($parm5, 4)) : 0;
                    }
                }
                $paginador->traerDatos($total, $page, $parm1, $parm2, $parm3, $parm4);
            } else {

                $page = (intval(substr($parm4, 4)) >= 0) ? intval(substr($parm4, 4)) : 0;
                //si el 4 parametro es de paginacion es busqueda con 3 parametros
                //Cat/Depa/Mun
                $total = $paginador->contarResultados($parm1, $parm2, $parm3, null);
                $paginador->traerDatos($total, $page, $parm1, $parm2, $parm3, null);
                if ($total == 0) {
                    //Cat/Depa/Buscar
                    $total = $paginador->contarResultados($parm1, $parm2, null, $parm3);
                    $paginador->traerDatos($total, $page, $parm1, $parm2, null, $parm3);
                }
                if ($total == 0) {
                    //Depa/Mun/Buscar
                    $total = $paginador->contarResultados(null, $parm1, $parm2, $parm3);
                    $paginador->traerDatos($total, $page, null, $parm1, $parm2, $parm3);
                }
            }
        } elseif (isset($parm3)) {

            //pregunto si el 3 parametro no es de paginacion
            if (substr($parm3, 0, 4) != 'pag_') {

                //si no es de paginacion se hace busqueda completa
                //Cat/Depa/Mun
                $total = $paginador->contarResultados($parm1, $parm2, $parm3, null);
                $paginador->traerDatos($total, $page, $parm1, $parm2, $parm3, null);
                if ($total == 0) {

                    //Cat/Depa/Buscar
                    $total = $paginador->contarResultados($parm1, $parm2, null, $parm3);
                    $paginador->traerDatos($total, $page, $parm1, $parm2, null, $parm3);
                }
                if ($total == 0) {

                    //Cat/Mun/Buscar
                    $total = $paginador->contarResultados(null, $parm1, $parm2, $parm3);
                    $paginador->traerDatos($total, $page, null, $parm1, $parm2, $parm3);
                }
            } else {


                $page = (intval(substr($parm3, 4)) >= 0) ? intval(substr($parm3, 4)) : 0;
                //si el 3 parametro es de paginacion es busqueda con 2 parametros
                //Cat/Depa
                $total = $paginador->contarResultados($parm1, $parm2, null, null);
                $paginador->traerDatos($total, $page, $parm1, $parm2, null, null);
                if ($total == 0) {
                    //Depa/Mun
                    $total = $paginador->contarResultados(null, $parm1, $parm2, null);
                    $paginador->traerDatos($total, $page, null, $parm1, $parm2, null);
                }
                if ($total == 0) {
                    //Depa/Buscar
                    $total = $paginador->contarResultados(null, $parm1, null, $parm2);
                    $paginador->traerDatos($total, $page, null, $parm1, null, $parm2);
                }
                if ($total == 0) {
                    //Cat/Buscar
                    $total = $paginador->contarResultados($parm1, null, null, $parm2);
                    $paginador->traerDatos($total, $page, $parm1, null, null, $parm2);
                }
            }
        } elseif (isset($parm2)) {

            //pregunto si el 2 parametro no es de paginacion
            if (substr($parm2, 0, 4) != 'pag_') {

                //si no es de paginacion se hace busqueda completa
                //Cat/Depa
                $total = $paginador->contarResultados($parm1, $parm2, null, null);
                $paginador->traerDatos($total, $page, $parm1, $parm2, null, null);
                if ($total == 0) {
                    //Depa/Mun
                    $total = $paginador->contarResultados(null, $parm1, $parm2, null);
                    $paginador->traerDatos($total, $page, null, $parm1, $parm2, null);
                }
                if ($total == 0) {
                    //Depa/Buscar
                    $total = $paginador->contarResultados(null, $parm1, null, $parm2);
                    $paginador->traerDatos($total, $page, null, $parm1, null, $parm2);
                }
                if ($total == 0) {
                    //Cat/Buscar
                    $total = $paginador->contarResultados($parm1, null, null, $parm2);
                    $paginador->traerDatos($total, $page, $parm1, null, null, $parm2);
                }
            } else {

                $page = (intval(substr($parm2, 4)) >= 0) ? intval(substr($parm2, 4)) : 0;
                //si el 2 parametro es de paginacion es busqueda con 1 parametro
                //Cat
                $total = $paginador->contarResultados($parm1, null, null, null);
                $paginador->traerDatos($total, $page, $parm1, null, null, null);
                if ($total == 0) {
                    //Dep
                    $total = $paginador->contarResultados(null, $parm1, null, null);
                    $paginador->traerDatos($total, $page, null, $parm1, null, null);
                }
                if ($total == 0) {
                    //Buscar
                    $total = $paginador->contarResultados(null, null, null, $parm1);
                    $paginador->traerDatos($total, $page, null, null, null, $parm1);
                }
            }
        } elseif (isset($parm1)) {

            //pregunto si el 1 parametro no es de paginacion
            if (substr($parm1, 0, 4) != 'pag_') {

                //si no es de paginacion se hace busqueda completa
                //Cat
                $total = $paginador->contarResultados($parm1, null, null, null);
                $paginador->traerDatos($total, $page, $parm1, null, null, null);
                if ($total == 0) {
                    //Dep
                    $total = $paginador->contarResultados(null, $parm1, null, null);
                    $paginador->traerDatos($total, $page, null, $parm1, null, null);
                }
                if ($total == 0) {
                    //Buscar
                    $total = $paginador->contarResultados(null, null, null, $parm1);
                    $paginador->traerDatos($total, $page, null, null, null, $parm1);
                }
            } else {

                $page = (intval(substr($parm1, 4)) >= 0) ? intval(substr($parm1, 4)) : 0;

                //si el 1 parametro es de paginacion es busqueda con 0 parametros
                //Cat
                $total = $paginador->contarResultados(null, null, null, null);
                $paginador->traerDatos($total, $page, null, null, null, null);
            }
        } else {

            //si el 1 parametro es de paginacion es busqueda con 0 parametros
            //Cat
            $total = $paginador->contarResultados(null, null, null, null);
            $paginador->traerDatos($total, $page, null, null, null, null);
        }

        $title = "Anuncios gratis de";
        $description = "Busca y Publica gratis tus anuncios ";
        if ($paginador->categoria != "") {
            $title .= " $paginador->categoria";
            $description .= " $paginador->categoria";
            if ($paginador->departamento != "") {
                $title .= " en $paginador->departamento";
                $description .= " en $paginador->departamento";
                if ($paginador->municipio != "") {
                    $title .= ", $paginador->municipio";
                    $description .= ", $paginador->municipio";
                }
            } else {
                $title .=" en Colombia";
                $description .=" en Colombia";
            }
        } elseif ($paginador->departamento != "") {
            $title .= " en $paginador->departamento";
            $description = "Busca y Publica gratis tus anuncios eroticos en $paginador->departamento";
            if ($paginador->municipio != "") {
                $title .= ", $paginador->municipio";
                $description .= ", $paginador->municipio";
            }
        } else {
            $title .=" eroticos gratis en Colombia";
            $description = "Clasificados eróticos profesionales, publica gratis anuncios eroticos en Colombia o busca tu placer preferido";
        }
        $title .=" - Paginaerotica.com";

        $description .= ". Anuncios eroticos gratis en Paginaerotica.com";

        $canonical = "http://www.paginaerotica.com/";
        $canonical .= ((isset($parm1)) ? "$parm1/" : "") . ((isset($parm2)) ? "$parm2/" : "") . ((isset($parm3)) ? "$parm3/" : "");
        $keywords  .= "gratis,anuncios,escorts,publicar,gay,travesti,gigolo,masajes eroticos,relaciones,ocasionales,encontrar,contactos,sexuales,"
                . "paginas,web cam,prepago,colombia,clasificados";
    }
}

$pages = $paginador->pages;
