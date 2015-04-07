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

$nivel->save();
$msg = 'Se ha registrado correctamente un nuevo nivel al sistema :: <b>' . $nivel->level_name . '</b>';
        if (isset($input['cod_level'])) {
            $msg = 'Nivel <b>'.$nivel->level_name.'</b> :: Se han guardado correctamente los cambios realizados.';
        }
return Redirect::action('AdmonacademicaController@inicio',array('#levels'))->with('message_level',$msg);

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
