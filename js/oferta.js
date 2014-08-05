$(document).ready(function(){
    frm_oferta_submit();
});

function frm_oferta_submit(){
    $("#frm_oferta").submit(function(e){
        
    });
}

function validarCamposVacios(){
    validacionOferta = true;
  
    if($("#oferta_precio").val() === ""){
        $("alert_oferta_precio").append('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Necesitas </strong> un nickname.</div>');
    }   validacionOferta = false;
}

