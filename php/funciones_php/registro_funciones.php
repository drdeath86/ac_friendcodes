<?php

//Verifica que el usuario no exista
//Regresa TRUE si existe el usuario
function verificarUsuarioNickname($nickname){
    $queryVeriNickname = "SELECT usr_nickname FROM ac_usuarios WHERE usr_nickname = '$nickname'";
    
    $queryResultado = mysql_query($queryVeriNickname);
    $num_rows = mysql_num_rows($queryResultado);
    
    if($num_rows > 0){
        return TRUE;
    }
    else {
        return FALSE;
    }
}

//Verifica que el Friend Code no se encuentre registrado
//Regresa TRUE si el FC ya esta registrado
function verificarFriendCode($friendcode){
    $queryFC = "SELECT usr_fc FROM ac_usuarios WHERE usr_fc = '$friendcode'";
    
    $queryResultado = mysql_query($queryFC);
    $num_rows = mysql_num_rows($queryResultado);
    
    if($num_rows > 0){
        return TRUE;
    }
    else{
        return FALSE;
    }
}

//Verifica que el correo electronico no se encuentre registrado
//Regresa TRUE si el correo ya existe
function verificarEmail($email){
    $queryEmail = "SELECT usr_email FROM ac_usuarios WHERE usr_email = '$email'";
    
    $queryResultado = mysql_query($queryEmail);
    $num_rows = mysql_num_rows($queryResultado);
    
    if($num_rows > 0){
        return TRUE;
    }
    else{
        return FALSE;
    }
}

function validaInsercionDatos($nick, $FC, $correo){
    if(!nick && !FC && !correo){
        return TRUE;
    }
    else{
        return FALSE;
    }
}



