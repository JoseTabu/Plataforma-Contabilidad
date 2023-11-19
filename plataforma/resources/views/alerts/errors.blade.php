@if(Session::has('message-error'))

    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>


        {{Session::get('message-error')}} <!-- Session nos permite mostrar la informacion del usuario -->

    </div>
@endif