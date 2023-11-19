@extends('layouts.principal')
@section('content')

    <div class="header">



        <div class="login-panel centrartotal tabla-disposicion">
            <div class="carta centrarvertical">
                <h1 class="text-center">RECUPERAR CONTRASEÑA</h1>
                @include('alerts.request')
                @include('alerts.errors')
                @include('alerts.success')

                {!!Form::open(['url' =>'/password/email'])!!}
                <div class="form-group text-center">
                    {!!Form::label('Email:')!!}
                    {!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Ingresa el email'])!!}
                </div>
                <div class="form-group text-center login">
                    {!!Form::submit('Enviar Contraseña',['class'=>'btn btn-primary'])!!}
                </div>
                {!!Form::close()!!}

            </div>
            <div class="fuera">

                {!!link_to('/', $title = 'Acceder contavia', $attributes = null, $secure = null)!!}

            </div>
        </div>

    </div>

@stop