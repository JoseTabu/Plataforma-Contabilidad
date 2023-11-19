
@extends('layouts.admin')

@section('content')
    @include('style.style')
    @include('cliente.modal')

    <div class="datos-contenedor">
        <div class="datos">

            @include('alerts.errors')
            @include('alerts.request')
            @include('alerts.success')
            @include('alerts.warning')

            <div id="msj-success" class="alert alert-success alert alert-dismissable" role="alert" style="display:none">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>¡Cliente Actualizado!</strong>
            </div>


        <div id="msj-error" class="alert alert-success alert-dismissable" role="alert" style="display:none">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>¡Cliente Borrado!</strong>
        </div>

    <div class="modal fade bs-example-modal-lg" id="archivos" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">

                    <div id="contenido">

                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>


            @if(Auth::user()->rol_id !=3)
                <div class="busquedac">
                    Buscar: <input id="buscar" type="text"/>
                </div>

            <table class="table tableClientes">
                <thead>
                <th>CIF/NIF</th>
                <th>Nombre</th>
                <th>Acciones</th>
                <th>No procesados</th>
                </thead>
                <tbody id="datos"></tbody>
            </table>
                <!--
                <div class='paginacion'></div>
                -->
            @endif
        </div>
    </div>





@endsection

@section('scripts')
    <script type="text/javascript" src="dropzone/downloads/dropzone.js"></script>

    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


    @if(Auth::user()->rol_id ==3)
        {!!Html::script('js/script9.js')!!}
    @else
        {!!Html::script('js/script6.js')!!}
    @endif
@endsection
