<?php
    
    ini_set('display_errors',1); 
    error_reporting(E_ALL ^ E_DEPRECATED);

    include './conexion_db.php';
    $con = conexion();
    include './funciones_php/funciones_generales.php';
    include './funciones_php/login_functions.php';
    
    $usr_email_login    = verificaParametroVacio($_REQUEST['usr_email_login']);
    $usr_password_login = verificaParametroVacio($_REQUEST['usr_password_login']);
    
    $json = new stdClass();
    
    $arrayValoresLogin = array( 0 => $usr_email_login,
                               1 => $usr_password_login);
    
    $verificarValoresnulos = verificarValoresNulos($arrayValoresLogin);
    
    if($verificarValoresnulos){
        //REGRESA UN JSON CON LOS PARAMETROS DE VALIDACION PARA SU MANIPULACION EN JS
        $json = verificarDatosLogin($arrayValoresLogin[0], $arrayValoresLogin[1]);
    }
    else{
        $json->valoresNulos = FALSE;
    }
    
    echo json_encode($json);
    
    
    
    

