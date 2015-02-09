<?php

class LoginController extends BaseController {

	public function login()
	{
		return View::make('login.login');
	}

	public function acceso()
	{
		$input   = Input::all();
		$usuario = Usuario::where('user', '=', $input['usuario'])->where('password', '=', $input['contra'])->get();
        if (!empty($usuario)) 
        {
            
        	if ($usuario[0]->estudiante->student_state == 1) 
        	{
	        	foreach ($usuario[0] as $key => $value) 
	        	{
	        		Session::put('usuario.'.$key, $value);
	        	}
        		return Redirect::action('HomeController@inicio');
        	}
        	else
        		return Redirect::action('LoginController@login');
        } 
        else 
        {
            return Redirect::action('LoginController@login');
        }
	}

	public function salir()
	{
		Auth::logout();
		if (Auth::check()) {
    		return Redirect::action('HomeController@inicio');
		} else {
			return Redirect::action('LoginController@login');
		}
	}

}