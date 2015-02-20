<?php

class NivelController extends BaseController {

public function inicio() {
$niveles = Nivel::all();
return View::make('nivel.nivel')->with('niveles', $niveles);
}

public function NewOrEdit(){
$input = Input::all();
if(isset($input['cod_level'])){
$nivel = Nivel::find($input['cod_level']);

}else{
$nivel = new Nivel;

}
$nivel->level_name = $input['nombrenivel'];
$nivel->description = $input['descripcion'];

$nivel->save();
return Redirect::action('AdmonacademicaController@inicio');

}

public function editar(){
$input = Input::all();
if(isset($input['cod_level'])){
$nivel = Nivel::find($input['cod_level']);

}else{
$nivel = New Nivel;
}
return View::make('nivel.editar')->with('nivel', $nivel);

}
public function borrar(){
$input = Input::all();
$nivel = Nivel::find($input["current_level"]);
return View::make('nivel.borrar')->with('nivel', $nivel);
}

 public function borrarclase(){
        $input = Input::all();
        $nivel = Nivel::find($input["cod_level"]);
        $nivel->delete();
        return Redirect::action('AdmonacademicaController@inicio');
    }



}
