@extends('layouts.principal')
@section('content')

    <div class="header">


        <div class="login-panel centrartotal tabla-disposicion">
            <div class="carta centrarvertical">
                <h1 class="text-center">GENERAR CONTRASEÑA</h1>

                @include('alerts.errors')
                @include('alerts.request')
                @include('alerts.success')

                <div class="form-group text-center">
                    {!!Form::open(['url' =>'/password/reset'])!!}

                    {!!Form::hidden('token',$token,null)!!}

                    <div class="form-group text-center">
                        {!!Form::label('Introduce tu email:')!!}
                        {!!Form::text('email',null,['value' => "{{old('email')}}"])!!}
                    </div>

                    <div class="form-group text-center">
                        {!!Form::label('Nueva Constraseña:')!!}
                        {!!Form::password('password')!!}
                    </div>

                    <div class="form-group text-center">
                        {!!Form::label('Confirmar Contraseña:')!!}
                        {!!Form::password('password_confirmation')!!}
                    </div>
                </div>

                <div class="form-group text-center login">
                    {!!Form::submit('Restablecer',['class'=>'btn btn-primary'])!!}
                </div>
                {!!Form::close()!!}

            </div>
            <div class="fuera">

                {!!link_to('/', $title = 'Acceder a contavia', $attributes = null, $secure = null)!!}

            </div>
        </div>

    </div>

@stop