@if(Session::has('message-crede'))

 <div class="alert alert-danger alert-dismissable">

  {{Session::get('message-crede')}} <!-- Session nos permite mostrar la informacion del usuario -->

 </div>
@endif