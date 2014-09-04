var pagina = 0;
var salto = 4;

$(document).ready(function(){    
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
                if(bandera == 1){
                    $("#timeline_ofertas").append("<li><div class='timeline-badge'><i class='glyphicon glyphicon-check'></i></div><div class='timeline-panel'><div class='timeline-heading'><h4 class='timeline-title'>Oferta de "+val.usr_nickname+"</h4><p><small class='text-muted'><i class='glyphicon glyphicon-time'></i>Fecha de la Oferta: "+val.oferta_fecha+"</small></p></div><div class='timeline-body'><p>Friend Code: "+val.usr_fc+"</p><p>Precio Nabos: "+val.oferta_precio+"</p><hr><img src="+val.oferta_imagen+" alt='lel' class='img-thumbnail'><div><button type='button' class='btn btn-primary peticion' id='usr_peticion'>Primary</button></div></div></div></li>");
                    bandera = 0;
                }     
                else{
                    $("#timeline_ofertas").append("<li class='timeline-inverted'><div class='timeline-badge'><i class='glyphicon glyphicon-check'></i></div><div class='timeline-panel'><div class='timeline-heading'><h4 class='timeline-title'>Oferta de "+val.usr_nickname+"</h4><p><small class='text-muted'><i class='glyphicon glyphicon-time'></i>Fecha de la Oferta: "+val.oferta_fecha+"</small></p></div><div class='timeline-body'><p>Friend Code: "+val.usr_fc+"</p><p>Precio Nabos: "+val.oferta_precio+"</p><hr><img src="+val.oferta_imagen+" alt='lel' class='img-thumbnail'><div><button type='button' class='btn btn-primary peticion' id='usr_peticion'>Primary</button></div></div></div></li>")
                    bandera = 1;
                }
            });
            pagina += salto;
        },
        'json'
    );
}

function btnPeticion(){
    $(".peticion").on("click", function(){
       alert("Hola Mundo");
    });
}



$(window).scroll(function(){
    if($(window).scrollTop() == $(document).height() - $(window).height()){
        cargarOfertas();
    }
 }); 
 
 


