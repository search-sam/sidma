<?php

class AdmonAcademicaController extends BaseController {

	public function inicio()
	{
		$year = Year::all();
		return View::make('admonacademica.admonacademica')->with('year', $year);
	}

}