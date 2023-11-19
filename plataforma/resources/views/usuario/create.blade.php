@extends('layouts.admin')
@section('content')

    <div class="datos-contenedor">
        <div class="datos">
            @include('alerts.errors')
            @include('alerts.request')
    {!!Form::open(['route'=>'usuario.store','method'=>'POST','class'=>'admin-form'])!!}
            <div class="form-group">
                {!!Form::label('Nombre:')!!}
                {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingresa el nombre del usuario'])!!}
            </div>
            <div class="form-group">
                {!!Form::label('Email:')!!}
                {!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Ingresa el email del usuario'])!!}

            </div>
            <div class="form-group">
                {!!Form::label('Contraseña:')!!}
                {!!Form::password('password',['class'=>'form-control','placeholder'=>'Ingresa la contraseña del usuario'])!!}
            </div>

            <div class="form-group" id="rol-label">
                {!!Form::label('Rol:')!!}
                {!!Form::select('rol_id',$rol,null,['class'=>'form-control registro'])
                !!}

            </div>

            <div class="form-group"  id="dni-label">
                {!!Form::label('Cif/Nif:')!!}
                {!!Form::text('dni',null,['class'=>'form-control','placeholder'=>'Ingresa el Nif o Cif del usuario'])!!}
            </div>

            <div class="form-group"  id="gestoria-label">
                {!!Form::label('Gestoria:')!!}
                {!!Form::select('gestoria_id', $gestoria,null,['class'=>'form-control'])!!}

            </div>
    {!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
    {!!Form::close()!!}
    </div>
    </div>

@section('scripts')
    {!!Html::script('js/script7.js')!!}
@endsection
@stop

