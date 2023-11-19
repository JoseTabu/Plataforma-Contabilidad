var host=$('#host').html();
$( document ).ready(function() {

    carga();
    function carga()
    {

        var route = host+"/gestoria/"+$('#gesto_id').val()+"/edit";

        $.get(route, function(res){
            $("#nombre").val(res.nombre);
            $("#dni").val(res.dni);
            $("#clave").val(res.clave);
            $("#clave_clientes").val(res.clave_clientes);
            $("#id").val(res.id);
        });
    }

    $("#actualizar").click(function(){
        var value = $('#gesto_id').val();
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
                carga();
                $('.datos-contenedor').append($("#msj-success"));
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


});