@if(Session::has('message-re'))

 <div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

  {{Session::get('message-re')}} <!-- Session nos permite mostrar la informacion del usuario -->

 </div>
@endif