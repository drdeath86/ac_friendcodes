<?php

ini_set('display_errors',1); 
error_reporting(E_ALL);
session_start();

include './conexion_db.php';
$con = conexion();
include './registro_funciones.php';

//VARIABLES QUE RECIBE ESTE ARCHIVO

$usr_nickname   = $_REQUEST['usr_nickname'];
$usr_fc         = $_REQUEST['usr_fc'];
$usr_email      = $_REQUEST['usr_email'];
$usr_password   = $_REQUEST['usr_password'];

//$respuesta_json = NULL;
$json = new stdClass();

$arrayValoresdeRegistro = array( 0 => $usr_nickname,
                                1 => $usr_fc,
                                2 => $usr_email,
                                3 => $usr_password);

$respuesta_valores_nulos = verificarValoresNulos($arrayValoresdeRegistro,$con);
$respuesta_usuario_nickname = verificarUsuarioNickname($arrayValoresdeRegistro[0],$con);
$respuesta_usuario_fc = verificarFriendCode($arrayValoresdeRegistro[1],$con);

echo $respuesta_valores_nulos;
echo "Usuario Existe $respuesta_usuario_nickname";
echo "FC Existe $respuesta_usuario_fc";

//http://acfriendcodes/php/registro_db.php?usr_nickname=carlos&usr_fc=1234&usr_email=carlos.mejia.rueda@gmail.com&usr_password=nirvana

