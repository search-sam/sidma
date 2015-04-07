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

        <script  type="text/javascript" language="javascript" src="{{URL::to('/')}}/js/jquery-2.1.3.min.js"></script>
        <script  type="text/javascript" language="javascript" src="{{URL::to('/')}}/js/gnsys-2015-validate.js"></script>
        <!--<script src="{{URL::to('/')}}/js/validate.min.js"></script>-->
        <!-- Placed at the end of the document so the pages load faster -->
        <script type="text/javascript">
$(document).ready(function() {
    $(document).on('click','#saveacceso',function(){
        if(formIsvalid($('.form-control[required]'))){
            $('#formulario').submit();
        }
    });
});
        </script>
     
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
                                    <div class="alert alert-danger"   id="aviso" style="margin-bottom: 5px;<?= Session::has('message') ? '' : 'display:none;' ?>" >
                                        {{Session::get('message')}}
                                    </div>
                                    
                                    <div class="indicator"></div>
                                </div>           
                                <fieldset>
                                    <div class="row" style="padding: 10px;">
                                        <div class="col-sm-12 col-md-12 col-md-offset-0" >
                                            <div class="form-group ">
                                                <div class="input-group">
                                                    <span class="input-group-addon alert-success">
                                                        <i class="glyphicon glyphicon-user"></i>
                                                    </span>                            
                                                    <input name="usuario" type="text"  <?= Session::has('message') ? '':'autofocus'?> id="user" class="form-control"  placeholder="Usuario" required/>
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

                                             </div>
                                    </div>
                                </fieldset>
                            </form>
                             <button type="button" id="saveacceso" class="saveaccess btn btn-lg btn-success btn-block"><i class="glyphicon glyphicon-log-in"></i> Acceder</button>
                                      
                        </div>
                        <div class="panel-footer">
                            <h6><i class="glyphicon glyphicon-question-sign"></i> No recuerda su contraseña</h6>
                        </div>
                    </div>
                </div>
            </div>

        </div>         <!-- /container -->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        

    </body>
</html>