<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

include './conexion_mysqli.php';
$con = conexion_mysqli();
include './funciones_php/funciones_generales.php';
$json = new stdClass();

$usr_id = $_SESSION['usr_id'];
$arrayOfertas = array();

$queryObtenerSolicitudesUsuario = "SELECT ac_oferta_id FROM ac_solicitudes_ofertas_usuarios WHERE ac_usuario_id = $usr_id";
$resultadoSolicitudUsuarioOferta = $con->query($queryObtenerSolicitudesUsuario);

while ($row=mysqli_fetch_row($resultadoSolicitudUsuarioOferta)){
    $arrayOfertas[] = $row[0];
}

//print_r($arrayOfertas);

echo json_encode($arrayOfertas);





