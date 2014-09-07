<?php

session_start();

$respuestaJSON = NULL;
$json = new stdClass();

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_SESSION['usr_id']) && isset($_SESSION['usr_email'])) {
    //echo "ha iniciado sesion ". $_SESSION['usuario_email'];
    $respuestaJSON = array(
        'usr_id' => $_SESSION['usr_id'],
        'usr_email' => $_SESSION['usr_email'],
        'usr_nickname' => $_SESSION['usr_nickname'],
        'estado' => true
    );
} else {
    $respuestaJSON = array(
        'estado' => false
    );
}

//$json->sesion = $respuestaJSON;

echo json_encode($respuestaJSON);
