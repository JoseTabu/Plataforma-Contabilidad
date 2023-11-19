var host=$('#host').html();
$("#registro").click(function(){
    var dato2 = $("#clave").val();
    var dato4 = $("#clave_clientes").val();
    var dato = $("#nombre").val();
    var dato3 = $("#dni").val();
    var route = host+"/gestoria";
    var token = $("#token").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{clave_clientes:dato4,clave: dato2,nombre: dato,dni:dato3},
        success:function(){
            $("#msj-success").fadeIn();
            setTimeout(location.reload(),2000);
        },
        error:function(){

            $("#msj-error").fadeIn();
            $("#msj-info").fadeIn();

        }
    });
});



$('.close').click(function(event){
    $(this.parentNode).fadeOut();
});





