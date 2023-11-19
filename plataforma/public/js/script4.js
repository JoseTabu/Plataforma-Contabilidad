var token = $("#token").val();
var escala=10;
var transformacionInicio;
var host=$('#host').html();
var gestorias;


$(document).ready(function(){
    Carga();
    transformar();
});

function transformar(valor){

    /*
    if(valor==null)
    {
        transformacionInicio= $("#gestorias").css('border-spacing');
        transformacionInicio=parseInt(transformacionInicio.substr(0,transformacionInicio.indexOf('px')));
        $("#gestorias").css('transform','translate(-'+transformacionInicio+'px,0)');
        $("#gestorias").css('transform','ms-translate(-'+transformacionInicio+'px,0)');
        $("#gestorias").css('transform','-webkit-translate(-'+transformacionInicio+'px,0)');
        $("#gestorias").css('transform','-moz-translate(-'+transformacionInicio+'px,0)');
    }
    else{
        valor=valor*escala;

        $("#gestorias").css('transform','translate(-'+(transformacionInicio+valor)+'px,0)');
        $("#gestorias").css('transform','ms-translate(-'+(transformacionInicio+valor)+'px,0)');
        $("#gestorias").css('transform','-webkit-translate(-'+(transformacionInicio+valor)+'px,0)');
        $("#gestorias").css('transform','-moz-translate(-'+(transformacionInicio+valor)+'px,0)');
    }
    */
}

function mostrarDatos(res,palabra){

    if(palabra!=null&&palabra!="")
    {
        var nuevoRes=[];

        for (i = 0; i < res.length; i++) {
            if(res[i].dni.toLowerCase().indexOf(palabra.toLowerCase())>=0 || res[i].nombre.toLowerCase().indexOf(palabra.toLowerCase())>=0 ){
                nuevoRes.push(res[i]);
            }
        }

        res=nuevoRes;
    }

    var tablaDatos=$("#gestorias");
    tablaDatos.empty();

    var numero=0;
    var tamano=res.length;

    var guardar="";
    var colum;


    $(res).each(function(key,value){


        var pendientes;
        if(value.procesados==1)
        {
            pendientes="pendientes";
        }
        else
        {
            pendientes=""
        }

        guardar=guardar+"<div class='gestoria "+pendientes+"'>"+"<p data-informacion='"+value.id+"' class='logo-empresa'>"+"</p>"+"<div class='centrartotal'>"+"<p class='nombre'>"+value.nombre+"</p>"+"<p class='dni'>"+value.dni+"</p>"+"<p class='clave'><i class='fa fa-briefcase'></i>"+value.clave+"</p>"+"<p class='clave_clientes'><i class='fa fa-users'></i>"+value.clave_clientes+"</p><div><button class='btn btn-primary' onclick='ponmeGestoria(\""+value.id+"\")'><i class='fa fa-hand-o-up'></i></button><button value="+value.id+" OnClick='Mostrar(this);' class='btn btn-warning' data-toggle='modal' data-target='#myModal'><i class='fa fa-pencil'></i></button><button class='btn btn-danger' value="+value.id+" OnClick='Eliminar(this);'><i class='fa fa-trash'></i></button></div></div></div>";



        numero++;

        tablaDatos.append(guardar);
        guardar="";
        var maximo=tamano*escala;

        if(tamano<=4)
        {
            maximo=0;
        }

        $('#slider').slider(
            {

                max:maximo,
                slide: function( event, ui ) {
                    var valor = ui.value;
                    transformar(valor);
                }
            }
        );


        transformar();

    });
    logosEmpresas();

}

function logosEmpresas(){


    $('.logo-empresa').each(function(i, ob) {

        var id=$(this).attr("data-informacion");
        var route=host+"/storage/G-"+id+".png";
        var image="<img onerror='this.src=\"\"' src='"+route+"'>";
        $(this).html(image);
        /*
        var that=$(this);
        var route = host+"/getLogo";
        */
        /*
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            dataType: 'json',
            data:{"id":id},
            success: function(data){
                var texto=data.imagen;
                console.log(data.imagen);
                that.html("pana"+texto);
            },
            fail:function(){
            }
        });
        */


    });
}

function Carga(){

    var tablaDatos = $("#datos");
    var route = host+"/gestorias";


    tablaDatos.append("<div id='gestorias'></div>");
    tablaDatos=$("#gestorias");



    $.get(route, function(res){
        gestorias=res;
        tamano=res.length;

        mostrarDatos(res);



        $("#buscar").keyup(function() {

            bclientes = $(this).val();

            mostrarDatos(res,bclientes);
        });



    });
}

function Eliminar(btn){
    var route = host+"/gestoria/"+btn.value+"";


    if(confirm("¿Seguro que desea borrar?"))
    {
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(){
            if($("#msj-success:visible"))
                $("#msj-success").fadeOut();
            Carga();

            if(($("#msj-error:hidden")))
                $("#msj-error").fadeIn();
            transformar();
        }
    });
    };
}

function ponmeGestoria(id)
{

    var route = host+"/ponmeGestoria";


    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{"id":id},
        success: function(data){
            window.location.replace("cliente");
        },
        fail:function(){
        }
    });
}

function Mostrar(btn){
    var route = host+"/gestoria/"+btn.value+"/edit";

    $.get(route, function(res){
        $("#nombre").val(res.nombre);
        $("#dni").val(res.dni);
        $("#clave").val(res.clave);
        $("#clave_clientes").val(res.clave_clientes);
        $("#id").val(res.id);
    });
}


$("#actualizar").click(function(){
    var value = $("#id").val();
    var dato3 = $("#dni").val();
    var dato = $("#nombre").val();
    var dato2 = $("#clave").val();
    var dato4 = $("#clave_clientes").val();
    var route = host+"/gestoria/"+value+"";
    var token = $("#token").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data: {nombre: dato,dni:dato3,clave: dato2,clave_cliente:dato4},
        success: function(){

            if(($("#msj-error:visible")))
                $("#msj-error:visible").fadeOut();
            Carga();

            $("#myModal").modal('toggle');
            if($("#msj-success:hidden"))
                $("#msj-success").fadeIn();

        },
        error:function(){


                $("#msj-error").fadeIn();
                 $("#msj-info").fadeIn();

            $('.close').click(function(event){
                $(this.parentNode).fadeOut();
            });


        }
    });
});











