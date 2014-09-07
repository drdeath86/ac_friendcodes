<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include './conexion_mysql.php';
$con = conexion_mysqli();

$usr_principal_id = $_POST['usr_principal_id'];
$usr_secundario_id = $_POST['usr_secundario_id'];



