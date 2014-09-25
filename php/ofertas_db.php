<?php

ini_set('display_errors',1); 
error_reporting(E_ALL ^ E_DEPRECATED);

//include './conexion_db.php';
//$con    = conexion();
include './conexion_mysqli.php';
$con    = conexion_mysqli();

include './funciones_php/oferta_funciones.php';
include './funciones_php/funciones_generales.php';

session_start();

$usr_id      = $_SESSION['usr_id'];
$usr_oferta  = verificaParametroVacio($_REQUEST['oferta_precio']);

$json = new stdClass();

$arrayValoresOferta = array( 0 => $usr_id,
                             1 => $usr_oferta);

$json->verificarValoresNulos = verificarValoresNulos($arrayValoresOferta);

if($json->verificarValoresNulos){
    $queryOferta = "INSERT INTO ac_ofertas (oferta_fecha, oferta_precio, oferta_imagen, oferta_num_ofertas, oferta_num_max_ofertas) VALUES (NOW(), $arrayValoresOferta[1], NULL,0,5)";
    
    try{
        $con->autocommit(FALSE);
        
        $resultadoOferta = $con->query($queryOferta);
        if($resultadoOferta == false){
            throw new Exception('Wrong SQL: ' . $queryInsertUsuario . ' Error: ' . $con->error);
        }
        else{
            $id_oferta = $con->insert_id;
            $queryUsuarioOferta = "INSERT INTO ac_ofertas_usuarios (ou_oferta_id, ou_usuario_id) VALUES ($id_oferta, $usr_id)";
            $resultadoUsuarioOferta = $con->query($queryUsuarioOferta);
            if($resultadoUsuarioOferta == false){
                throw new Exception('Wrong SQL: ' . $queryInsertUsuario . ' Error: ' . $con->error);
            }
            else{
                $json->oferta = TRUE;
                $json->id_oferta = $id_oferta;
                $con->commit();
            }
        }  
    } 
    catch (Exception $ex) {
        $con->rollback();
        $json->oferta = FALSE;
        $json->id_oferta = NULL;
    }
    
    //$_SESSION['ultima_oferta'] = $json->id_oferta;
    
    echo json_encode($json);
}

//if($json->verificarValoresNulos){
//    $queryOferta = "INSERT INTO ac_ofertas (oferta_fecha, oferta_precio, oferta_imagen) VALUES (NOW(), $arrayValoresOferta[1], NULL)";
//    $resOferta = mysql_query($queryOferta, $con);
//    //echo $res;
//    
//    if($resOferta == TRUE){
////        $json->query    = $queryOferta;
////        $json->oferta   = TRUE;
//        $id_oferta = mysql_insert_id();
//        
//        $queryUsuarioOferta = "INSERT INTO ac_ofertas_usuarios (ou_oferta_id, ou_usuario_id) VALUES ($id_oferta, $usr_id)";
//        $resUsuarioOferta = mysql_query($queryUsuarioOferta, $con);
//                
//        if($queryUsuarioOferta == TRUE){
//            $json->oferta = TRUE;
//            $json->id_oferta = $id_oferta;
//        }
//        else{
//            $json->oferta = FALSE;
//            $json->id_oferta = null;
//        }
//    }
//    else{
//        //$json->query    = $queryOferta;
//        $json->oferta   = FALSE;
//        $json->id_oferta = null;
//    }
//    
//    echo json_encode($json);
//}
