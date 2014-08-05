<?php

//Verifica que el registro no contenga valores vacios
//Regresa: 
//FALSE si algun campo esta vacio
//TRUE si todos los campos tienen valor
function verificarValoresNulos(array $arrayValoresdeRegistro){
    $numeroElementos = count($arrayValoresdeRegistro);
    $respuesta = FALSE;
    for($i = 0; $i < $numeroElementos; $i++){
        if(!$arrayValoresdeRegistro[$i]){
            $respuesta = FALSE;
        }
        else{
            $respuesta = TRUE;
        }
    }
    return $respuesta;
}

function verificaParametroVacio($parametro){
    if(empty($parametro)){
        return NULL;
    }
    else{
        return $parametro;
    }
}