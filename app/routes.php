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

/* CargoController */ 
Route::any('cargo/inicio','CargoController@inicio');
Route::any('cargo/editar','CargoController@editar');
Route::any('cargo/neworedit','CargoController@neworedit');

/* EmpleadoController */ 
Route::any('empleado/inicio','EmpleadoController@inicio');
Route::any('empleado/editar','EmpleadoController@editar');
Route::any('empleado/neworedit','EmpleadoController@neworedit');

/* EmpleadoController */ 
Route::any('docente/inicio','DocenteController@inicio');
Route::any('docente/editar','DocenteController@editar');
Route::any('docente/neworedit','DocenteController@neworedit');

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
Route::any('matricula/editar', 'MatriculaController@editar');

/*YearController */
Route::any('year/inicio', 'YearController@inicio');
Route::any('year/editar', 'YearController@editar');
Route::any('year/neworedit', 'YearController@neworedit');

/*PeriodoController */
Route::any('periodo/inicio', 'PeriodoController@inicio');
Route::any('periodo/nuevo', 'PeriodoController@nuevo');
Route::any('Periodo/borrar', 'PeriodoController@borrar');
Route::any('periodo/generar', 'PeriodoController@generar');
Route::any('periodo/editar', 'PeriodoController@editar');
Route::any('periodo/actualizarfechaperiodo', 'PeriodoController@actualizarfechaperiodo');

/*AulaController*/
Route::any('classroom/inicio', 'ClassroomController@inicio');
Route::any('classroom/neworedit', 'ClassroomController@neworedit');
Route::any('classroom/borrar', 'ClassroomController@borrar');
Route::any('classroom/borrarclase', 'ClassroomController@borrarclase');
Route::any('classroom/editar', 'ClassroomController@editar');

/*ClaseController*/
Route::any('clase/editarclase', 'ClaseController@editarclase');
Route::any('clase/agregarmateria', 'ClaseController@agregarmateria');


/*NivelController*/
Route::any('nivel/inicio', 'NivelController@inicio');
Route::any('nivel/editar', 'NivelController@editar');
Route::any('nivel/neworedit', 'NivelController@neworedit');
Route::any('nivel/borrar', 'NivelController@borrar');
Route::any('nivel/borrarclase', 'NivelController@borrarclase');
/*MateriaController*/
Route::any('materia/inicio', 'MateriaController@inicio');
Route::any('materia/editar', 'MateriaController@editar');
Route::any('materia/neworedit', 'MateriaController@neworedit');
Route::any('materia/borrar', 'MateriaController@borrar');
Route::any('materia/borrarclase', 'MateriaController@borrarclase');

/*TurnoController*/
Route::any('turno/inicio', 'TurnoController@inicio');
Route::any('turno/editar', 'TurnoController@editar');
Route::any('turno/neworedit', 'TurnoController@neworedit');
Route::any('turno/borrar', 'TurnoController@borrar');
Route::any('turno/borrarclase', 'TurnoController@borrarclase');

/*GrupoController */
Route::any('grupo/inicio', 'GrupoController@inicio');
Route::any('grupo/agregar', 'GrupoController@agregar');
Route::any('grupo/agregargrupo', 'GrupoController@agregargrupo');
Route::any('grupo/reasignar', 'GrupoController@reasignar');
Route::any('grupo/reasignargrupo', 'GrupoController@reasignargrupo');
Route::any('grupo/gruposyear','GrupoController@gruposyear');
ROute::any('grupo/neworedit','GrupoController@neworedit');//Esta ruta es para crear o editar nuevo grupo year

/* AdmonAcademicaController */
Route::any('admonacademica/inicio','AdmonacademicaController@inicio');
<<<<<<< HEAD
Route::any('admonacademica/periodos','AdmonacademicaController@periodos');

Route::get('archive', array('before' => 'require_login', 'uses' => 'HomeController@archive'));
=======

/* UsuarioController*/
Route::any('usuario/inicio','UsuarioController@inicio');
Route::any('usuario/nuevo','UsuarioController@nuevo');
>>>>>>> fc3a6fb7cb8fdc99b9dc659b6533c4da06aef4fe
