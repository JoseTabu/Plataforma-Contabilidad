@extends('layouts.admin')

@section('content')


 <div class="datos-contenedor">
  <div class="datos scrollable">

   @include('alerts.errors')
   @include('alerts.request')
   @include('alerts.success')


   <div class="row">
    <div class="col-md-10 col-md-offset-1">
     <div class="panel panel-default">
      <div class="panel-body">

       {!!Form::open(['url'=>'cambiarpass','method'=>'POST'])!!}

       <div class="form-group">
       {!!Form::label('Contraseña Actual: ')!!}
       {!!Form::password('Contraseña_Actual',['class'=>'form-control','placeholder' => 'Ingresa la contraseña actual'])!!}
      </div>
      <div class="form-group">
       {!!Form::label('Nueva Contraseña: ')!!}
       {!!Form::password('Nueva_Contraseña',['class'=>'form-control', 'placeholder' => 'Ingresa la nueva contraseña'])!!}
      </div>
      <div class="form-group">
       {!!Form::label('Repite la contraseña: ')!!}
       {!!Form::password('Repetir_Contraseña',['class'=>'form-control', 'placeholder' => 'Repita la contraseña'])!!}
      </div>

       <div class=" col-md-12">
        {!!Form::submit('Cambiar Contraseña',array('class'=>'btn btn-primary'))!!}

       </div>
      {!!Form::close()!!}
      </div>
     </div>


 </div>

 </div>

 </div>


 </div>

 </div>

 </div>

@endsection


