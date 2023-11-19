@extends('layouts.admin')

@section('content')

	<div class="datos-contenedor">
        <div class="datos editarusuario">
	<!-- Actualizar el usuario -->

    <div>
	@include('alerts.request')
	{!!Form::model($user,['route'=>['usuario.update',$user->id],'method'=>'PUT','class'=>'admin-form'])!!}
		@include('usuario.forms.usr')
            <div>
            <div style="width: 100%;height: 100px;position: relative;">
                <div class="centrartotal">
	{!!Form::submit('Actualizar',['id'=>'actualizaruser','class'=>'btn btn-primary nav-justified'])!!}
	{!!Form::close()!!}

	<!-- Eliminar usuario -->

	{!!Form::open(['route'=>['usuario.destroy',$user->id],'id'=>'borrarform','method'=>'DELETE','class'=>'floatlef admin-form'])!!}
	{!!Form::submit('Eliminar',['id'=>'eliminarusuario','class'=>'btn btn-danger  nav-justified'])!!}
	{!!Form::close()!!}
            </div>
            </div></div>
    </div>

        </div>
    </div>


@section('scripts')
    {!!Html::script('js/script8.js')!!}
@endsection

@stop