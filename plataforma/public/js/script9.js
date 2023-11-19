var host=$('#host').html();

$(document).ready(function(){
    mostrarArchivos();

});


var pestanaActiva=false;

var token=$('#token').val();
var route = host+"/archivos";




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
            }
        },
        error: function(file)
        {
            //Refresca la pagina
            location.reload();
        }};
};


function getMisDatos(){
    $.ajax({
        headers: {'X-CSRF-TOKEN': token},
        url: host+"/clientes",
        type: 'POST',
        dataType:"json"
    }).done(function(data) {

        var modal=$('#archivos').modal();


        var dn="<span class='glyphicon glyphicon-list-alt'></span>"+data.dni;
        var name="<span style='margin-left: 17px;' class='glyphicon glyphicon-user'></span>"+data.nombre;

        var guarda;

        guarda =  "<p>"+dn+name+"</p>";

        modal.find('.modal-title').html(guarda);

        modal.find(".modal-backdrop").remove();

    });
}



function mostrarArchivos(){

var guardar="";


$.ajax({
    headers: {'X-CSRF-TOKEN': token},
    url: host+"/archivos",
    type: 'POST',
    dataType:"json"
}).done(function(data) {


    $('.datos-contenedor').addClass("scroll-vertical");

    var modal=$('#archivos').modal();

    modal.addClass("paraClientes");



    var booleano=true;



//Vacia el modal
    modal.find('.cerrar').remove();
    modal.find('.modal-body #contenido').html("");



//Crea la tabla


    titulos = "<thead><tr><th>Archivo</th><th>Fecha</th><th>Usuario</th><th>Estado</th><th>Borrar</th></tr></thead>";
    tabla = "<table class='table tablaArchivo '>" + titulos + "</table>";


//Ponemos todos los apartados

    var estadosContables = "<h3>ESTADOS CONTABLES</h3><div id='estadosContablesArchivos'></div>";


    var facturasRecibidas = "<h3 data-grupo='0' class='pestana'>FACTURAS RECIBIDAS</h3><div><div id='facturasRecibidasArchivos'>" + tabla + "</div><div class='dropzone' id='facturasRecibidas'></div></div>";
    var facturasEmitidas = "<h3 data-grupo='1' class='pestana'>FACTURAS EMITIDAS</h3><div><div id='facturasEmitidasArchivos'>" + tabla + "</div><div class='dropzone' id='facturasEmitidas'></div></div>";
    var documentosBancarios = "<h3 data-grupo='2' class='pestana'>DOCUMENTOS BANCARIOS</h3><div><div id='documentosBancariosArchivos'>" + tabla + "</div><div class='dropzone' id='documentosBancarios'></div></div>";
    var otrosDocumentos = "<h3 data-grupo='3' class='pestana'>OTROS DOCUMENTOS</h3><div><div id='otrosDocumentosArchivos'>" + tabla + "</div><div class='dropzone' id='otrosDocumentos'></div></div>";

    var guardar = estadosContables + "<div id='accordeon'>" + facturasRecibidas + facturasEmitidas + documentosBancarios + otrosDocumentos + "</div>";


//Pone los elementos estaticos
    modal.find('.modal-body #contenido').html(guardar);

//Hacer un accordeon
    $("#accordeon").accordion({active: false, collapsible: true, heightStyle: "content"});


    $( "#accordeon" ).accordion({
        active: parseInt(pestanaActiva),
        collapsible: true,heightStyle: "content"});

    $('.pestana').click(function(event){

        var grupo=$(this).attr('data-grupo');
        pestanaActiva=grupo;



    });


//Congfiguracion dropzone
    var opcionesEstado = opcionesDropzone();


    opcionesEstado['acceptedFiles'] = "application/pdf";
    opcionesEstado['sending'] = function (file, xhr, formData) {


        if (booleano) {

            formData.append("grupo_id", 1);
        }
        else {
            alert("El nombre no es correcto");
            return false;
        }


    };


    var opcionesFacturasRecibidas = opcionesDropzone();
    opcionesFacturasRecibidas['sending'] = function (file, xhr, formData) {

        formData.append("grupo_id", 2);
    };


    var opcionesFacturasEmitidas = opcionesDropzone();
    opcionesFacturasEmitidas['sending'] = function (file, xhr, formData) {
        formData.append("grupo_id", 3);
    };


    var opcionesDocumentosBancarios = opcionesDropzone();
    opcionesDocumentosBancarios['sending'] = function (file, xhr, formData) {
        formData.append("grupo_id", 4);
    };

    var opcionesotrosDocumentos = opcionesDropzone();
    opcionesotrosDocumentos['sending'] = function (file, xhr, formData) {
        formData.append("grupo_id", 5);
    };


    $("#estadosContables").dropzone(opcionesEstado);
    $("#facturasRecibidas").dropzone(opcionesFacturasRecibidas);
    $("#facturasEmitidas").dropzone(opcionesFacturasEmitidas);
    $("#documentosBancarios").dropzone(opcionesDocumentosBancarios);
    $("#otrosDocumentos").dropzone(opcionesotrosDocumentos);


    function anadirFila(selector, value) {

        icono=value.procesado==0?"<i class=\"fa fa-ban\"></i>PENDIENTE":"<i class=\"fa fa-thumbs-o-up\">CONTABILIZADO</i>";
        fila ="<tr><td><a target='_blank' download='"+value.name.substr(0,value.name.lastIndexOf("_"))+"' href='"+host+"/archivocliente/"+value.ruta+"'>"+value.name.substr(0,value.name.lastIndexOf("_"))+"."+value.type+"</a></td><td>"+value.created_at+"</td><td>"+value.usuario_id+"</td><td>"+icono+"</td><td><i onclick='borrarArchivo(\""+value.name+"\")' class=\"fa fa-trash-o\"></i></td></tr>";
        $(selector).append(fila);


    }


//ordenar por propiedad

    var keysSorted = Object.keys(data).sort(function (a, b) {
        return data[a].procesado - data[b].procesado
    });
    var nuevoDato = [];

    for (id in keysSorted) {
        nuevoDato.push(data[keysSorted[id]]);
    }


//Cargar archvios

    $(nuevoDato).each(function (key, value) {

        switch (value.grupo_id) {
            case 1:
                $('#estadosContablesArchivos').append("<div><div ><div style='display: table;margin: auto;'><a download='"+quitarDni(value)+"' style='border:none!important;display: table-cell;vertical-align: middle;' href='"+host+"/archivocliente/" + value.name + "' target='_blank' class='pdflogo'></a><a download='"+quitarDni(value)+"' target='_blank' style='display: table-cell;vertical-align: middle' href='"+host+"/archivocliente/" + value.name + "'>" + value.name.substr(0, value.name.lastIndexOf("_")) + "." + value.type + "</a></a></div></div></div>");
                break;
            case 2:
                anadirFila('#facturasRecibidasArchivos table', value);
                break;
            case 3:
                anadirFila('#facturasEmitidasArchivos table', value);
                break;
            case 4:
                anadirFila('#documentosBancariosArchivos table', value);
                break;
            case 5:
                anadirFila('#otrosDocumentosArchivos table', value);
                break;
            default:
        }

        //

    });

    getMisDatos();


}).fail(function(){

});

}



function quitarDni(valor)
{
    return valor.name.substr(0, valor.name.lastIndexOf("_")) + "." + valor.type;
}


function borrarArchivo(name) {

    if (confirm("¿Está seguro que desea borrar?")) {
        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            url: host + "/borrar",
            type: 'POST',
            dataType: "json",
            data: {"nombre": name},
            success: function () {
                mostrarArchivos();
                CargaClientes();
            }
        });
    }

}