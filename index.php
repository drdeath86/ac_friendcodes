<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Index ACFriendCodes</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link href="/bootstrap-3.1.1-dist/css/bootstrap.css" rel="stylesheet" media="screen">
        <script src="/bootstrap-3.1.1-dist/assets/js/jquery.js"></script>
        <script src="/bootstrap-3.1.1-dist/js/bootstrap.min.js"></script>
        <!-- Estilos -->
        <link href="/css/estilos.css" rel="stylesheet">
        <link href="/css/timeline.css" rel="stylesheet">
        <!--JS-->
        <script src="/js/index.js"></script>
        <script src="/js/login_registro.js"></script>

    </head>
    <body>

        <?php
        if (isset($_SESSION['usr_id']) && isset($_SESSION['usr_nickname'])) {
            $html_nav = file_get_contents("html/layouts/navbar_login_layout.html");
        } else {
            $html_nav = file_get_contents("html/layouts/navbar_nologin_layout.html");
        }
        $doc = new DOMDocument();
        $doc->loadHTML(mb_convert_encoding($html_nav, 'HTML-ENTITIES', 'UTF-8'));
        ?>

        <div id="nav_bar"><?php echo $doc->saveHTML(); ?></div>
        <div class="container">
            <?php
            //SIMILAR AL NAV BAR, CARGAMOS DINAMICAMENTE LOS LAYOUTS PARA LAS VENTANAS MODALES
            //CARGAR VENTANA MODAL PARA INICIO DE SESION
            $modal_sesion_html = file_get_contents("html/layouts/modal_login_layout.html");
            $modal_sesion = new DOMDocument();
            $modal_sesion->loadHTML(mb_convert_encoding($modal_sesion_html, 'HTML-ENTITIES', 'UTF-8'));
            echo $modal_sesion->saveHTML();

            //CARGAR VENTANA MODAL PARA REGISTRO CON FACEBOOK Y CORREO
            $modal_registro_html = file_get_contents("html/layouts/modal_registro_layout.html");
            $modal_registro = new DOMDocument();
            $modal_registro->loadHTML(mb_convert_encoding($modal_registro_html, 'HTML-ENTITIES', 'UTF-8'));
            echo $modal_registro->saveHTML();
            ?>
            
            <div class="page-header">
                <h1 id="timeline">Timeline</h1>
            </div>
            <ul class="timeline" id="timeline_ofertas">
                
            </ul>
        </div>
    </body>
</html>

