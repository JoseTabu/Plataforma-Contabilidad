@extends('layouts.principal')

@section('content')

<div class="header">


    @include('alerts.success')


    <div class="login-panel centrartotal tabla-disposicion">


        <div class="carta centrarvertical">


				<h1 class="sombreado"><img class="logotipo" src="images/logotipo.png"></h1>

				{!!Form::open(['route'=>'login.store', 'method'=>'POST'])!!}
					<div class="form-group text-center">
                        @include('alerts.resquestlogin')
						{!!Form::label('correo','Correo:')!!}	
						{!!Form::email('email',null,['class'=>'form-control', 'placeholder'=>'Ingresa tu correo'])!!}
					</div>
					<div class="form-group text-center">
						{!!Form::label('contrasena','Contraseña:')!!}	
						{!!Form::password('contraseña',['class'=>'form-control', 'placeholder'=>'Ingresa tu contraseña'])!!}
					</div>
					<div class="text-center login">
					{!!Form::submit('Iniciar Sesion',['class'=>'btn btn-primary'])!!}

					</div>
                    <div class="text-center login">

                        @include('alerts.credenciales')
                    </div>

				{!!Form::close()!!}



            </div>

        <div class="fuera">
            <a href="{!!URL::to('/registro')!!}">Crear Cuenta</a>

        </div>

        <div class="fuera">

            {!!link_to('password', $title = '¿Olvidaste tu contraseña?', $attributes = null, $secure = null)!!}

        </div>

    </div>



            </div>

@stop