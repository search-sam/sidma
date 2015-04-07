<?php

class TurnoController extends BaseController {

public function inicio() {
$turnos = Turno::all();
return View::make('turno.turno')->with('turnos', $turnos);
}

public function NewOrEdit(){
$input = Input::all();
if(isset($input['cod_shift'])){
$turno = Turno::find($input['cod_shift']);

}else{
$turno = new Turno;

}
$turno->shift_name = $input['nombreturno'];

$turno->save();
$msg = 'Se ha registrado correctamente un nuevo turno al sistema :: <b>' . $turno->shift_name . '</b>';
        if (isset($input['cod_shift'])) {
            $msg = 'Turno <b>'.$turno->shift_name.'</b> :: Se han guardado correctamente los cambios realizados.';
        }
return Redirect::action('AdmonacademicaController@inicio',array('#shifts'))->with('message_shift',$msg);

}

public function editar(){
$input = Input::all();
if(isset($input['cod_shift'])){
$turno = Turno::find($input['cod_shift']);

}else{
$turno = New Turno;
}
return View::make('turno.editar')->with('turno', $turno);


//return Redirect::action('AdmonacademicaController@inicio');
}
public function borrar(){
$input = Input::all();
$turno = Turno::find($input["current_shift"]);
return View::make('turno.borrar')->with('turno', $turno);
}

 public function borrarclase(){
        $input = Input::all();
        $turno = Turno::find($input["cod_shift"]);
        $turno->delete();
        return Redirect::action('AdmonacademicaController@inicio');
    }



}
