@extends('layouts.admin')
@section('content')

    <div class="datos-contenedor scrollable">
        <div class="datos">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
    <div class="acordeon">
        <?php $index=0 ?>
    @foreach($users as $user)

           <h3 referencia="{{$index}}"> {{$user->email}}</h3>
            <div id="usuario{{$index}}" class="acciones">
                <div class="acordeonCliente" id="acordeoncliente{{$index++}}">

                </div>
            </div>

    @endforeach
    </div>
    </div>
    </div>
@stop
@endsection

@section('scripts')
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    {!!Html::script('js/script12.js')!!}
@endsection
