<?php

class LoginController extends BaseController {

    public function login() {
        return View::make('login.login');
    }

    public function acceso() {
        $input = Input::all();
        $password = Hash::make($input['contra']);
        $user = $input['usuario'];
        $usuario = Usuario::whereRaw('user ="' . $user . '" and password ="' . $input['contra'] . '"')->first();

        if (!empty($usuario)) {//Si existe el usuario
            //Verificamos su perfil de usuario
            switch ($usuario->cod_profile) {

                case 1://admin
                    Auth::login($usuario);
                    return Redirect::action('HomeController@inicio');


                    break;
                case 2://director
                    return Redirect::to('login')->with('message', '<i class="glyphicon glyphicon-exclamation-sign"></i> <strong>Denegado</strong>, acceso solo a estudiantes y admins');
                    break;
                case 3://secretaria
                    return Redirect::to('login')->with('message', '<i class="glyphicon glyphicon-exclamation-sign"></i> <strong>Denegado</strong>, acceso solo a estudiantes y admins');
                    break;
                case 4://coordinador
                    return Redirect::to('login')->with('message', '<i class="glyphicon glyphicon-exclamation-sign"></i> <strong>Denegado</strong>, acceso solo a estudiantes y admins');
                    break;
                case 5://docente guia
                    return Redirect::to('login')->with('message', '<i class="glyphicon glyphicon-exclamation-sign"></i> <strong>Denegado</strong>, acceso solo a estudiantes y admins');
                    break;
                case 6://docente
                    return Redirect::to('login')->with('message', '<i class="glyphicon glyphicon-exclamation-sign"></i> <strong>Denegado</strong>, acceso solo a estudiantes y admins');
                    break;
                case 7://estudiante
                    if ($usuario[0]->estudiante->student_state == 1) {
                        foreach ($usuario[0] as $key => $value) {
                            Session::put('usuario.' . $key, $value);
                        }
                        return Redirect::action('HomeController@inicio');
                    } else {
                        return Redirect::to('login')->with('message', 'Denegado, estudiante inactivo');
                    }
                    break;
                case 8://tutor
                    break;
            }
        } else {

            return Redirect::to('login')->with('message', ' <i class="glyphicon glyphicon-exclamation-sign"></i> <strong>¡Acceso denegado!</strong>');
        }
    }

    public function salir() {
        Auth::logout();
        return Redirect::action('LoginController@login');
    }

}
