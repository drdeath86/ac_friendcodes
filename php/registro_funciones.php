<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function verificarValoresNulos(array $arrayValoresdeRegistro){
    $numeroElementos = count($arrayValoresdeRegistro);
    $respuesta = FALSE;
    for($i = 0; $i < $numeroElementos; $i++){
        if(!$arrayValoresdeRegistro[$i]){
            echo $arrayValoresdeRegistro[$i];
            $respuesta = FALSE;
        }
        else{
            echo $arrayValoresdeRegistro[$i];
            $respuesta = TRUE;
        }
    }
    return $respuesta;
}

function verificarUsuarioNickname($nickname){
    $queryVeriNickname = "SELECT usr_nickname FROM ac_usuarios WHERE usr_nickname = '$nickname'";
    
    $queryResultado = mysql_query($queryVeriNickname);
           
    if($queryResultado == FALSE){
        return FALSE;
    }
    else {
        return TRUE;
    }
}

function verificarFriendCode($friendcode){
    $queryFC = "SELECT usr_fc FROM ac_usuarios WHERE usr_fc = '$friendcode'";
    
    $queryResultado = mysql_query($queryFC);
    
    if($queryResultado == FALSE){
        return FALSE;
    }
    else{
        return TRUE;
    }
}
