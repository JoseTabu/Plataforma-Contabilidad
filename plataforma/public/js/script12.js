var host=$('#host').html();
var token = $("#token").val();
var tablaDatos = $(".asignar");
var asignar=[];
var fechasSucio=[];
var fechas=[];
var indice;
var count;

$( document ).ready(function() {

    $( ".acordeon").accordion({active: false, collapsible: true, heightStyle: "content"});

    var i;
    count=$(".acordeon").children('div').length;
    for (i = 0; i < count; i++) {
        asignar[i]=0;
    }

    $( ".acordeon").click(function(esto){
        var target=$(esto.target);
        var email=target.text();
        indice=target.attr('referencia');
        acciones(email);
    });

});

function acciones(email){

    if(asignar[indice]==0)
    {
        var route=host+"/accio";
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            dataType: 'json',
            data: {email: email},
            success: function(data){
                ponDatos(data,email);
            },
            error:function(data){
            }
        });
    }

}

function ponDatos(data,email){

    fechas=[];
    fechasSucio=[];
    $('#acordeoncliente'+indice).html("");
    $(data).each(function (key, value) {
        fechasSucio.push(value.momento.substring(0, 10));
        $.each(fechasSucio, function(i, el){
            if($.inArray(el, fechas) === -1) {
                fechas.push(el);
                $('#acordeoncliente'+indice).append("<h3><i class='fa fa-spinner'></i>"+el+'</h3>');
                $('#acordeoncliente'+indice).append("<div class='table-responsive' id='cliente"+indice+"titulo"+el+"'><table class='table table-bordered'><tr><th><i class='fa fa-binoculars'></i>Accion</th><th><i class='fa fa-calendar'></i>Momento</th></tr></div>");
            }
        });

    });

    $(data).each(function (key, value) {
        var epoca=value.momento.substring(0, 10);
        $('#cliente'+indice+'titulo'+epoca+' table').append("<tr class='info'><td>"+value.nombre+"</td><td>"+value.momento+"</td></tr>");

    });

    $('#usuario'+indice).append("</div>");
    asignar[indice]=1;
    $('#acordeoncliente'+indice).accordion({active: false, collapsible: true, heightStyle: "content"});

}