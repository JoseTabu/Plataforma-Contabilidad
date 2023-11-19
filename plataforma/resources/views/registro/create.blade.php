@extends('layouts.principal')

@section('content')

    <div class="header">



        <div class="login-panel centrartotal tabla-disposicion">
            <div class="carta centrarvertical">

            <h1 class="text-center">REGISTRO</h1>
                @include('alerts.errors')
                @include('alerts.requestregistro')
                @include('alerts.crederegistro')
                @include('alerts.registro')



            {!!Form::open(['route'=>'registro.store','method'=>'POST','id'=>'registrar'])!!}

            <div class="form-group"  id="rol-label">
                {!!Form::label('Tipo:')!!}
                {!!Form::select('rol_id', $roles,null,['class'=>'form-control'])
                !!}

            </div>

            <div class="form-group text-center">

                {!!Form::label('Nombre:')!!}
                {!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa el nombre y apellidos '])!!}
            </div>
            <div class="form-group text-center">
                {!!Form::label('Email:')!!}
                {!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Ingresa el email'])!!}
            </div>
            <div class="form-group text-center">
                {!!Form::label('Contraseña:')!!}
                {!!Form::password('contraseña',['class'=>'form-control','placeholder'=>'Ingresa la contraseña'])!!}
            </div>

            <div class="form-group text-center" id="gestoria-label">
                {!!Form::label('Codigo Verificacion:')!!}
                {!!Form::text('clave',null,['class'=>'form-control','id'=>'clave','placeholder'=>'Ingresa el codigo facilitado'])!!}
            </div>

            <div class="form-group text-center"  id="dni-label">
                {!!Form::label('Cif/Nif:')!!}
                {!!Form::text('dni',null,['class'=>'form-control','placeholder'=>'Ingresa el Cif o Nif del usuario'])!!}
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

            <div class="form-group text-center login">
                {!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
            </div>

            {!!Form::close()!!}

        </div>
            <div class="fuera">

                {!!link_to('/', $title = 'Acceder Contavia', $attributes = null, $secure = null)!!}

            </div>
            </div>

    </div>
    {!!Html::script('js/script7.js')!!}

@stop