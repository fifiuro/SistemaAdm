<?php
/* Cambiar el formato de la fecha para guardar a la Base de Datos */
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
        //dd($fv);

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
/** Formato de numero con decimales */
function formatoDecimal($num){
    $n = explode('.',$num);

    if(count($n) > 1){
        if($n[1] > 0){
            return number_format($num,2,",",".");
        }else {
            return number_format($num,0,",",".");
        }
    }else{
        return number_format($num,0,",",".");
    }
}
/** NOMBRE DEL MES */
function nombreMes($m){
    $mes = array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');

    return $mes[$m + 0];
}