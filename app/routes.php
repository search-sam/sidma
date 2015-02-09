<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return Redirect::action('LoginController@login');
});

/* LoginController */
Route::any('login', 'LoginController@login');
Route::any('acceso', 'LoginController@acceso');
Route::any('salir', 'LoginController@salir');
Route::any('validar/usuario', 'LoginController@validuser');

/* HomeController */
Route::any('inicio', 'HomeController@inicio');

/* Estudiante Controller */
Route::any('estudiante/inicio', 'EstudianteController@inicio');
Route::any('estudiante/nuevo', 'EstudianteController@nuevo');
Route::any('estudiante/guardar', 'EstudianteController@guardar');
Route::any('estudiante/editar', 'EstudianteController@editar');
Route::any('estudiante/actulizar', 'EstudianteController@actulizar');
Route::any('estudiante/deshabilitar', 'EstudianteController@deshabilitar');
Route::any('estudiante/datos', 'EstudianteController@datosmatricula');
Route::any('estudiante/informar', 'EstudianteController@guardardatos');

/* FamiliaController */
Route::any('familia/inicio', 'FamiliaController@inicio');
Route::any('familia/agregar', 'FamiliaController@agregar');
Route::any('padre/nuevo', 'FamiliaController@padrenuevo');
Route::any('padre/guardar', 'FamiliaController@padreguardar');
Route::any('padre/tutor', 'FamiliaController@tutoragregar');

/* MatriculaController */
Route::any('matricula/inicio', 'MatriculaController@inicio');
//Route::any('estudiante/inicio', 'MatriculaController@inicio');

/* AdmonAcademicaController */
Route::any('admonacademica/inicio','AdmonacademicaController@inicio');