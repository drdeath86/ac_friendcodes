var id_oferta;

$(document).ready(function(){
    
    $("#MyUploadForm").hide();
    frm_oferta_submit();
    var options = { 
			target: '#output',   // target element(s) to be updated with server response 
			beforeSubmit: beforeSubmit,  // pre-submit callback 
			success: afterSuccess,  // post-submit callback 
			resetForm: true,        // reset the form after successful submit 
		}; 
		
	 $('#MyUploadForm').submit(function(e) { 
			$(this).ajaxSubmit(options);  			
			// always return false to prevent standard browser submit and page navigation 
			return false;
		});  
    
    
});

function frm_oferta_submit(){
    $("#frm_oferta").submit(function(e){
        //alert("SUBMIT");
        //PRIMERO VALIDAMOS QUE LOS CAMPOS NO ESTEN VACIOS
        validacionCamposVacios = validarCamposVacios();
        if(validacionCamposVacios === true){
            cadena = $(this).serialize();
            //alert(cadena);
            $.post("/php/ofertas_db.php",
                cadena,
                function(data){
                    //alert(data.oferta);
                    alert(data.id_oferta);
                    ofertaExitosa = data.oferta;
                    if(ofertaExitosa){
                        $("#id_oferta").val(data.id_oferta);
                        $("#oferta_precio").attr('disabled', 'disabled');
                        $("#btn_oferta").attr('disabled', 'disabled');
                        $("#mensaje_oferta").append('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Oferta exitosa </strong>deseas subir una imagen?.</div>');
                        $("#MyUploadForm").show();
                    }
                    else{
                        alert("error");
                    }
                },
                'json'
            );
        }
        e.preventDefault();
    });
}

function validarCamposVacios(){
    validacionOferta = true;
  
    if($("#oferta_precio").val() === ""){
        $("alert_oferta_precio").append('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Necesitas </strong> un nickname.</div>');
        validacionOferta = false;
    }   
    
    return validacionOferta;
}

function afterSuccess()
{
    alert($('#id_oferta').val());
    $('#submit-btn').show();
    $('#submit-btn').attr('disabled', 'disabled'); //hide submit button
    $('#loading-img').hide(); //hide submit button
}

//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
		
		if( !$('#imageInput').val()) //check empty input filed
		{
			$("#output").html("Are you kidding me?");
			return false
		}
		
		var fsize = $('#imageInput')[0].files[0].size; //get file size
		var ftype = $('#imageInput')[0].files[0].type; // get file type
		

		//allow only valid image file types 
		switch(ftype)
        {
            case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
                break;
            default:
                $("#output").html("Unsupported file type!");
				return false
        }
		
		//Allowed file size is less than 1 MB (1048576)
		if(fsize>1048576) 
		{
			$("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
			return false
		}
				
		$('#submit-btn').hide(); //hide submit button
		$('#loading-img').show(); //hide submit button
		$("#output").html("");  
	}
	else
	{
		//Output error to older browsers that do not support HTML5 File API
		$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
		return false;
	}
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

