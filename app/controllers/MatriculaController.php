<?php

class MatriculaController extends BaseController {

	public function inicio()
	{
		$matriculas = Estudiante::join('user', 'user.cod_user', '=', 'student.cod_user')
                        ->where('cod_profile','!=',1)->get();

		return View::make('matricula.matricula')->with('matriculas', $matriculas);
	}

}