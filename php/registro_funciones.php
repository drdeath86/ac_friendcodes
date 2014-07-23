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

//Verifica que el usuario no exista
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

//Verifica que el Friend Code no se encuentre registrado
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

//Verifica que el correo electronico no se encuentre registrado
function verificarEmail($email){
    $queryEmail = "SELECT usr_email FROM ac_usuarios WHERE usr_email = '$email'";
    
    $queryResultado = mysql_query($queryEmail);
    
    if($queryResultado == FALSE){
        return FALSE;
    }
    else{
        return TRUE;
    }
}

function verificaParametroVacio($parametro){
    if(empty($parametro)){
        return NULL;
    }
    else{
        return $parametro;
    }
}


