<?php

function verificarDatosLogin($usr_login_email, $usr_password){
    $json_datos = new stdClass();
    
    $queryDatosLogin = "SELECT usr_id, usr_email, usr_password, usr_nickname, usr_fc FROM ac_usuarios WHERE usr_email = '$usr_login_email'";
    //echo $queryDatosLogin;
    $queryResultado = mysql_query($queryDatosLogin);
    $num            = mysql_num_rows($queryResultado);
    
    if($num > 0){
        $usr_id_db          = mysql_result($queryResultado, 0, "usr_id");
        $usr_login_email_db = mysql_result($queryResultado, 0, "usr_email");
        $usr_password_db    = mysql_result($queryResultado, 0, "usr_password");
        $usr_nickname       = mysql_result($queryResultado, 0, "usr_nickname");
        $usr_fc             = mysql_result($queryResultado, 0, "usr_fc");
        
        //EXISTE EL CORREO
        $json_datos->usr_login_email_db = TRUE;
        //VERIFICACION DE CONTRASEÑA
        $json_datos->usr_password_db = verificarPassword($usr_password, $usr_password_db);
        //LOS VALORES NO SON NULOS
        $json_datos->valoresNulos = TRUE;
        //SI LOGIN Y PASSWORD = TRUE; INICIAMOS VARIABLES DE SESION
        if($json_datos->usr_login_email_db == TRUE && $json_datos->usr_password_db){
            session_start();
            session_destroy();
            
            session_start();
            //VARIABLES DE SESION
            $_SESSION['usr_id']         = $usr_id_db;
            $_SESSION['usr_email']      = $usr_login_email_db;
            $_SESSION['usr_nickname']   = $usr_nickname;
            $_SESSION['usr_fc']         = $usr_fc;   
        }
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



