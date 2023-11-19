<div class="form-group">
    {!!Form::label('nombre','Nombre: ')!!}
    {!!Form::text('nombre',null, ['id'=>'nombre','class'=>'form-control', 'placeholder' => 'Ingresa el nombre de la gestoria'])!!}
</div>
<div class="form-group">
    {!!Form::label('dni','Nif/Cif: ')!!}
        {!!Form::text('dni',null, ['id'=>'dni','class'=>'form-control', 'placeholder' => 'Ingresa el Nif o Cif de la gestoria'])!!}
</div>
<div class="claves">
    <div class="form-group">
    <p>
    {!!Form::label('clave','Clave Gestoria: ')!!}
    </p>
    <p>
    {!!Form::text('clave',null, ['id'=>'clave','class'=>'form-control','disabled'=>'disabled', 'placeholder' => 'Genera la clave de la gestoria'])!!}
    </p>
    <p>
        {!!Form::label('clave_clientes','Clave Clientes: ')!!}
    </p>
    <p>
        {!!Form::text('clave_clientes',null, ['id'=>'clave_clientes','class'=>'form-control','disabled'=>'disabled', 'placeholder' => 'Genera la clave del cliente'])!!}

    </p>
    </div>
        {!!link_to('#generar', $title='Generar', $attributes = ['id'=>'generar', 'class'=>'btn btn-success'], $secure = null)!!}


</div>

