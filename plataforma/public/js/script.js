//AJAX = Asynchronous Javascript and XML, lo que como su nombre dice nos permite
//realizar acciones asíncronas creando una mejor experiencia al usuario
//dandole la oportunidad de realizar múltiples tareas sin la necesidad que espere a que termine una de ellas
var host=$('#host').html();
var estado=true;

$( document ).ready(function() {

    $('#desplegar').click(function(){
        if(estado)
        {
            estado=false;

            $('#page-wrapper').removeClass('recoge');
            $('#page-wrapper').addClass('saca');
            $('.sidebar').css('width','250px');
            $('div.navbar-collapse').removeClass('collapse');
        }else{
            estado=true;
            $('div.navbar-collapse').addClass('collapse');
            $('#page-wrapper').removeClass('saca');
            $('#page-wrapper').addClass('recoge');
        }
    });


    var token = $("#token").val();


        $("#generar").click(function () {

            $("#clave").val(generarClave("G"));
            $("#clave_clientes").val(generarClave("C"));


        });

    function generarClave(letra) {


        var d = new Date();
        var dia= d.getDate().toString();

        var mes= (d.getMonth()+1).toString();

        if(mes.length==1)
            mes="0".concat(mes);

        if(dia.length==1)
            dia="0".concat(dia);

        var palabra;

        wordgen(8);

        var todo=mes.concat(letra+palabra,dia);
        //existeClave(todo);

        return todo;

        function wordgen(length){
            var i = 0;
            var word = "";
            var vowels = new Array("a","e","u","i","o");
            var consonants = new Array("q","w","r","t","p","s","d","f","g","h","j","k","l","z","x","c","v","b","n","m");

            while(i < (length/2)){
                i++;
                word += vowels[Math.floor(Math.random() * vowels.length)] + consonants[Math.floor(Math.random() * consonants.length)];
            }
            palabra=word;
        }


    }


    function existeClave(clave){

        var url=host+"/gestoria/existeClave";

        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            dataType: 'json',
            data:{clave:clave},
            success:function(){
                alert("ok");
            },
            error:function(){
                alert("error");
            }
        });

    }


});