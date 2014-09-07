<?php
    
    ini_set('display_errors',1); 
    error_reporting(E_ALL ^ E_DEPRECATED);
    session_start();
    
    if(isset($_SESSION['usr_id']) && isset($_SESSION['usr_nickname'])){
        $usr_id = $_SESSION['usr_id'];
        $where = "WHERE usr_id NOT IN ($usr_id)";
        $estado = TRUE;
    }
    else{
        $where = "";
        $estado = FALSE;
    }
    
    include './conexion_db.php';
    $con    = conexion();
    
    $json = new stdClass();
    $respuestaJSON = array();
    
    $pagina = $_REQUEST['pagina'];
    $salto  = $_REQUEST['salto'];
    
    $queryOfertas = "SELECT * FROM ac_ofertas_usuarios AS OU
                    INNER JOIN ac_usuarios AS USUARIOS ON OU.ou_usuario_id = USUARIOS.usr_id
                    INNER JOIN ac_ofertas AS OFER ON OU.ou_oferta_id = OFER.oferta_id "
                    .$where
                    ." ORDER by oferta_fecha DESC 
                    LIMIT $pagina, $salto";
    
    //echo $queryOfertas;
    $resOfertas = mysql_query($queryOfertas, $con);
    $num        = mysql_num_rows($resOfertas);
    
    if($num > 0){
        for($i = 0; $i < $num; $i++){
            $respuestaJSON[] = array('usr_nickname' => mysql_result($resOfertas, $i, "usr_nickname"),
                                    'usr_fc' => mysql_result($resOfertas, $i, "usr_fc"),
                                    'oferta_precio' => mysql_result($resOfertas, $i, "oferta_precio"),
                                    'oferta_fecha' => mysql_result($resOfertas, $i, "oferta_fecha"),
                                    'oferta_imagen' => mysql_result($resOfertas, $i, "oferta_imagen"),
                                    'usr_id' => mysql_result($resOfertas, $i, "usr_id"));
        }
    }
    else{
        $respuestaJSON = array();
    }
    
    $json->ofertas = $respuestaJSON;
    $json->estado = $estado;
    
    echo json_encode($json);
    
