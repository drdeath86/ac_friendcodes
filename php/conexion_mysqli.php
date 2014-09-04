<?php

function conexion_mysqli(){
    $DBServer = 'ubuntu'; // e.g 'localhost' or '192.168.1.100'
    $DBUser   = 'root';
    $DBPass   = 'root';
    $DBName   = 'ac_friendcodes';
    
    $con = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
    
    if ($con->connect_error) {
        trigger_error('Database connection failed: '  . $con->connect_error, E_USER_ERROR);
    }
    else{
        return $con;
    }
        
}

//conexion_mysqli();

