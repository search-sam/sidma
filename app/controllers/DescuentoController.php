<?php

class DescuentoController extends BaseController {

    public function NewOrEdit() {
        $input = Input::all();
        if (isset($input['cod_discount'])) {
            $discount = Descuento::find($input['cod_discount']);
        } else {
            $discount = new Descuento;
        }
        $discount->discount_name = $input['nombredescuento'];
        $discount->discount_rate = $input['tasadescuento'];

        $discount->save();
         $msg = 'Se ha registrado correctamente un nuevo descuento al sistema :: <b>' . $discount->discount_name . '</b>';
        if (isset($input['cod_payment_plan'])) {
            $msg = 'Descuento <b>' . $discount->discount_name . '</b> :: Se han guardado correctamente los cambios realizados.';
        }
        return Redirect::action('AdministrativaController@inicio',array('#discounts'))->with('message_discount',$msg);
    }

    public function editar() {
        $input = Input::all();
        if (isset($input['cod_discount'])) {
            $discount = Descuento::find($input['cod_discount']);
        } else {
            $discount = New Descuento;
        }
        return View::make('descuento.editar')->with('discount', $discount);
    }

    public function agregar() {
        $input = Input::all();
        $year = Year::find($input['cod_school_year']);
        if (isset($input['cod_year_discount'])) {
            $my_year_discount = YearDescuento::find($input['cod_year_discount']);
        } else {
            $my_year_discount = new YearDescuento;
        }
        return View::make('descuento.agregar')->with('year', $year)->with('my_year_discount', $my_year_discount);
    }

    public function addtoyear() {
        $input = Input::all();
        if (isset($input['cod_school_year'])) {
            $cod_school_year = $input['cod_school_year'];
        }

        if (isset($input['cod_year_discount'])) {
            $year_discount = YearDescuento::find($input['cod_year_discount']);
        } else {
            $year_discount = new YearDescuento;
            $year_discount->cod_discount = $input['cod_discount'];
            $year_discount->cod_school_year = $cod_school_year;
        }
        $year_discount->discount_rate = $input['discount_rate'];
        $year_discount->save();
        $array = array();
        $array['discount_name'] = Descuento::find($year_discount->cod_discount)->discount_name;
        $array['discount_rate'] = $year_discount->discount_rate;
        $array['cod_year_discount'] = $year_discount->cod_year_discount;
        if (isset($input['cod_year_discount'])) {
            return Redirect::action('AdministrativaController@adminyear', array('cod_school_year' => $year_discount->cod_school_year));
        } else {
            return $array;
        }
    }

    public function borrar() {
        $input = Input::all();
        $discount = Descuento::find($input["cod_discount"]);
        return View::make('descuento.borrar')->with('discount', $discount);
    }

    public function borrardescuento() {
        $input = Input::all();
        $discount = Descuento::find($input["cod_discount"]);
        $discount->delete();
        return Redirect::action('AdministrativaController@inicio');
    }

}
