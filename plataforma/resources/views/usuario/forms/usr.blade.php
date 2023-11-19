<div class="form-group">
    {!!Form::label('Nombre:')!!}
    {!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa el nombre del usuario'])!!}
</div>
<div class="form-group">
    {!!Form::label('Contraseña:')!!}
    {!!Form::password('contraseña',['class'=>'form-control','placeholder'=>'Ingresa la contraseña del usuario'])!!}
</div>

<div class="form-group" id="rol-label">
    {!!Form::label('Rol:')!!}
    {!!Form::select('rol_id',$rol,null,['class'=>'form-control registro'])
    !!}
</div>
<div class="form-group" id="dni-label">
    {!!Form::label('Cif/Nif:')!!}
    {!!Form::text('dni',null,['class'=>'form-control','placeholder'=>'Ingresa el Cif o Nif del usuario'])!!}
</div>

<div class="form-group" id="gestoria-label">
    {!!Form::label('Gestoria:')!!}
    {!!Form::select('gestoria_id', $gestoria,null,['class'=>'form-control'])
    !!}

</div>

@section('scripts')
    {!!Html::script('js/script7.js')!!}
@endsection