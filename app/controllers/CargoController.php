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

        $cargo->save();
     
      
        return Redirect::action('EmpleadoController@inicio');
    }

}
