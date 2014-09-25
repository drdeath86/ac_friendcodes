var pagina = 0;
var salto = 4;
var usr_id;
var usr_email;
var usr_nickname;

$(document).ready(function(){
    verificarSesion();
    modalIniciarSesion();
    modalRegistrar();
    registroCorreo();
    cargarOfertas();
    btnPeticion();
    login();
    cerrarSesion();
});

function cargarOfertas(){
    cadena = "pagina="+pagina+"&salto="+salto;
    $.post("/php/index_db.php",
        cadena,
        function(data){
            
            bandera = 1;
            $.each(data.ofertas, function(i,val){
                //alert(val.usr_nickname);
                if(val.oferta_agregada === true){
                    etiquetaDisable = "disabled";
                }
                else{
                    etiquetaDisable = "";
                }
               
                
                if(bandera === 1){
                    $("#timeline_ofertas").append("<li><div class='timeline-badge'><i class='glyphicon glyphicon-check'></i></div><div class='timeline-panel'><div class='timeline-heading'><h4 class='timeline-title'>Oferta de "+val.usr_nickname+"</h4><p><small class='text-muted'><i class='glyphicon glyphicon-time'></i>Fecha de la Oferta: "+val.oferta_fecha+"</small></p></div><div class='timeline-body'><p>Friend Code: "+val.usr_fc+"</p><p>Precio Nabos: "+val.oferta_precio+"</p><hr><img src="+val.oferta_imagen+" alt='lel' class='img-thumbnail'><div><button type='button' class='btn btn-primary usr_peticion' id='"+val.oferta_id+"' "+etiquetaDisable+">Enviar mi FC</button></div></div></div></li>");
                    bandera = 0;
                }     
                else{
                    $("#timeline_ofertas").append("<li class='timeline-inverted'><div class='timeline-badge'><i class='glyphicon glyphicon-check'></i></div><div class='timeline-panel'><div class='timeline-heading'><h4 class='timeline-title'>Oferta de "+val.usr_nickname+"</h4><p><small class='text-muted'><i class='glyphicon glyphicon-time'></i>Fecha de la Oferta: "+val.oferta_fecha+"</small></p></div><div class='timeline-body'><p>Friend Code: "+val.usr_fc+"</p><p>Precio Nabos: "+val.oferta_precio+"</p><hr><img src="+val.oferta_imagen+" alt='lel' class='img-thumbnail'><div><button type='button' class='btn btn-primary usr_peticion' id='"+val.oferta_id+"' "+etiquetaDisable+">Enviar mi FC</button></div></div></div></li>");
                    bandera = 1;
                }
            });
            pagina += salto;
        },
        'json'
    );
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

function btnPeticion(){
    $("#timeline_ofertas").on("click", ".usr_peticion", function(){
        oferta_id = $(this).attr("id");
        //alert(oferta_id);
       $.post("/php/verifica_sesion.php",
        function(data){
            if(data.estado === true){
                //alert("Se ha iniciado sesion");
                cadena = "oferta_id="+oferta_id;
                //alert(cadena);
                $.post("/php/agregar_solicitud_db.php",
                    cadena,
                    function(data){
                        alert(data.solicitud_correcta);
                        $('#'+oferta_id+".usr_peticion").prop("disabled", true);
                        
                    },
                    'json'
                );
            }
            else{
                //alert("negativo");
                $('#myModal').modal('show');
            }
        },
        'json'
       );
    });
}



$(window).scroll(function(){
    if($(window).scrollTop() == $(document).height() - $(window).height()){
        cargarOfertas();
    }
 }); 
 
 


