<?php
    
    ini_set('display_errors',1); 
    error_reporting(E_ALL ^ E_DEPRECATED);
    
    include './conexion_db.php';
    $con    = conexion();
    include './funciones_php/index_funciones.php';
    
    session_start();
    
    if(isset($_SESSION['usr_id']) && isset($_SESSION['usr_nickname'])){
        $usr_id = $_SESSION['usr_id'];
        $where = "WHERE usr_id NOT IN ($usr_id)";
        $estado = TRUE;
        $arrayOfertas = obtenerSolicitudes();
    }
    else{
        $where = "";
        $estado = FALSE;
        $arrayOfertas = array();
    }
    
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
        
        //print_r($arrayOfertas);
        for($i = 0; $i < $num; $i++){
            $oferta_id = mysql_result($resOfertas, $i, "oferta_id");
            if(in_array($oferta_id, $arrayOfertas)){
                $oferta_agregada = TRUE;
            }
            else{
                $oferta_agregada = FALSE;
            }
            
            $respuestaJSON[] = array('usr_nickname' => mysql_result($resOfertas, $i, "usr_nickname"),
                                    'usr_fc' => mysql_result($resOfertas, $i, "usr_fc"),
                                    'oferta_precio' => mysql_result($resOfertas, $i, "oferta_precio"),
                                    'oferta_fecha' => mysql_result($resOfertas, $i, "oferta_fecha"),
                                    'oferta_imagen' => mysql_result($resOfertas, $i, "oferta_imagen"),
                                    'usr_id' => mysql_result($resOfertas, $i, "usr_id"),
                                    'oferta_id' => mysql_result($resOfertas, $i, "oferta_id"),
                                    'oferta_agregada' => $oferta_agregada);
        }
    }
    else{
        $respuestaJSON = array();
    }
    
    $json->ofertas = $respuestaJSON;
    $json->estado = $estado;
    
    echo json_encode($json);
    
