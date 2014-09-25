$(document).ready(function(){
    verificarSesion();
    cerrarSesion();
    frm_cambio_pass_submit();
});

function frm_cambio_pass_submit(){
    $("#frm_registro").submit(function(e){
        validacionCamposVacios = validarCamposVacios();
        if(validacionCamposVacios === true){
            cadena = $(this).serialize();
            //console.log(cadena);
            $.post("/php/cambios_db.php",
                cadena,
                function(data){
                    if(data.pass_check){
                        $("#alert_pass_notice").empty();
                        console.log(data.pass_check);
                        $("#alert_pass_notice").append('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Tu contraseña</strong> fue actualizada correctamente.</div>')
                    }
                    else{
                        $("#alert_pass_notice").empty();
                        console.log(data.pass_check);
                        $("#alert_pass_notice").append('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Tu contraseña </strong> actual no coincide, verificala nuevamente.</div>')
                    }
                    
                },
                'json'
            );
        }
         e.preventDefault();
    });
}

function validarCamposVacios(){
    validacionPassOld = true;
    validacionPassNew = true;
    validacionPassNew2 = true;
    
    if($("#usr_pass_old").val() === ""){
        $("#alert_pass_old").empty();
        $("#alert_pass_old").append('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Necesitas </strong> escribir tu contraseña actual.</div>');
        validacionPassOld = false;
    }
    
    if($("#usr_pass_new").val() === ""){
        $("#alert_pass_new").empty();
        $("#alert_pass_new").append('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Necesitas </strong> escribir tu contraseña nueva.</div>');
        validacionPassNew = false;
    }
    
    if($("#usr_pass_new2").val() === ""){
        $("#alert_pass_new2").empty();
        $("#alert_pass_new2").append('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Necesitas </strong> confirmar tu contraseña nueva.</div>');
        validacionPassNew2 = false;
    }
    
    if(validacionPassOld && validacionPassNew && validacionPassNew2){
        validacion = true;
    }
    else{
        validacion = false;
    }
    
    return validacion;
}

function verificarSesion(){
    $.post("/php/verifica_sesion.php",
        function(data){
            //alert(data.estado);
            if(data.estado === true){
                usr_id = data.usr_id;
                usr_nickname = data.usr_nickname;
                $("#botonMenUsuario").append("<span class='glyphicon glyphicon-list-alt'></span> "+usr_nickname);
            }
            else{
                //alert("No ha iniciado sesion");
            }
        },
        'json'
    );
}

function cerrarSesion() {
    $('#nav_bar').on("click", "#cerrar_sesion", function(e) {
        $.ajaxSetup({async: false});
        $.post("/php/cerrarSesion.php");
        var delay = 1000; //Your delay in milliseconds
        setTimeout(function() {
            window.location.href = "../index.php";
        }, delay);
        e.preventDefault();
        $.ajaxSetup({async: true});
    });
}
