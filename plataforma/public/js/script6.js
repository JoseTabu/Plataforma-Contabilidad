var idAhora;
var cliente_id=0;
var dropzone;
var token=$('#token').val();
var host=$('#host').html();
var bclientes="";
var clientes;
var pestanaActiva=false;
var administrador=false;

var esAdministrador=function(){

        $.ajax({
            url: host+"/esadministrador",
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            dataType: 'json',
            success: function(data){

                if(data)
                {
                    administrador=true;
                    CargaClientes();
                }else{
                    administrador=false;
                    CargaClientes();
                }

            },
            error: function(data){

                alert("Error interno comuniquese con el servicio tecnico");
            }
        });

    };





var opcionesDropzone= function () {
    return {url: host+"/verificacion",
        addRemoveLinks: true,
        maxFileSize: 1000,
        headers: {'X-CSRF-TOKEN': token},
        dictResponseError: "Ha ocurrido un error en el server",
        acceptedFiles: 'image/*,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF,application/pdf,.psd,.doc,.docx,.xlsx',
        sending:function(file, xhr, formData){
        formData.append("cliente_id", cliente_id);

    },
    init: function() {
        dropzone=this;
    },
    complete: function(file, xhr, formData)
    {
        if(file.status == "success")
        {
            mostrarArchivos();
            CargaClientes();
        }
    },
    error: function(file)
    {
        //Refresca la pagina
        location.reload();
    }};
}


$(document).ready(function(){




    //var scroll="<p id='valorPaginacion'>1</p><div id='scroll'></div>";
    //$(".paginacion").append(scroll);

    esAdministrador();


    $('#archivos').on('hide.bs.modal', function (event) {


        $('.dz-message').css('opacity','1');
        $('.dz-preview').remove();

    });





});

function enviarComentario(id){

    var comentario=$('#comentario').val();
    var route = host+"/comentario";

    //Comprobaciones como es vacio o no

    $.ajax({
        headers: {'X-CSRF-TOKEN': token},
        url: route,
        type: 'POST',
        dataType:"json",
        data:{"archivo_id":id,"comentario":comentario}
    }).done(function(data){

    });


}


function esUsuarioCliente(){

    $.ajax({
        url: host+"/esusuariocliente",
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        success: function(data){

            alert(data);
        },
        error: function(data){

            alert(data);
        }
    })

}


function procesar(name)
{
    if(confirm("¿Desea procesar el archivo?")) {

        $.ajax({
            url:  host + "/procesar",
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            dataType: 'json',
            data: {"name": name}
        }).done(function (data) {

            mostrarArchivos();
            CargaClientes();


        });
    }



}


