
@extends('layouts.admin')

@section('content')

    @include('style.style')

    <div class="datos-contenedor">
        <div class="datos scrollable">

            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
            <div class="asignar">

            </div>



        </div>
    </div>




@endsection

@section('scripts')
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    {!!Html::script('js/script11.js')!!}
@endsection
