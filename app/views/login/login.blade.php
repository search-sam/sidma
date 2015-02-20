<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="img/escudo.png">

        <title>SIDMA</title>

        <!-- Bootstrap core CSS -->
        <link href="{{URL::to('/')}}/css/signin.css" rel="stylesheet">	
        <link href="{{URL::to('/')}}/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->


        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <div class="container" style="background-image: url('img/logo-V.png');
             background-repeat: no-repeat;
             background-position: center 50%;" >     
            <div class="row" >
                <div class="cols-sm-6 col-md-4 col-md-offset-4" >
                    <div class="panel panel-default" style="margin-top: 120px;background-color: transparent;" >
                        <div class="panel-heading">
                            <strong>Ingrese</strong> 
                        </div>

                        <div class="modal-body" style="background-color: transparent !important;">
                            <form  id="formulario" role="form" action="{{action('LoginController@acceso')}}" method="post">
                                <div class="form-signin-heading">
                                    <div class="alert alert-danger alert-dismissable"  id="aviso" <?= Session::has('message') ? '' : 'style="display:none"' ?>>
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        {{Session::get('message')}}
                                    </div>
                                </div>           
                                <fieldset>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-md-offset-0" >
                                            <div class="form-group ">
                                                <div class="input-group">
                                                    <span class="input-group-addon alert-success">
                                                        <i class="glyphicon glyphicon-user"></i>
                                                    </span>                            
                                                    <input name="usuario" type="text" id="user" autofocus class="form-control"  placeholder="Usuario" required/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon alert-success">
                                                        <i class="glyphicon glyphicon-lock"></i>
                                                    </span> 
                                                    <input name="contra" type="password" class="form-control" aria-describedby='basic-addon2' placeholder="Contrase&ntilde;a" required>
                                                </div>
                                            </div>

                                            <button id="acceso" class="btn btn-lg btn-success btn-block">Acceder</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="panel-footer">
                            <h6>No recuerdo mi contraseña</h6>
                        </div>
                    </div>
                </div>
            </div>

        </div> 
        <!-- /container -->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <script src="{{URL::to('/')}}/js/jquery.min.js"></script>

        <script src="{{URL::to('/')}}/js/validate.min.js"></script>
        <!-- Placed at the end of the document so the pages load faster -->
        <script>
$('form').validate();
        </script>
    </body>
</html>