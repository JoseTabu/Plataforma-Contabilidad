
@extends('layouts.principal')
@include('style.style')
@section('content')
    <div class="container glyphicon-align-center">
        <div class="row text-center">
            <div class="col-md-2"></div>
            <div class="col-md-8">

                <div class="panel panel-primary">
                    <div class="panel-heading">

                        <h4 class="panel-title text-center">Arrastra los archivos</h4>
                    </div>

                    {!!Form::open(array(
                    'url'=>'verificacion',
                    'files'=>true,
                    'class'=>'dropzone',
                    'id'=>'my-dropzone',
                    'method'=>'post',
                    ))!!}



                    {!!Form::close()!!}
                </div>
            </div>



            <script type="text/javascript" >
                Dropzone.options.myDropzone={

                    autoProcessQueue:true,
                    addRemoveLinks: true,
                    maxFileSize: 1000,
                    dictResponseError: "Ha ocurrido un error en el servidor.",
                    acceptedFiles: 'image/*,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF,.rar,application/pdf,.psd'


                }
            </script>
            <div class="col-md-12"></div>
        </div>
    </div>
@endsection



