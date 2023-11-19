<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Expires" content="0" />
    <meta http-equiv="Pragma" content="no-cache" />
    <link rel="shortcut icon" type="image/x-icon" href="images/icon.ico" />



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    {!!Html::script('js/script.js')!!}

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Panel de Usuario</title>

    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/metisMenu.min.css')!!}
    {!!Html::style('css/sb-admin-2.css')!!}
    {!!Html::style('css/font-awesome.min.css')!!}
    {!!Html::style('css/estilos.css')!!}


</head>

<body>

<span hidden="hidden" id="host">{!!URL::to('/')!!}</span>

<div id="wrapper">

        
        <nav class="navbar navbar-default navbar-static-top " role="navigation" style="margin-bottom: 0">

            <div class="navbar-header">
                <div class="toolbar hidden-lg hidden-md hidden-sm">
                    <i id="desplegar" class="centrartotal fa fa-bars "></i>
                </div>


                @if(Auth::user()->rol_id !=1)
                    <div class="logo-c">
                        <a id="panel" href="{!!URL::to('/cliente')!!}"></a>
                    </div>
                @endif
                @if(Auth::user()->rol_id ==1)
                    <div class="logo-c"><a class="" href="{!!URL::to('/gestoria')!!}">{!!Html::image('images/logo1.png')!!}</a></div>
                @elseif(Auth::user()->rol_id ==4)
                    <div class="logo-c"><a class="" href="{!!URL::to('/gestoria')!!}">{!!Html::image('images/logo1.png')!!}</a></div>
                @endif
            </div>

            <ul class="nav navbar-top-links navbar-right ">
                 <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    {!!Auth::user()->name!!}<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-user">
                        @if(Auth::user()->rol_id ==1)
                        <li><a href="{!!URL::to('/ajustea')!!}"><i class="fa fa-gear fa-fw"></i> Ajustes</a></li>
                        @endif
                            @if(Auth::user()->rol_id ==2)
                                <li><a href="{!!URL::to('/ajustes')!!}"><i class="fa fa-gear fa-fw"></i> Ajustes</a></li>
                            @endif

                            <li class="divider"></li>
                            <li><a href="{!!URL::to('/cambiar')!!}"><i class="fa fa-recycle"></i> Cambiar Contraseña</a>
                            </li>

                        <li class="divider"></li>
                        <li><a href="{!!URL::to('/logout')!!}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>

            </nav>

            @if(Auth::user()->rol_id ==3)
                <div class="navbar-default sidebar hidden " role="navigation">
            @else
            <div class="navbar-default sidebar " role="navigation">
                @endif
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        @if(Auth::user()->rol_id ==1)
                        <li>
                            <a href="{!!URL::to('/asignar')!!}"><i class="fa fa-book"></i> Asignar </a>
                        </li>
                            <li>
                                <a href="{!!URL::to('/acciones')!!}"><i class="fa fa-rss"></i> Acciones </a>
                            </li>
                        @endif
                        @if(Auth::user()->rol_id ==1 )
                        <li>
                        <a href="#"><i class="fa fa-users fa-fw"></i> Usuario<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                           <li>

                               <a href="{!!URL::to('/usuario/create')!!}"><i class='fa fa-plus fa-fw'></i> Agregar</a>

                           </li>
                           <li>
                               <a href="#"><i class="fa fa-users fa-fw"></i>Usuarios<span class="fa arrow"></span></a>
                               <ul class="nav nav-second-level">
                                   @if(Auth::user()->rol_id ==1)
                                   <li>
                                       <a class="masaladerecha" href="{!!URL::to('/usuario')!!}"><i class='glyphicon glyphicon-user'></i> Administradores</a>
                                   </li>
                                   @endif
                                       @if(Auth::user()->rol_id ==1)
                                   <li>
                                       <a class="masaladerecha" href="{!!URL::to('/conta')!!}"><i class='glyphicon glyphicon-user'></i> Contables</a>
                                   </li>@endif
                                   <li>
                                       <a class="masaladerecha" href="{!!URL::to('/gesto')!!}"><i class='glyphicon glyphicon-user'></i> Gestorias</a>
                                   </li>
                                   <li>
                                       <a class="masaladerecha" href="{!!URL::to('/clien')!!}"><i class='glyphicon glyphicon-user'></i> Clientes</a>
                                   </li>

                               </ul>
                           </li>
                        </ul>
                        </li>

                        <li>
                           <a href="#"><i class="fa fa-suitcase fa-fw"></i> Gestoria<span class="fa arrow"></span></a>
                           <ul class="nav nav-second-level">
                               <li>
                                   <a href="{!!URL::to('/gestoria/create')!!}"><i class='fa fa-plus fa-fw'></i> Agregar</a>
                               </li>
                               <li>
                                   <a href="{!!URL::to('/gestoria')!!}"><i class='fa fa-list-ol fa-fw'></i> Gestorias</a>
                               </li>
                           </ul>
                        </li>
                    @endif
                    @if(Auth::user()->rol_id==2 || Auth::user()->rol_id==4 || \Illuminate\Support\Facades\Session::get('gestoria'))

                    <li>
                    @if(Auth::user()->rol_id !=1 || Auth::user()->rol_id !=4)
                    <a href="#"><i class="fa fa-male fa-fw"></i> Cliente<span class="fa arrow"></span></a>
                    @else
                       <a href="#"><i class="fa fa-male fa-fw"></i> Cliente ({{\Illuminate\Support\Facades\Session::get('gestoria')->nombre}})<span class="fa arrow"></span></a>
                    @endif
                    <ul class="nav nav-second-level">
                       @if(Auth::user()->rol_id !=3)

                       <li>
                           <a href="{!!URL::to('/cliente/create')!!}"><i class='fa fa-plus fa-fw'></i> Agregar</a>
                       </li>
                       @endif
                       <li>

                           <a href="{!!URL::to('/cliente')!!}"><i class='fa fa-list-ol fa-fw'></i> Clientes</a>

                       </li>
                    </ul>
                    </li>
                    @endif

                            @if(Auth::user()->rol_id ==2)
                                <div class="contacto">
                                    <div class="centrartotal">
                                {!!Html::image('images/logo1.png')!!}
                                <p>plataforma@nexemconsulting</p><p><a href="mailto:info@nexemconsulting.com">www.nexemconsulting.com</a></p></p> <p>627 09 86 76</p></div>
                                </div>
                            @endif
                    </ul>
                    </div>
                    </div>




@if(Auth::user()->rol_id ==3)
<div id="page-wrapper" class="col-lg-12   page-clientes">
@else
<div id="page-wrapper" class="">
@endif




@yield('content')


</div>

</div>

</div>


</div>

{!!Html::script('js/jquery.min.js')!!}
{!!Html::script('js/bootstrap.min.js')!!}
{!!Html::script('js/metisMenu.min.js')!!}
{!!Html::script('js/sb-admin-2.js')!!}
{!!Html::script('js/script8.js')!!}
<script type="text/javascript" src="dropzone/downloads/dropzone.js"></script>


@section('scripts')
@show


</body>

</html>