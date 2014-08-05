//Utiliza login_registro.js

$(document).ready(function(){
    frm_registro_submit();
    modalIniciarSesion();
    modalRegistrar();
    login();
});

function frm_registro_submit(){
    $("#frm_registro").submit(function(e){
        //primero validamos que los campos no esten vacios
        validacionCamposVacios = validarCamposVacios();
        if(validacionCamposVacios === true){
            cadena = $(this).serialize();
            console.log(cadena);
            $.post("/php/registro_db.php",
            cadena,
                function(data){
                    existeNickName      = data.verificarUsuarioNickName;
                    existeFriendCode    = data.verificarFriendCode;
                    existeEmail         = data.verificarEmail;
                    
                    registro            = data.registro;
                    query               = data.query;
                    
                    if(registro === true){
                        alert("Registro exitoso");
                    }
                    else{
                        validarValoresExistentes(existeNickName, existeFriendCode, existeEmail);
                    }
                    
                    
                    
                },
                'json'
            );
        }
        e.preventDefault();
    });
}

function validarCamposVacios(){
    validacionNickName = true;
    validacionFriendCode = true;
    validacionEmail = true;
    validacionPassword = true;
    validacion = true;
    
    if($("#usr_nickname").val() === ""){
        $("#alert_nickname").append('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Necesitas </strong> un nickname.</div>');
        validacionNickName = false;
    }
    if($("#usr_fc").val() === ""){
        $("#alert_fc").append('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Necesitas </strong> proveer tu FriendCode para poder interactuar con los demas.</div>');     
        validacionFriendCode = false;
    }
    
    if($("#usr_email").val() === ""){
        $("#alert_email").append('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Necesitas</strong> un correo electronico.</div>');     
        validacionEmail = false;
    }
    
    if($("#usr_password").val() === ""){
        $("#alert_password").append('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Necesitas</strong> una contraseña.</div>');     
        validacionPassword = false;
    }
    
    if(validacionNickName && validacionFriendCode && validacionEmail && validacionPassword){
        valdacion = true;
    }
    else{
        validacion = false;
    }
    
    return validacion;
}

function validarValoresExistentes(nickname,friendcode,email){
//    validacionNickName = true;
//    validacionFriendCode = true;
//    validacionEmail = true;
//    validacion = true;
    
    if(nickname === true){
        $("#alert_nickname").empty();
        $("#alert_nickname").append('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Este nickname </strong> ya esta registrado, elige otro.</div>');
        //validacionNickName = false;
    }
    
    if(friendcode === true){
        $("#alert_fc").empty();
        $("#alert_fc").append('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Este Friend Code</strong> ya esta registrado.</div>');     
        //validacionFriendCode = false;
    }
    
    if(email === true){
        $("#alert_email").empty();
        $("#alert_email").append('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Este Email</strong> ya esta registrado.</div>');     
        //validacionEmail = false;
    }  
    
//    if(validacionNickName && validacionFriendCode && validacionEmail){
//        validacion = false;
//    }
//    else{
//        validacion = true;
//    }
//    
//    
//    return validacion;
}

