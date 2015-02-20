<?php

class HomeController extends BaseController {

    public function inicio() {
       if (Auth::check()) {            
        } else {
           return Redirect::to('login')->with('message', '<i class="glyphicon glyphicon-info-sign"></i> <strong>Denegado</strong>, debe ser usuario');
                 
        }
        return View::make('home.inicio');
    }

}
