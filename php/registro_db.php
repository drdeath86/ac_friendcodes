<?php

//ini_set('display_errors',1); 
//error_reporting(E_ALL);
session_start();

include './conexion_db.php';
$con = conexion();
include './registro_funciones.php';

//VARIABLES QUE RECIBE ESTE ARCHIVO

//$usr_nickname   = $_REQUEST['usr_nickname'];
//$usr_fc         = $_REQUEST['usr_fc'];
//$usr_email      = $_REQUEST['usr_email'];
//$usr_password   = $_REQUEST['usr_password'];
//$usr_password2  = $_REQUEST['usr_password2'];

$usr_nickname   = verificaParametroVacio($_REQUEST['usr_nickname']);
$usr_fc         = verificaParametroVacio($_REQUEST['usr_fc']);
$usr_email      = verificaParametroVacio($_REQUEST['usr_email']);
$usr_password   = verificaParametroVacio($_REQUEST['usr_password']);
$usr_password2  = verificaParametroVacio($_REQUEST['usr_password2']);

//$respuesta_json = NULL;
$json = new stdClass();

$arrayValoresdeRegistro = array( 0 => $usr_nickname,
                                1 => $usr_fc,
                                2 => $usr_email,
                                3 => $usr_password,
                                4 => $usr_password2);

$json->verificarValoresNulos = verificarValoresNulos($arrayValoresdeRegistro);

if($json->verificarValoresNulos){
    $json->verificarUsuarioNickName = verificarUsuarioNickname($arrayValoresdeRegistro[0]);
    $json->verificarFriendCode = verificarFriendCode($arrayValoresdeRegistro[1]);
    $json->verificarEmail = verificarEmail($arrayValoresdeRegistro[2]);
}

echo json_encode($json);



//http://acfriendcodes/php/registro_db.php?usr_nickname=carlos&usr_fc=1234&usr_email=carlos.mejia.rueda@gmail.com&usr_password=nirvana&usr_password2=nirvana1

