@extends('layouts.admin')
@section('content')
    <div class="datos-contenedor">
        <div class="datos">
    {!!Form::open(array('class'=>'admin-form'))!!}



            <div id="msj-success" class="alert alert-success alert alert-dismissable" role="alert" style="display:none">
                <button onclick="location.reload()" type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>¡Cliente Agregado Correctamente!</strong>
            </div>


            <div id="msj-info" class="alert alert alert-info alert-dismissable" role="alert" style="display:none">
                <button type="button" class="close" >&times;</button>
                <strong>¡Atento!</strong>Asegurese que el Nif o Cif no supere los 9 digitos.
            </div>

            <div id="msj-error" class="alert alert-danger alert-dismissable" role="alert" style="display:none">
                <button type="button" class="close">&times;</button>
                <strong>¡Cuidado!</strong> Es muy importante que  los campos no esten vacios.
            </div>

    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
            <div class="form-group">

                <div class="alert alert alert-info alert-dismissable" role="alert" style="">
                    <button type="button" class="close" >&times;</button>
                    <strong>¡Atento!</strong>Una vez registrado el Nif o Cif no se podra modificar.
                </div>

                {!!Form::label('dni','Nif/Cif: ')!!}
                {!!Form::text('dni',null, ['id'=>'dni','class'=>'form-control', 'placeholder' => 'Ingresa el Nif o Cif del cliente'])!!}
            </div>
            <div class="form-group">
                {!!Form::label('nombre','Cliente: ')!!}
                {!!Form::text('nombre',null, ['id'=>'nombre','class'=>'form-control', 'placeholder' => 'Ingresa el nombre del cliente'])!!}

            </div>

            <div class="form-group">
    {!!link_to('#', $title='Registrar', $attributes = ['id'=>'registro', 'class'=>'btn btn-primary'], $secure = null)!!}
    </div>
    {!!Form::close()!!}
        </div>
    </div>
@endsection


@section('scripts')
    {!!Html::script('js/script5.js')!!}
@endsection