function mostrarArchivos(){

    var route = host+"/archivos";

    var id=idAhora;
    var guardar="";



    $.ajax({
        headers: {'X-CSRF-TOKEN': token},
        url: host+"/archivos",
        type: 'POST',
        dataType:"json",
        data:{"id":id}
    }).done(function(data){


        //Que es el modal
        var modal=$('#archivos').modal();

        //Vacia el modal
        modal.find('.modal-body #contenido').html("");


        var titulos;
        var tabla;


        //Crea la tabla

        if(administrador) {
            titulos = "<thead><tr><th>Archivo</th><th>Fecha</th><th>Usuario</th><th>Estado</th><th>Borrar</th></tr></thead>";
            tabla = "<table class='table tablaArchivos '>" + titulos + "</table>";
        }else{

            titulos = "<thead><tr><th>Archivo</th><th>Fecha</th><th>Usuario</th><th>Estado</th><th>Borrar</th></tr></thead>";
            tabla = "<table class='table tablaArchivos '>" + titulos + "</table>";

        }

        //Ponemos todos los apartados

        var estadosContables;
        if(administrador){

            estadosContables="<h3>ESTADOS CONTABLES</h3><div id='estadosContablesArchivos'></div><div class='dropzone' id='estadosContables'></div>";
        }else{

            estadosContables="<h3>ESTADOS CONTABLES</h3><div id='estadosContablesArchivos'></div>";
        }

        var facturasRecibidas="<h3 data-grupo='0' class='pestana'>FACTURAS RECIBIDAS</h3><div><div id='facturasRecibidasArchivos'>"+tabla+"</div><div class='dropzone' id='facturasRecibidas'></div></div>";
        var facturasEmitidas="<h3 class='pestana' data-grupo='1' >FACTURAS EMITIDAS</h3><div ><div id='facturasEmitidasArchivos'>"+tabla+"</div><div class='dropzone' id='facturasEmitidas'></div></div>";
        var documentosBancarios="<h3  class='pestana' data-grupo='2'>DOCUMENTOS BANCARIOS</h3><div><div id='documentosBancariosArchivos'>"+tabla+"</div><div class='dropzone' id='documentosBancarios'></div></div>";
        var otrosDocumentos="<h3  class='pestana' data-grupo='3'>OTROS DOCUMENTOS</h3><div><div id='otrosDocumentosArchivos'>"+tabla+"</div><div class='dropzone' id='otrosDocumentos'></div></div>";

        var guardar=estadosContables+"<div id='accordeon'>"+facturasRecibidas+facturasEmitidas+documentosBancarios+otrosDocumentos+"</div>";



        //Pone los elementos estaticos
        modal.find('.modal-body #contenido').html(guardar);

        //Hacer un accordeon


        $( "#accordeon" ).accordion({
            active: parseInt(pestanaActiva),
            collapsible: true,heightStyle: "content"});

        $('.pestana').click(function(event){

            var grupo=$(this).attr('data-grupo');
            pestanaActiva=grupo;



        });


        //Para saber que cliente es el acutal
        cliente_id=id;



        //Congfiguracion dropzone
        var opcionesEstado=opcionesDropzone();



        opcionesEstado['acceptedFiles']="application/pdf";
        opcionesEstado['sending']=function(file, xhr, formData){


            //var names=["balance","perdidas"];
            //var nuevoNombre=file.name.toLowerCase().trim();

            //Cambiar a false en caso de comprobar nombre
            var booleano=true;

            /*
            for (i = 0; i < names.length; i++) {


                if(nuevoNombre.indexOf(names[i])> -1)
                {

                    var monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
                    ];

                    var fecha = new Date();
                    var mes = fecha.getMonth();
                    var anno = fecha.getFullYear();
                    booleano=true;

                    if(i==0)
                    {

                        var newNombre="Balance de Situacion "+monthNames[mes]+" "+anno;
                        formData.append("nuevo_nombre", newNombre);

                    }
                    else if(i==1)
                    {

                        var newNombre="Perdidas y Ganancias "+monthNames[mes]+" "+anno;
                        formData.append("nuevo_nombre", newNombre);

                    }
                }
            }*/

            if(booleano){
                formData.append("cliente_id", cliente_id);
                formData.append("grupo_id",1);
            }
            else{
                alert("El nombre no es correcto");
                return false;
            }



        };



        var opcionesFacturasRecibidas=opcionesDropzone();
        opcionesFacturasRecibidas['sending']=function(file, xhr, formData){
            formData.append("cliente_id", cliente_id);
            formData.append("grupo_id",2);
        };



        var opcionesFacturasEmitidas=opcionesDropzone();
        opcionesFacturasEmitidas['sending']=function(file, xhr, formData){
            formData.append("cliente_id", cliente_id);
            formData.append("grupo_id",3);
        };


        var opcionesDocumentosBancarios=opcionesDropzone();
        opcionesDocumentosBancarios['sending']=function(file, xhr, formData){
            formData.append("cliente_id", cliente_id);
            formData.append("grupo_id",4);
        };

        var opcionesotrosDocumentos=opcionesDropzone();
        opcionesotrosDocumentos['sending']=function(file, xhr, formData){
            formData.append("cliente_id", cliente_id);
            formData.append("grupo_id",5);
        };


        $("#estadosContables").dropzone(opcionesEstado);
        $("#facturasRecibidas").dropzone(opcionesFacturasRecibidas);
        $("#facturasEmitidas").dropzone(opcionesFacturasEmitidas);
        $("#documentosBancarios").dropzone(opcionesDocumentosBancarios);
        $("#otrosDocumentos").dropzone(opcionesotrosDocumentos);



        function anadirFila(selector,value) {

            var icono;
            var fila;
            if (administrador) {

                icono=value.procesado==0?"<i class=\"fa fa-ban\"></i>PENDIENTE":"<i class=\"fa fa-thumbs-o-up\">CONTABILIZADO</i>";
                fila ="<tr><td><a target='_blank' href="+host+"/archivocliente/"+value.ruta+" download='"+value.name.substr(0,value.name.lastIndexOf("_"))+"'>"+value.name.substr(0,value.name.lastIndexOf("_"))+"."+value.type+"</a></td><td>"+value.created_at+"</td><td>"+value.usuario_id+"</td><td class='clickable' onclick='procesar(\""+value.name+"\")'>"+icono+"</td><td><i onclick='borrarArchivo(\""+value.name+"\")' class=\"fa fa-trash-o\"></i></td></tr>";
                $(selector).append(fila);

            } else {

                icono=value.procesado==0?"<i class=\"fa fa-ban\"></i>PENDIENTE":"<i class=\"fa fa-thumbs-o-up\">CONTABILIZADO</i>";
                fila ="<tr><td><a target='_blank' download='"+value.name.substr(0,value.name.lastIndexOf("_"))+"' href="+host+"/archivocliente/"+value.ruta+">"+value.name.substr(0,value.name.lastIndexOf("_"))+"."+value.type+"</a></td><td>"+value.created_at+"</td><td>"+value.usuario_id+"</td><td>"+icono+"</td><td><i onclick='borrarArchivo(\""+value.name+"\")' class=\"fa fa-trash-o\"></i></td></tr>";
                $(selector).append(fila);
            }

        }



        //ordenar por propiedad

        var keysSorted = Object.keys(data).sort(function(a,b){return data[a].procesado-data[b].procesado});
        var nuevoDato=[];

        for (id in keysSorted) {
            nuevoDato.push(data[keysSorted[id]]);
        }



        //Cargar archvios

        $(nuevoDato).each(function(key,value) {

            switch(value.grupo_id) {
                case 1:
                    if (administrador) {
                        $('#estadosContablesArchivos').append("<div><div ><div style='display: table;margin: auto;'><a style='display: table-cell;vertical-align: middle;border:none;' download='"+quitarDni(value)+"' target='_blank' href="+host+"/archivocliente/" + value.ruta + " class='pdflogo'></a><a target='_blank' download='"+quitarDni(value)+"' style='display: table-cell;vertical-align: middle;'href='"+host+"/archivocliente/" + value.ruta + "'>" + value.name.substr(0, value.name.lastIndexOf("_")) + "." + value.type + "</a></a><i onclick='borrarArchivo(\"" + value.name + "\")' class=\"fa fa-trash-o\"></i></div></div></div>");
                    }else{
                        $('#estadosContablesArchivos').append("<div><div ><div style='display: table;margin: auto;'><a style='display: table-cell;border:none;vertical-align: middle;' target='_blank' href="+host+"/archivocliente/" + value.ruta + " download='"+quitarDni(value)+"' class='pdflogo'></a><a target='_blank' download='"+quitarDni(value)+"' style='display: table-cell;vertical-align: middle;'href='"+host+"/archivocliente/" + value.ruta + "'>" + value.name.substr(0, value.name.lastIndexOf("_")) + "." + value.type + "</a></a></div></div></div>");

                    }
                    break;
                case 2:
                    anadirFila('#facturasRecibidasArchivos table',value);
                    break;
                case 3:
                    anadirFila('#facturasEmitidasArchivos table',value);
                    break;
                case 4:
                    anadirFila('#documentosBancariosArchivos table',value);
                    break;
                case 5:
                    anadirFila('#otrosDocumentosArchivos table',value);
                    break;
                default:
            }

            //

        });






    });
    }

