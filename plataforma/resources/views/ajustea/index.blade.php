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
                    <div class="panel-heading">Agregar Fondo</div>
                    <div class="panel-body">

                        {!! Form::open(array('url'=>'storage/create','method'=>'POST', 'files'=>true)) !!}

                        <div class="alert alert alert-info alert-dismissable" role="alert" style="">
                            <strong>¡Atento!</strong>Recuerde que la extension del fondo de ser png.
                        </div>

                        <div class="form-group col-md-12 subirArchivos" style="overflow: hidden">
                            <label class=" control-label">Fondo:</label>
                            <div >
                                {!! Form::file('file',array('class' => 'field')) !!}

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



        </div>
    </div>


@endsection