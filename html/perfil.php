<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Registro ACFriendCodes</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link href="/bootstrap-3.1.1-dist/css/bootstrap.css" rel="stylesheet" media="screen">
        <script src="/bootstrap-3.1.1-dist/assets/js/jquery.js"></script>
        <script src="/bootstrap-3.1.1-dist/js/bootstrap.min.js"></script>
        <!-- Estilos -->
        <link href="/css/estilos.css" rel="stylesheet">
        <!--JS-->
        <script src="/js/registro.js"></script>

    </head>
    <body>

        <?php
        $html_nav = file_get_contents("layouts/navbar_nologin_layout.html");
        $doc = new DOMDocument();
        $doc->loadHTML(mb_convert_encoding($html_nav, 'HTML-ENTITIES', 'UTF-8'));
        ?>

        <div id="nav_bar"><?php echo $doc->saveHTML(); ?></div>
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title" id="nombrePerfil">Perfil de: </h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">Nombre: </li>
                        <li class="list-group-item">Friend Code: </li>
                        <li class="list-group-item">Nombre de pueblo: </li>
                        <li class="list-group-item">Ofertas hechas: </li>
                    </ul>
                    <button type="button" class="btn btn-default">Agregar a mi lista.</button>
                </div>
            </div>
        </div>
    </body>
</html>