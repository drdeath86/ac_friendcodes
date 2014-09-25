<?php
    
    ini_set('display_errors',1); 
    error_reporting(E_ALL ^ E_DEPRECATED);
    
    include 'conexion_mysqli.php';
    include './funciones_php/login_functions.php';
    
    $con = conexion_mysqli();
    
    session_start();
    
    $usr_id         = $_SESSION['usr_id'];
    $usr_pass_old   = $_REQUEST['usr_pass_old'];
    $usr_pass_new   = $_REQUEST['usr_pass_new'];
    $usr_pass_new2  = $_REQUEST['usr_pass_new2'];
    
    $json = new stdClass();
    
//    $usr_id = 2;
//    $usr_pass_old = 'nirvana';
//    $usr_pass_new = 'nirvana1';
    
    $queryVerificaPassAnterior = "SELECT usr_password FROM ac_usuarios WHERE usr_id = $usr_id";
    //echo $queryVerificaPassAnterior;
    
    $resultadoVerificaPassAnterior = $con->query($queryVerificaPassAnterior);
    
    while($row=mysqli_fetch_row($resultadoVerificaPassAnterior)){
        $dbpasswd = $row[0];
    }
    
    if($dbpasswd != NULL){
        //echo "pass1: " . $usr_pass_old;
        //echo "pass2: " . $dbpasswd;
        
        $verificaPass = verificarPassword($usr_pass_old, $dbpasswd);
        
        //echo "verificapass: ".$verificaPass;
        
        if($verificaPass){
            $password_nuevo = password_hash($usr_pass_new, PASSWORD_DEFAULT);
            $queryActualizaPass = "UPDATE ac_usuarios SET usr_password = '$password_nuevo' WHERE usr_id = $usr_id";
            //echo $queryActualizaPass;
            $con->query($queryActualizaPass);
            //echo "Cambio correcto de contrasenia";
            $json->pass_check = TRUE;
        }
        else{
            //echo "La contraseña es falsa";
            $json->pass_check = FALSE;
        }
    }
    else{
        $json->pass_check = FALSE;
        //echo "Algo horrendo paso D:";
    }
    
    echo json_encode($json);
    