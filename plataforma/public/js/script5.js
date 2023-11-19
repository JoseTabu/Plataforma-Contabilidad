var host=$('#host').html();
$("#registro").click(function(){

    var dato2 = $("#dni").val();
    var dato = $("#nombre").val();
    var dato3 = $("#gestoria_id").val();
    var route = host+"/cliente";
    var token = $("#token").val();


    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{dni: dato2,nombre: dato,gestoria_id:dato3},
        success:function(){
            $("#msj-success").fadeIn();
            $("#dni").val("");
            $("#nombre").val("");
        },
        error:function(data){
            $("#msj-error").fadeIn();
            $("#msj-info").fadeIn();

        }
    });



});

$('.close').click(function(event){
    $(this.parentNode).fadeOut();
});
