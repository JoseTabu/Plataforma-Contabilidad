var host=$('#host').html();
$(document).ready(function() {

    $('#eliminarusuario').click(function(e){


        e.preventDefault();

        if(confirm("¿Está seguro que desea borrar?")) {
            $('#borrarform').submit();

            return true;
        }else{
            return false;
        }


    });


    $.ajax({
        url: host+"/panel",
        headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            $('#panel').html(data);

        },
        fail:function(data){

        }
    });

});








