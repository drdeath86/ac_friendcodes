<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
if(!isset($_SESSION['usr_id']) && !isset($_SESSION['usr_nickname'])){
    header('Location: http://acfriendcodes');
}
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
        <script type="text/javascript" src="/js/jquery.form.min.js"></script>
        <!-- Estilos -->
        <link href="/css/estilos.css" rel="stylesheet">
        <!--JS-->
        
        <script src="/js/oferta.js"></script>
        

    </head>
    <body>
        <?php
            
        
            echo $_SESSION['usr_id'];
            echo $_SESSION['usr_nickname'];
            
            if (isset($_SESSION['usr_id']) && isset($_SESSION['usr_nickname'])) {
                $html_nav = file_get_contents("layouts/navbar_login_layout.html");
            } else {
                $html_nav = file_get_contents("layouts/navbar_nologin_layout.html");
            }

            $doc = new DOMDocument();
            $doc->loadHTML(mb_convert_encoding($html_nav, 'HTML-ENTITIES', 'UTF-8'));
        ?>

        <div id="nav_bar"><?php echo $doc->saveHTML(); ?></div>
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">OFERTAS</h3>
                </div>
                <div class="panel-body">
                    <form id="frm_oferta" class="form-horizontal" role="form">
                        
                        <div class="form-group">
                            <label for="oferta_precio" class="col-sm-2 control-label">Precio de compra de tus nabos: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="oferta_precio" name="oferta_precio" placeholder="Precio de compra de tus nabos">
                            </div> 
                        </div>
                        <div id="alert_oferta_precio"></div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" id="btn_oferta" class="btn btn-success">Publicar Oferta!</button>
                            </div>
                        </div>
                    </form>
                            <div class="col-sm-offset-2 col-sm-10">
                                <div id="mensaje_oferta"></div>
                            </div>
                            <form action="/php/processupload.php" method="post" enctype="multipart/form-data" id="MyUploadForm" class="form-horizontal">
                                <div class="form-group">
                                    <label for="oferta_precio" class="col-sm-2 control-label">Imagen a subir: </label>
                                    <div class="col-sm-10">
                                        <input name="image_file" id="imageInput" type="file" />
                                        <input name="id_oferta" id="id_oferta" type="hidden" value=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" id="cancel-btn" class="btn btn-danger">Cancelar</button>
                                        <button type="submit" id="submit-btn" class="btn btn-success">Subir Imagen</button>
                                        <img src="../img/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
                                    </div>
                                </div>
                                </form>
                            <div id="output"></div>
                       </div>
                   </div>
                </div>
           
    </body>
</html>
