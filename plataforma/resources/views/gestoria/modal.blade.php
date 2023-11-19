<div class="modal fade"  id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div id="mgesto" class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Actualizar Gestoria</h4>
      </div>
      <div class="modal-body">

          <div id="msj-error" class="alert alert-danger alert-dismissable" role="alert" style="display:none">
              <button type="button" class="close">&times;</button>
              <strong>¡Cuidado!</strong> Es muy importante que el nombre no supere 15 caracteres y los campos no esten vacios.
          </div>

          <div id="msj-info" class="alert alert alert-info alert-dismissable" role="alert" style="display:none">
              <button type="button" class="close" >&times;</button>
              <strong>¡Atento!</strong>Asegurese que el Nif o Cif no supere los 9 digitos.
          </div>



        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <input type="hidden" id="id">
          <div class="admin-form">
        @include('gestoria.forms.usr')
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          &nbsp;
        {!!link_to('#', $title='Actualizar', $attributes = ['id'=>'actualizar', 'class'=>'btn btn-primary'], $secure = null)!!}
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@section('scripts')

    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    {!!Html::script('js/script4.js')!!}
@endsection