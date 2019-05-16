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
    if($num > 0){
        $signo = '';
        $n = explode('.',$num);
    }elseif($num < 0){
        $signo = substr($num,1,1);
        $num = substr($num,1);
        $n = explode('.',$num);
    }else{
        return $num;
    }
    
    if(isset($n[1])){
        $decimal = ",".$n[1];
    }else{
        $decimal = '';
    }

    if(strlen($n[0])>3){
        $uno = strlen($n[0]) % 3;
        $con = 1;
        $fin = '';
        
        for($i=0; $i<strlen($n[0]); $i++){
            if($i < $uno){
                $fin .= $n[0][$i];
            }else{
                if($con <= 3){
                    if($con == 1){
                        $fin .= '.'.$n[0][$i];
                    }else{
                        $fin .= $n[0][$i];
                    }
                }
                $con = $con + 1;
            }
        }
        
        if($signo != ''){
            return $signo.$fin.$decimal;
        }else{
            return $fin.$decimal;
        }
    }else{
        if($signo != ''){
            return $signo.$n[0].$decimal;
        }else {
            return $n[0].$decimal;
        }
    }
}