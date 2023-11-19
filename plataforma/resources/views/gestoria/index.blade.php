@extends('layouts.admin')

@section('content')
@include('gestoria.modal')

<div class="admin-form">


    <div class="datos-contenedor scrollable">
        <div class="datos" id="datos">

            @include('alerts.errors')
            @include('alerts.request')
            @include('alerts.success')
            @include('alerts.warning')

            <div id="msj-success" class="alert mensajeGestoria alert-success alert-dismissable" role="alert" style="display:none">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>¡Gestoria Actualizada Correctamente!</strong>
            </div>


            <div id="msj-error" class="alert mensajeGestoria alert-success alert-dismissable" role="alert" style="display:none">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>¡Gestoria Borrada Correctamente!</strong>
            </div>

            <div id="interfaz" class=" tabla-disposicion">

                <div class="busqueda">
                    Buscar: <input id="buscar" type="text"/>
                </div>

            </div>


        </div>
    </div>
    </div>

@endsection

@section('scripts')

    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    {!!Html::script('js/script4.js')!!}
@endsection