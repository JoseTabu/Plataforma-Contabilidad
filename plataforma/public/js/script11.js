var host=$('#host').html();
var token = $("#token").val();
var tablaDatos = $(".asignar");
var dnis=new Array();

$( document ).ready(function() {

    pedirContables();


});

function pedirContables(){
    var route=host+"/contables";

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        dataType: 'json',
        success: function(data){

            mostrarContables(data);

        },
        error:function(){



        }
    });
}


function pedirGestoriasClientes(){
    var route=host+"/gestoriasclientes";

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        dataType: 'json',
        success: function(data){

            mostrarGestoriasClientes(data);
        },
        error:function(){



        }
    });
}


function mostrarContables(contables){


    var anadir="<ul class='contables '>";

    $(contables).each(function (key, value) {
        dnis.push(value.id);
        anadir=anadir+"<li class='list-group-item active'>"+value.name+" "+value.dni+"</li><ul id='contable"+value.id+"' class='sortable2'>";

            $(value.cliente).each(function (key2, value2){
                anadir=anadir+"<li id='"+value2.id+"' class='list-group-item'>"+value2.nombre+"</li>";
            });

        anadir=anadir+"</ul>"
    });

    anadir=anadir+"</ul>";
    tablaDatos.html(anadir);

    pedirGestoriasClientes();


}


function mostrarGestoriasClientes(gestorias){


    var anadir="<div id='acordeon'>";

    $(gestorias).each(function (key, value) {

        anadir=anadir+"<h3>"+value.nombre+"</h3><div><ul class='listaClientes sortable '>";

        $(value.clientes).each(function (key2, value2) {
            anadir=anadir+"<li id='"+value2.id+"' class='list-group-item'>"+value2.nombre+"</li>";
        });

        anadir=anadir+"</ul></div>";
    });

    anadir=anadir+"</div>";
    tablaDatos.append(anadir);


    $( "#acordeon").accordion({active: false, collapsible: true, heightStyle: "content"});

    $( ".sortable,.sortable2" ).sortable({
        connectWith: ".sortable2,.sortable"

    }).disableSelection();

    todoOk();
}


function todoOk()
{
    var tablaDatos = $(".datos");
    tablaDatos.append("<div class='boton-asignar'><button id='guardar' type='button' class='btn btn-success'>Guardar</button></div>");
    var route=host+"/asignarCliente";
    var clientes;

    $('#guardar').click(function(){


        $(dnis).each(function (key, value) {

            clientes=$("#contable"+value).sortable("toArray");

            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'POST',
                dataType: 'json',
                data: {clientes: clientes,contable:value},
                success: function(){

                },
                error:function(){

                }
            });

          

        });
    });
}