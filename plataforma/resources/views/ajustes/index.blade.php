
@extends('layouts.admin')

@section('content')

    @include('style.style')

    <div class="datos-contenedor">
    <div class="datos scrollable">

        @include('alerts.errors')
        @include('alerts.request')
        @include('alerts.success')
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Agregar Logo</div>
                    <div class="panel-body">

                    {!! Form::open(array('url'=>'subirLogo','method'=>'POST', 'files'=>true)) !!}

                        <div class="alert alert alert-info alert-dismissable" role="alert" style="">
                            <strong>¡Atento!</strong>Recuerde que la extension del logo de ser png.
                        </div>

                        <div class="form-group col-md-12 subirArchivos" style="overflow: hidden">
                            <label class=" control-label">Logo:</label>
                            <div >
                                {!! Form::file('image',array('class' => 'field')) !!}

                            </div>
                        </div>



                            <div class=" col-md-12">
                            {!! Form::submit('Subir Imagen', array('class'=>'btn btn-primary')) !!}

                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Ajustes Gestoria</div>
                    <div class="panel-body">

                        <input id="gesto_id" hidden="hidden" value='{!!Auth::user()->gestoria_id!!}'/>

                        {!!Form::open(array('class'=>'admin-form'))!!}


                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                        <div class="form-group">
                            {!!Form::label('nombre','Nombre: ')!!}
                            {!!Form::text('nombre',null, ['id'=>'nombre','class'=>'form-control', 'placeholder' => 'Ingresa el nombre de la gestoria'])!!}
                        </div>
                        <div class="claves">
                            <div class="form-group">

                                <div class="form-group" hidden="hidden">
                                    {!!Form::label('dni','Nif/Cif: ')!!}
                                    {!!Form::text('dni',null, ['id'=>'dni','class'=>'form-control', 'placeholder' => 'Ingresa el Nif o Cif de la gestoria'])!!}
                                </div>
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

                        <div class="form-group">
                            {!!link_to('#', $title='Actualizar', $attributes = ['id'=>'actualizar', 'class'=>'btn btn-primary'], $secure = null)!!}
                        </div>
                        {!!Form::close()!!}



                    </div>
            </div>
        </div>

    </div>


        </div>

        </div>


@endsection

@section('scripts')
            {!!Html::script('js/script10.js')!!}
@endsection
