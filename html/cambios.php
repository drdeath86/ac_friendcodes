<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
?>

<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Cambio de datos</title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap -->
        <link href="/bootstrap-3.1.1-dist/css/bootstrap.css" rel="stylesheet" media="screen">
        <script src="/bootstrap-3.1.1-dist/assets/js/jquery.js"></script>
        <script src="/bootstrap-3.1.1-dist/js/bootstrap.min.js"></script>
        <script src="/js/cambios.js"></script>
        <!-- Estilos -->
        <link href="/css/estilos.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
      <?php
        $html = file_get_contents("layouts/navbar_login_layout.html");
        $doc = new DOMDocument();
        
        $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
      ?>
    <div id="nav_bar"><?php echo $doc->saveHTML(); ?></div>
    <div class="container">
        <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">CAMBIO DE CONTRASEÑA</h3>
                </div>
                <div class="panel-body">
                    <form id="frm_registro" class="form-horizontal" role="form">
                        <div class="form-group"> 
                            <label for="usr_pass_old" class="col-sm-2 control-label">Contraseña actual: </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="usr_pass_old" name="usr_pass_old" placeholder="Escribe tu contraseña actual">
                            </div>
                        </div>
                        <div id="alert_pass_old"></div>
                        
                        <div class="form-group">
                            <label for="usr_pass_new" class="col-sm-2 control-label">Contraseña nueva: </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="usr_pass_new" name="usr_pass_new" placeholder="Escribe tu contraseña nueva">
                            </div>
                        </div>
                        <div id="alert_pass_new"></div>
                        
                        <div class="form-group">
                            <label for="usr_pass_new2" class="col-sm-2 control-label">Repetir contraseña nueva: </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="usr_pass_new2" name="usr_pass_new2" placeholder="Vuelve a escribir tu contraseña nueva"> 
                            </div>
                        </div>
                        <div id="alert_pass_new2"></div>
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" id="btn_cambio" class="btn btn-success">Cambiar Contraseña</button>
                            </div>
                        </div>
                        
                        <div id="alert_pass_notice"></div>
                    </form>
    </div> 
  </body>
</html>

