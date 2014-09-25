<?php

ini_set('display_erros', 1);
error_reporting(E_ALL);
session_start();

include './conexion_mysqli.php';
$con = conexion_mysqli();
include './funciones_php/funciones_generales.php';

$usr_id = $_SESSION['usr_id'];
$oferta_id = verificaParametroVacio($_REQUEST['oferta_id']);
//$usr_id = 3;
//$oferta_id = 23;

$json = new stdClass();

$arrayValoresSolicitud = array( 0 => $usr_id,
                                1 => $oferta_id
                            );

$json->verificarValoresNulos = verificarValoresNulos($arrayValoresSolicitud);


if(TRUE){
    //VERIFICAMOS QUE EL NUMERO DE OFERTAS SEA MENOR QUE EL NUMERO DE OFERTAS MAXIMAS
    $queryVerificaNumMaxOfertas = "SELECT CASE WHEN oferta_num_ofertas < oferta_num_max_ofertas THEN TRUE ELSE FALSE END AS returnVal, oferta_num_ofertas FROM ac_ofertas WHERE oferta_id = $oferta_id";
    $resultadoVerificaNumMaxOfertas = $con->query($queryVerificaNumMaxOfertas);
    //echo $queryVerificaNumMaxOfertas;
    
    while ($row=mysqli_fetch_row($resultadoVerificaNumMaxOfertas)){
        $returnVal = $row[0];
        //echo "$row[0]";
        //echo "Num Max Ofertas $row[1]";
    }
    
    //VERIFICAMOS SI EL USUARIO YA EFECTUO UNA SOLICITUD A ESTA OFERTA
    $queryValidaOfertaExistente = "SELECT CASE WHEN EXISTS(SELECT ac_usuario_id FROM ac_solicitudes_ofertas_usuarios WHERE ac_usuario_id = $usr_id AND ac_oferta_id = $oferta_id) THEN TRUE ELSE FALSE END AS returnValidacion";
    //echo $queryValidaOfertaExistente;
    
    $resultadoValidaOfertaExistente = $con->query($queryValidaOfertaExistente);
    
    while ($row=  mysqli_fetch_row($resultadoValidaOfertaExistente)){
        $returnValidacion = $row[0];
    }
    
    //SI EL NUMERO DE OFERTAS ES MENOR AL NUMERO MAXIMO DE OFERTAS Y EL USUARIO NO HA EFECTUADO UNA OFERTA
    if($returnVal == TRUE && $returnValidacion == FALSE){
        //INSERTAMOS EN TABLA QUE RELACIONA SOLICITUDES Y USUARIOS
        $queryInsertarSolicitudUsuarioOferta = "INSERT INTO ac_solicitudes_ofertas_usuarios VALUES ($oferta_id, $usr_id)";
        try{
            $con->autocommit(FALSE);
            $resultadoSolicitudUsuarioOferta = $con->query($queryInsertarSolicitudUsuarioOferta);
            if($resultadoSolicitudUsuarioOferta == FALSE){
                $json->solicitud_correcta = FALSE;
                
                throw new Exception('Wrong SQL: ' . $queryInsertarSolicitudUsuarioOferta . ' Error: ' . $con->error);
            }
            else{
                //ACTUALIZAMOS EL NUMERO DE OFERTAS PARA EL ID DE OFERTA AFECTADO
                $queryUpdateOfertas = "UPDATE ac_ofertas SET oferta_num_ofertas = oferta_num_ofertas + 1 WHERE oferta_id = $oferta_id";
                $resultadoUpdateOfertas = $con->query($queryUpdateOfertas);
                if($resultadoUpdateOfertas == FALSE){
                    $json->solicitud_correcta = FALSE;
                    throw new Exception('Wrong SQL: ' . $resultadoUpdateOfertas . ' Error: ' . $con->error);
                }
                else{
                    //echo "Insercion correcta";
                    $con->commit();
                    $json->solicitud_correcta = TRUE;
                }
            }
        }
        catch (Exception $ex) {
            $con->rollback();
            $json->solicitud_correcta = FALSE;
        }
    }
    else{
        $json->solicitud_correcta = FALSE;
        //echo "NO se pudo lol";
    }
   
}

echo json_encode($json);
//echo $returnVal;



