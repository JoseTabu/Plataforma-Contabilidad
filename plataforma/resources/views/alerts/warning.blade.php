@if(Session::has('message-warning'))

 <div class="alert alert-warning alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>


  {{Session::get('message-warning')}} <!-- Session nos permite mostrar la informacion del usuario -->

 </div>
@endif