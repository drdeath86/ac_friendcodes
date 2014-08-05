function modalIniciarSesion(){
	$("#nav_bar").on("click", "#loginButton", function(e){
		$('#myModal').modal('show');
	});
}

function modalRegistrar(){
	$("#nav_bar").on("click", "#registroButton", function(e){
		$('#myModal2').modal('show');
	});
}

function login() {
    $('#sesion_btn').click(function(e) {
        correo = $('#usr_email_login').val().toLowerCase();
        password = $('#usr_password_login').serialize();
        cadena = 'usr_email_login=' + correo + '&' + password;
        alert(cadena);
        $.post("/php/login_db.php",
                cadena,
                function(data) {
                    validarDatosLogin(data.usr_login_email_db, data.usr_password_db);
                    if (data.valoresNulos && data.usr_login_email_db && data.usr_password_db) {
                        alert("LOGIN");
                    }
                    else {
                        alert("Datos erroneos");
                    }
                },
                'json');
        e.preventDefault();
    });
}

function validarDatosLogin(usr_login_email_db, usr_password_db){
    if(usr_login_email_db === false){
        $("#alert_email").empty();
        $("#alert_email").append('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Este correo </strong> no esta registrado.</div>');        
    }
    if(usr_password_db === false){
        $("#alert_password").empty();
        $("#alert_password").append('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Password </strong> incorrecto.</div>');
    }
}



