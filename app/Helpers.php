<?php
/* Cambiar el fomato de la fecha para guardar a la Base de Datos */
function formatoFecha($fo){
    if($fo != ""){
        $fv = explode("/",$fo);

        $fm = $fv[2]."-".$fv[1]."-".$fv[0];
    }else{
        $fm = "";
    }

    return $fm;
}
/* Cambiar el formato de la fecha para mostrar en pantalla */
function formatoFechaReporte($fo){
    if($fo != ""){
        $fv = explode("-",$fo);

        $fm = $fv[2]."/".$fv[1]."/".$fv[0];
    }else{
        $fm = "";
    }

    return $fm;
}
/** Busca dentro de un array devuelve true or false */
function buscarDato($lista, $buscar){
    for($i=0; $i<count($lista); $i++){
        if($lista[$i]->id_uni == $buscar){
            return true;
        }
    }
}