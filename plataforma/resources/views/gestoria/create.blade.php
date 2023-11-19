@extends('layouts.admin')
@section('content')
    <div class="datos-contenedor">
    <div class="datos editarusuario">
    {!!Form::open(array('class'=>'admin-form'))!!}
        <div id="msj-success" class="alert alert-success alert-dismissable" role="alert" style="display:none">
            <button type="button" class="close" >&times;</button>
            <strong>¡Gestoria Agregada Correctamente!</strong>
        </div>

        <div id="msj-info" class="alert alert alert-info alert-dismissable" role="alert" style="display:none">
            <button type="button" class="close" >&times;</button>
            <strong>¡Atento!</strong>Asegurese que el Nif o Cif no supere los 9 digitos.
        </div>

        <div id="msj-error" class="alert alert-danger alert-dismissable" role="alert" style="display:none">
            <button type="button" class="close">&times;</button>
            <strong>¡Cuidado!</strong> Es muy importante que el nombre no supere 15 caracteres y los campos no esten vacios.
        </div>


    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
    @include('gestoria.forms.usr')
    <div class="form-group">
    {!!link_to('#', $title='Registrar', $attributes = ['id'=>'registro', 'class'=>'btn btn-primary'], $secure = null)!!}
    </div>
    {!!Form::close()!!}
    </div>
    </div>
@endsection

@section('scripts')
    {!!Html::script('js/script3.js')!!}

@endsection