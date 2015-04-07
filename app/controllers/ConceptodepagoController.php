<?php

class ConceptodepagoController extends BaseController {

    public function NewOrEdit() {
        $input = Input::all();
        if (isset($input['cod_concept'])) {
            $payment_concept = Conceptodepago::find($input['cod_concept']);
        } else {
            $payment_concept = new Conceptodepago;
        }
        $payment_concept->concept_name = $input['nombreconcepto'];
        $payment_concept->concept_normal_quantity = $input['cantidad'];
        $payment_concept->normal_payment = $input['normalpago'];

        $payment_concept->save();
        $msg = 'Se ha registrado correctamente un nuevo concepto de pago al sistema :: <b>' . $payment_concept->concept_name . '</b>';
        if (isset($input['cod_concept'])) {
            $msg = 'Concepto <b>' . $payment_concept->concept_name . '</b> :: Se han guardado correctamente los cambios realizados.';
        }
        return Redirect::action('AdministrativaController@inicio',array('#payment_concepts'))->with('message_payment_concept',$msg);
    }

    public function editar() {
        $input = Input::all();
        if (isset($input['cod_concept'])) {
            $payment_concept = Conceptodepago::find($input['cod_concept']);
        } else {
            $payment_concept = New Conceptodepago;
        }
        return View::make('conceptodepago.editar')->with('payment_concept', $payment_concept);


//return Redirect::action('AdmonacademicaController@inicio');
    }

    public function agregar() {
        $input = Input::all();
        $year = Year::find($input['cod_school_year']);
        if (isset($input['cod_year_payment_concept'])) {
            $my_year_payment_concept = YearConcepto::find($input['cod_year_payment_concept']);
        } else {
            $my_year_payment_concept = new YearConcepto;
        }
        return View::make('conceptodepago.agregar')->with('year', $year)->with('my_year_payment_concept', $my_year_payment_concept);
    }

    public function addtoyear() {
        $input = Input::all();
        if (isset($input['cod_school_year'])) {
            $cod_school_year = $input['cod_school_year'];
        }

        if (isset($input['cod_year_payment_concept'])) {
            $year_payment_concept = YearConcepto::find($input['cod_year_payment_concept']);
        } else {
            $year_payment_concept = new YearConcepto;
            $year_payment_concept->cod_concept = $input['cod_concept'];
            $year_payment_concept->cod_school_year = $cod_school_year;
        }
        $year_payment_concept->normal_payment = $input['normal_payment'];
        $year_payment_concept->save();
        $array = array();
        $array['concept_name'] = Conceptodepago::find($year_payment_concept->cod_concept)->concept_name;
        $array['concept_normal_quantity'] = Conceptodepago::find($year_payment_concept->cod_concept)->concept_normal_quantity;
        $array['normal_payment'] = $year_payment_concept->normal_payment;
        $array['cod_year_payment_plan'] = $year_payment_concept->cod_year_payment_concept;
        if (isset($input['cod_year_payment_concept'])) {
            return Redirect::action('AdministrativaController@adminyear', array('#payment_concepts','cod_school_year' => $year_payment_concept->cod_school_year));
        } else {
            return $array;
        }
    }

    public function borrar() {
        $input = Input::all();
        $payment_concept = Conceptodepago::find($input["cod_concept"]);
        return View::make('conceptodepago.borrar')->with('payment_concept', $payment_concept);
    }

    public function borrarconcepto() {
        $input = Input::all();
        $payment_concept = Conceptodepago::find($input["cod_concept"]);
        $payment_concept->delete();
        return Redirect::action('AdministrativaController@inicio');
    }

}
