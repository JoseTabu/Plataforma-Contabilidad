<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Expires" content="0" />
    <meta http-equiv="Pragma" content="no-cache" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="images/icon.ico" />



    <title>PLATAFORMA CONTAVIA</title>

    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom Theme files -->
    {{--<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />--}}
    {{--<link href="css/estilo.css" rel="stylesheet" type="text/css" media="all" />--}}
    <!-- Custom Theme files -->
    <script src="js/jquery.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/estilos.css')!!}
    {!!Html::style('css/style.css')!!}
    {!!Html::script('js/jquery.min.js')!!}



    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Cinema Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!--webfont-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
<span hidden="hidden" id="host">{!!URL::to('/')!!}</span>



@yield('content')



</body>
</html>