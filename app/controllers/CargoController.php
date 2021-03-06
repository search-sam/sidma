<?php

class CargoController extends BaseController {

    public function inicio() {
        $cargos = Cargo::all();
        return View::make('cargo.cargo')
            ->with('cargos', $cargos);
    }

    public function editar() {
        $input = Input::all();
        if (isset($input['cod_employment'])) {
            $cargo = Cargo::find($input['cod_employment']);
        } else {
            $cargo = New Cargo;
        }
        return View::make('cargo.editar')->with('cargo', $cargo);
    }

    public function NewOrEdit() {
        $input = Input::all();
        if (isset($input['cod_employment'])) {
            $cargo = Cargo::find($input['cod_employment']);
        } else {
            $cargo = new Cargo;
        }
        $cargo->employment_name = $input['nombrecargo'];
        $cargo->description = $input['descripcion'];
        $msg = 'Se ha registrado correctamente un nuevo cargo al sistema :: <b>' . $cargo->employment_name . '</b>';
        if (isset($input['cod_employment'])) {
            $msg = 'Cargo <b>' . $cargo->employment_name . '</b> :: Se han guardado correctamente los cambios realizados.';
        }

        $cargo->save();


<<<<<<< HEAD
        return Redirect::action('EmpleadoController@inicio', array('#employments'))->with('message_employment', $msg);
=======
        return Redirect::action('EmpleadoController@inicio');
>>>>>>> b248824688b330e9e66101235b80bafb5ae5f18a
    }

}