function borrarArchivo(name){

    if(confirm("¿Está seguro que desea borrar?"))
    {
        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            url: host+"/borrar",
            type: 'POST',
            dataType:"json",
            data:{"nombre":name},
            success: function(){
                mostrarArchivos();
                CargaClientes();
            }
        });
    }

}

/*
function mostrarClientes(lapso)
{

    $("#datos").empty();
    var tablaDatos = $("#datos");
    var numero=0;

    $(clientes.slice(lapso-10,lapso)).each(function(key,value){

        if(numero==10)
            return false;
        var clase=value.noProcesados>0?"warning":"";
        tablaDatos.append("<tr class='"+clase+"'><td>"+value.dni+"</td><td>"+value.nombre+"</td><td><button value="+value.id+" OnClick='Mostrar(this);' class='glyphicon glyphicon-pencil' data-toggle='modal' data-target='#myModal'></button><button class='glyphicon glyphicon-trash' value="+value.id+" OnClick='Eliminar(this);'></button><button class='glyphicon glyphicon-folder-open' data-toggle='modal' data-target='#archivos' value="+value.archivos+" OnClick='CargaArchivos(\""+value.dni+"\",\""+value.nombre+"\",\""+value.id+"\");'></button></td><td>"+value.noProcesados+"</td></tr>");
        numero++;
    });


}
*/

