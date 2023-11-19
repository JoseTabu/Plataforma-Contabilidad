@if(Session::has('message-credere'))

 <div class="alert alert-danger alert-dismissable">

  {{Session::get('message-credere')}} <!-- Session nos permite mostrar la informacion del usuario -->

 </div>
@endif