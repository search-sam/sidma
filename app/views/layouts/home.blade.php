
<!DOCTYPE html>
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
                        <li><a href="{{action('AdmonacademicaController@inicio')}}"><span class="glyphicon glyphicon-cog"></span> Admón. Académica</a></li>
                        <li><a href="{{action('MatriculaController@inicio')}}">Matricula</a></li>
                        <li><a href="{{action('EstudianteController@inicio')}}"><span class="glyphicon glyphicon-education"></span>Estudiante</a></li>
                        <li><a href="{{action('FamiliaController@inicio')}}">Familia</a></li>
                        <li><a href="{{action('EmpleadoController@inicio')}}"><span class="glyphicon glyphicon-user"></span> Empleado</a></li>
                        {{-- @endif --}}
                        <li><a href="{{action('LoginController@salir')}}"><span class="glyphicon glyphicon-off"></span> Salir</a></li>
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
        <script src="{{URL::to('/')}}/js/jquery.min.js"></script>
        <script src="{{URL::to('/')}}/js/bootstrap.min.js"></script>
        <script src="{{URL::to('/')}}/js/main.js"></script>
        @yield('js')
    </body>
</html>
