<?php

include_once './bd/Anuncio.php';
include_once './bd/Paginador.php';

$total = 0;
// How many items to list per page
define("LIMIT", 4);
$limit = LIMIT;
$paginador = new Paginador(LIMIT);

if (isset($_GET)) {

    $parm1 = filter_input(INPUT_GET, 'parm1');
    $parm2 = filter_input(INPUT_GET, 'parm2');
    $parm3 = filter_input(INPUT_GET, 'parm3');
    $parm4 = filter_input(INPUT_GET, 'parm4');
    $parm5 = filter_input(INPUT_GET, 'parm5');        
    
    $parm1 = (isset($parm1))?str_replace('-', ' ', $parm1):$parm1;
    $parm2 = (isset($parm2))?str_replace('-', ' ', $parm2):$parm2;
    $parm3 = (isset($parm3))?str_replace('-', ' ', $parm3):$parm3;
    $parm4 = (isset($parm4))?str_replace('-', ' ', $parm4):$parm4;
    $parm5 = (isset($parm5))?str_replace('-', ' ', $parm5):$parm5;
    $page = 0;
//    echo $parm1;
//    echo $parm2;
//    echo $parm3;
//    echo $parm4;
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
}
$pages = $paginador->pages;