function mostrarClientes(){

    var tablaDatos = $("#datos");
    $("#datos").empty();

    if(bclientes=="")
    {
        $(clientes).each(function(key,value){
            var clase=value.noProcesados>0?"pendientes":"";
            tablaDatos.append("<tr class='"+clase+"'><td>"+value.dni+"</td><td>"+value.nombre+"</td><td><button value="+value.id+" OnClick='Mostrar(this);' class='glyphicon glyphicon-pencil' data-toggle='modal' data-target='#myModal'></button><button class='glyphicon glyphicon-trash' value="+value.id+" OnClick='Eliminar(this);'></button><button class='glyphicon glyphicon-folder-open' data-toggle='modal' data-target='#archivos' value="+value.archivos+" OnClick='CargaArchivos(\""+value.dni+"\",\""+value.nombre+"\",\""+value.id+"\");'></button></td><td>"+value.noProcesados+"</td></tr>");
        });

    }else{

        var nuevosClientes=[];

        for (i = 0; i < clientes.length; i++) {
            if(clientes[i].dni.toLowerCase().indexOf(bclientes.toLowerCase())>=0){
                nuevosClientes.push(clientes[i]);
            }
        }

        $(nuevosClientes).each(function(key,value){
            var clase=value.noProcesados>0?"pendientes":"";
            tablaDatos.append("<tr class='"+clase+"'><td>"+value.dni+"</td><td>"+value.nombre+"</td><td><button value="+value.id+" OnClick='Mostrar(this);' class='glyphicon glyphicon-pencil' data-toggle='modal' data-target='#myModal'></button><button class='glyphicon glyphicon-trash' value="+value.id+" OnClick='Eliminar(this);'></button><button class='glyphicon glyphicon-folder-open' data-toggle='modal' data-target='#archivos' value="+value.archivos+" OnClick='CargaArchivos(\""+value.dni+"\",\""+value.nombre+"\",\""+value.id+"\");'></button></td><td>"+value.noProcesados+"</td></tr>");
        });
    }

}

function reiniciarScroll(){
    $('#valorPaginacion').text("1");
    $('#scroll').slider('value',0);

}

function CargaClientes(){


    var route = host+"/clientes";

    $.ajax({
        headers: {'X-CSRF-TOKEN': token},
        url: host+"/clientes",
        type: 'POST',
        dataType:"json"
    }).done(function(res) {
        clientes=res;

        var valores=clientes.length/10;

        mostrarClientes();

        $("#buscar").keyup(function() {

            bclientes = $(this).val();

            mostrarClientes();
        });

    });





        /*
        $('#scroll').slider(
            {

                max:valores,
                slide: function( event, ui ) {
                    var valor = ui.value;
                    $("#valorPaginacion").text(parseInt(valor)+1);
                    mostrarClientes((parseInt(valor)+1)*10);
                },
                orientation:'horizontal'
            }
        );

        reiniciarScroll();
        */

}


function Eliminar(btn){

    if(confirm("¿Está seguro que desea borrar?"))
    {
        var route = host+"/cliente/"+btn.value+"";
        var token = $("#token").val();

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'DELETE',
            dataType: 'json',
            success: function(){
                CargaClientes();

                $("#msj-error").fadeIn();
            }
        });
    }

}


function Mostrar(btn){
    var route =host+"/cliente/"+btn.value+"/edit";
    $.get(route, function(res){
        $("#nombre").val(res.nombre);
        $("#dni").val(res.dni);
        $("#id").val(res.id);


    });
}


function CargaArchivos(dni,nombre,id){

    idAhora=id;


    var modal=$('#archivos').modal({
        show: false


    });

    var dn="<span class='glyphicon glyphicon-list-alt'></span>"+dni;
    var name="<span style='margin-left: 17px;' class='glyphicon glyphicon-user'></span>"+nombre;

    var guarda ="new guarda";

    guarda =  "<p>"+dn+name+"</p>";

    modal.find('.modal-title').html(guarda);
    mostrarArchivos(id);

}


$("#actualizar").click(function(){
    var value = $("#id").val();
    var dato = $("#nombre").val();
    var route = host+"/cliente/"+value+"";
    var token = $("#token").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data: {nombre: dato},
        success: function(){

            CargaClientes();

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




function quitarDni(valor)
{
    return valor.name.substr(0, valor.name.lastIndexOf("_")) + "." + valor.type;
}











