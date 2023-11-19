var gestoria_id=$('#gestoria-label').html();
var dni_id=$('#dni-label').html();
var host=$('#host').html();

$( document ).ready(function() {

    asignarTexto();

   $('#rol-label select').change(function(){
        asignarTexto();
   });

});


function asignarTexto()
{
    var rol=$('#rol-label select').val();



    if(rol=="1" )
    {
        $('#gestoria-label').empty();
        $('#dni-label').empty();
    }
    else if(rol=="2")
    {
        $('#dni-label').empty();

        $('#gestoria-label').html(gestoria_id);
    }else if(rol=="4"){

        $('#gestoria-label').empty();
        $('#dni-label').empty();



    }
    else if(rol=="3")
    {

        if($('#rol-label select').hasClass('registro'))
        {
            $('#gestoria-label').empty();
        }
        else{
            $('#gestoria-label').html(gestoria_id);
        }
        $('#dni-label').html(dni_id);
    }


}
