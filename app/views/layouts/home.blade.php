<!DOCTYPE html>
<?php
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="{{URL::to('/')}}/img/escudo.png">
        <title>SIDMA</title>

        <!-- Bootstrap core CSS -->
        <link href="{{URL::to('/')}}/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{URL::to('/')}}/css/dashboard.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/css/docs.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/css/main.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        @yield('css')
    </head>

    <body>

        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">            
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{action('HomeController@inicio')}}"><img src="{{URL::to('/')}}/img/logo.svg"></a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        {{-- if ((Session::get('usuario.cod_profile') == 1) or (Session::get('usuario.cod_profile') == 2)) --}}
                        <li><a href="{{action('AdmonacademicaController@inicio')}}"><span class="glyphicon glyphicon-cog"></span> Académica</a></li>
                        <li><a href="{{action('AdministrativaController@inicio')}}"><span class="glyphicon glyphicon-cog"></span> Aministrativa</a></li>
                        <li><a href="{{action('MatriculaController@inicio')}}"><i class="glyphicon glyphicon-file"></i> Matricula</a></li>
                        <li><a href="{{action('DocenteController@inicio')}}">Docente</a></li>
                        <li><a href="{{action('EstudianteController@inicio')}}"><span class="glyphicon glyphicon-education"></span> Estudiante</a></li>

                        <li><a href="{{action('FamiliaController@inicio')}}"><i class="glyphicon glyphicon-tree-deciduous"></i> Familia</a></li>
                        <li><a href="{{action('EmpleadoController@inicio')}}"><i class="glyphicon glyphicon-folder-open"></i> Empleado</a></li>
                        {{-- @endif --}}
                        <li class="dropdown">
                            <a  style="padding-bottom: 7px;padding-top: 7px;margin-top: 7px;margin-right: 7px;" class="btn btn-sm navbar-inverse dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                    <span class="glyphicon glyphicon-user"></span>
                                         {{Auth::user()->user}} :: {{Perfil::find(Auth::user()->cod_profile)->profile_name}} 
                                         <i class="glyphicon glyphicon-menu-down"></i>
                                </a>
                            <ul class="dropdown-menu" style="font-size: 13px;" role="menu" aria-labelledby="dropdownMenu1">
                                <li class="dropdown-header"><span class="glyphicon glyphicon-cog"></span> Ayuda y configuración</li>
                                <li >
                                        <a href="{{action('LoginController@salir')}}">
                                            <span class="glyphicon glyphicon-list-alt"></span> Registro de actividad
                                        </a>
                                    </li>   
                                <li >
                                <li >
                                        <a href="{{action('LoginController@salir')}}">
                                            <span class="glyphicon glyphicon-lock"></span> Info. Cuenta
                                        </a>
                                    </li>   
                                <li >
                                        <a href="{{action('LoginController@salir')}}">
                                            <span class="glyphicon glyphicon-list"></span> Editar perfil
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li >
                                        <a href="{{action('LoginController@salir')}}">
                                            <span class="glyphicon glyphicon-off "></span> Cerrar sesión
                                        </a>
                                    </li>
                                </ul>
                            </a>
                        </li>                   
                    </ul>
                </div>
            </div>
        </div>


        <div class="container-fluid">
            <div class="row">
                @yield('side')
                @yield('content')
            </div>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> --}}
        <script src="{{URL::to('/')}}/js/jquery-2.1.3.min.js"></script>
        <script src="{{URL::to('/')}}/js/bootstrap.min.js"></script>        
        <script src="{{URL::to('/')}}/js/gnsys-2015-validate.js"></script>
        {{-- <script src="{{URL::to('/')}}/js/main.js"></script>--}}


    @yield('js')
</body>
</html>
