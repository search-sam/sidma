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
$msg = 'Se ha registrado correctamente una nueva materia  al sistema :: <b>' . $materia->subject_name . '</b>';
        if (isset($input['cod_subject'])) {
            $msg = 'Materia <b>'.$materia->subject_name.'</b> :: Se han guardado correctamente los cambios realizados.';
        }
return Redirect::action('AdmonacademicaController@inicio',array('#subjects'))->with('message_subject',$msg);

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
