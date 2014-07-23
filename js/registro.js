$(document).ready(function(){
    frm_registro_submit();
});

function frm_registro_submit(){
    $("#frm_registro").submit(function(e){
        validarCamposVacios();
        cadena = $(this).serialize();
        console.log(cadena);
        $.post("/php/registro_db.php",
            cadena,
            function(data){
                //alert(data.verificarValoresNulos);
            }
        );
        e.preventDefault();
    });
}

function validarCamposVacios(){
    if($("#usr_nickname").val() === ""){
        $("#alert_nickname").append('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Warning!</strong> Better check yourself</div>');
    }
    if($("#usr_fc").val() === ""){
        $("#alert_fc").append('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Warning!</strong> Better check yourself</div>');     
    }
    if($("#usr_email").val() === ""){
        $("#alert_email").append('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Warning!</strong> Better check yourself</div>');     
    }
    if($("#usr_password").val() === ""){
        $("#alert_password").append('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Warning!</strong> Better check yourself</div>');     
    }
}

