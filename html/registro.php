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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">REGISTRO</h3>
                </div>
                <div class="panel-body">
                    <form id="frm_registro" class="form-horizontal" role="form">

                        <div class="form-group">
                            <label for="usr_nickname" class="col-sm-2 control-label">Nickname: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="usr_nickname" name="usr_nickname" placeholder="Nickname">
                            </div>
                        </div>
                        
                        <div id="alert_nickname"></div>

                        <div class="form-group">
                            <label for="usr_fc" class="col-sm-2 control-label">Friend Code: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="usr_fc" name="usr_fc" placeholder="Friend Code">
                            </div>
                        </div>
                        <div id="alert_fc"></div>

                        <div class="form-group">
                            <label for="usr_email" class="col-sm-2 control-label">Email: </label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="usr_email" name="usr_email" placeholder="Email">
                            </div>
                        </div>
                        <div id="alert_email"></div>

                        <div class="form-group">
                            <label for="usr_password" class="col-sm-2 control-label">Password: </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="usr_password" name="usr_password" placeholder="Password">
                            </div>
                        </div>
                        <div id="alert_password"></div>

                        <div class="form-group">
                            <label for="usr_password_conf" class="col-sm-2 control-label">Confirmacion Password: </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="usr_password_conf" name="usr_password2" placeholder="Confirma tu password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" id="btn_registro" class="btn btn-success">Registrarse!</button>
                            </div>
                        </div>
                    </form>
                    <div id="alert_registro"></div>
                </div>
            </div>
        </div>
    </body>
</html>
