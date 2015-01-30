<?php

class HomeController extends BaseController {

	public function inicio()
	{
		return View::make('home.inicio');
	}

}