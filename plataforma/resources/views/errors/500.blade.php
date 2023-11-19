<!DOCTYPE html>
<html>
<head>
    <title>Error</title>

    <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 72px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">Hay un problema con la página que está intentando abrir y no se puede mostrar.</div>

    </div>
    <div class="registrarse">

        {!!link_to('/', $title = 'Regresar a la pagina de inicio', $attributes = null, $secure = null)!!}

    </div>

</div>
</body>
</html>
