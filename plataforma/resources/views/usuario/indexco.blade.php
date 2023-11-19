@extends('layouts.admin')
@section('content')

    <div class="datos-contenedor">
        <div class="datos">
            @include('alerts.success')
            <table class="table">
                <thead>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Operacion</th>
                </thead>
                @foreach($users as $user)
                    @if($user->rol=="Contable")
                        <tbody>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->rol}}</td>
                        <td>
                            {!!link_to_route('usuario.edit', $title = 'Editar', $parameters = $user->id, $attributes = ['class'=>'btn btn-primary'])!!}
                        </td>
                        </tbody>
                    @endif
                @endforeach
            </table>




            {!! str_replace ('/?', '?', $users-> render ()) !!}
        </div>
    </div>



@stop