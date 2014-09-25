<?php

function obtenerSolicitudes(){
    include './conexion_mysqli.php';
    $con = conexion_mysqli();
    
    $usr_id = $_SESSION['usr_id'];
    $arrayOfertas = array();
    
    $queryObtenerSolicitudesUsuario = "SELECT ac_oferta_id FROM ac_solicitudes_ofertas_usuarios WHERE ac_usuario_id = $usr_id";
    $resultadoSolicitudUsuarioOferta = $con->query($queryObtenerSolicitudesUsuario);

    while ($row=mysqli_fetch_row($resultadoSolicitudUsuarioOferta)){
        $arrayOfertas[] = $row[0];
    }
    
    return $arrayOfertas;
}

