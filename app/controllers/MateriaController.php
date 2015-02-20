<?php

class MateriaController extends BaseController {

public function inicio() {
$materias = Materia::all();
return View::make('materia.materia')->with('materias', $materias);
}

public function NewOrEdit(){
$input = Input::all();
if(isset($input['cod_subject'])){
$materia = Materia::find($input['cod_subject']);

}else{
$materia = new Materia;

}
$materia->subject_name = $input['nombremateria'];

$materia->save();
return Redirect::action('AdmonacademicaController@inicio');

}

public function editar(){
$input = Input::all();
if(isset($input['cod_subject'])){
$materia = Materia::find($input['cod_subject']);

}else{
$materia = New Materia;
}
return View::make('materia.editar')->with('materia', $materia);


//return Redirect::action('AdmonacademicaController@inicio');
}
public function borrar(){
$input = Input::all();
$materia = Materia::find($input["current_subject"]);
return View::make('materia.borrar')->with('materia', $materia);
}

 public function borrarclase(){
        $input = Input::all();
        $materia = Materia::find($input["cod_subject"]);
        $materia->delete();
        return Redirect::action('AdmonacademicaController@inicio');
    }



}
