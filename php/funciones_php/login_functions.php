<?php

function verificarDatosLogin($usr_login_email, $usr_password){
    $json_datos = new stdClass();
    
    $queryDatosLogin = "SELECT usr_email, usr_password FROM ac_usuarios WHERE usr_email = '$usr_login_email'";
    //echo $queryDatosLogin;
    $queryResultado = mysql_query($queryDatosLogin);
    $num            = mysql_num_rows($queryResultado);
    
    if($num > 0){
        $usr_login_email_db = mysql_result($queryResultado, 0, "usr_email");
        $usr_password_db    = mysql_result($queryResultado, 0, "usr_password");
        
        $json_datos->usr_login_email_db = TRUE;
        
        //VERIFICACION DE CONTRASEÑA
        $json_datos->usr_password_db = verificarPassword($usr_password, $usr_password_db);
        $json_datos->valoresNulos = TRUE;
    }
    else{
        $json_datos->usr_login_email_db = FALSE;
        $json_datos->usr_password_db = FALSE;
        $json_datos->valoresNulos = TRUE;
    }
    
    return $json_datos;
}

function verificarPassword($usr_password, $usr_password_db){
    if(password_verify($usr_password, $usr_password_db)){
        return TRUE;
    }
    else{
        //echo crypt($usr_password, $usr_password_db);
        return FALSE;
    }
}



