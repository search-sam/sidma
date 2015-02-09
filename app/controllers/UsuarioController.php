<?php

class UsuarioController extends BaseController {

    public function inicio()
    {
        $usuarios = Usuario::join('profile', 'profile.cod_profile', '=', 'user.cod_profile')
            ->whereRaw('user.cod_profile != 7 AND user.cod_profile != 1')->get();

        return View::make('usuario.usuario')->with('usuarios', $usuarios);
    }

    public function nuevo()
    {
        $input = Input::all();

        switch ($input['perfil'])
        {
            case 2:
                return View::make('usuario.creadirector');
            break;
            case 3:
                return View::make('usuario.creasecretaria');
            break;
            case 4:
                return View::make('usuario.creacoordinador');
            break;
            case 5:
                return View::make('usuario.creaguia');
            break;
            case 6:
                return View::make('usuario.creadocente');
            break;
            case 8:
                return View::make('usuario.creatutor');
            break;
        }
    }

}
