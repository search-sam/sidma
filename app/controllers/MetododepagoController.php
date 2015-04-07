<?php

class MetododepagoController extends BaseController {

    public function NewOrEdit() {
        $input = Input::all();
        if (isset($input['cod_payment_method'])) {
            $payment_method = Metododepago::find($input['cod_payment_method']);
        } else {
            $payment_method = new Metododepago;
        }
        $payment_method->payment_method = $input['nombremetodo'];

        $payment_method->save();
        $msg = 'Se ha registrado correctamente un nuevo método de pago al sistema :: <b>' . $payment_method->payment_method . '</b>';
        if (isset($input['cod_payment_method'])) {
            $msg = 'Método de pago <b>' . $payment_method->payment_method . '</b> :: Se han guardado correctamente los cambios realizados.';
        }
        return Redirect::action('AdministrativaController@inicio',array('#payment_methods'))->with('message_payment_method',$msg);
    }

    public function editar() {
        $input = Input::all();
        if (isset($input['cod_payment_method'])) {
            $payment_method = Metododepago::find($input['cod_payment_method']);
        } else {
            $payment_method = New Metododepago;
        }
        return View::make('metododepago.editar')->with('payment_method', $payment_method);


//return Redirect::action('AdmonacademicaController@inicio');
    }

    public function borrar() {
        $input = Input::all();
        $payment_method = Metododepago::find($input["cod_payment_method"]);
        return View::make('metododepago.borrar')->with('payment_method', $payment_method);
    }

    public function borrarmetodo() {
        $input = Input::all();
        $payment_plan = Metododepago::find($input["cod_payment_method"]);
        $payment_plan->delete();
        return Redirect::action('AdministrativaController@inicio');
    }

}
