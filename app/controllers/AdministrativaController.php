<?php

class AdministrativaController extends BaseController {

    public function inicio() {
         if (Auth::check()) {            
        } else {
           return Redirect::to('login')->with('message', '<i class="glyphicon glyphicon-info-sign"></i> <strong>Denegado</strong>, debe ser usuario');
                 
        }
        $years = Year::all();
        $payment_plans = Plandepago::all();
        $payment_methods = Metododepago::all();
        $payment_concepts = Conceptodepago::all();
        $discounts = Descuento::all();
        return View::make('administrativa.administrativa')
                        ->with('payment_plans', $payment_plans)
                        ->with('payment_methods', $payment_methods)
                        ->with('payment_concepts', $payment_concepts)
                        ->with('years', $years)
                        ->with('discounts', $discounts);
    }

    public function adminyear() {
        $input = Input::all();
        $year = Year::find($input['cod_school_year']);
        $year_payment_plans = YearPlandepago::where('cod_school_year', $year->cod_school_year)->get();
        $year_payment_concepts = YearConcepto::where('cod_school_year', $year->cod_school_year)->get();
        $year_discounts = YearDescuento::where('cod_school_year', $year->cod_school_year)->get();
        return View::make('administrativa.adminyear')
                        ->with('year', $year)
                        ->with('year_payment_plans', $year_payment_plans)
                        ->with('year_payment_concepts', $year_payment_concepts)
                        ->with('year_discounts', $year_discounts);
    }

    public function editaryear() {
        $input = Input::all();
        $year = Year::find($input['cod_school_year']);
        return View::make('adminyear.editaryear')->with('year', $year);
    }

    public function periodos() {
        $input = Input::all();
        $year = Year::find($input['cod_school_year']);
        $periodos = Periodo::where('cod_school_year', '=', $year->cod_school_year)->get();

        return View::make('admonacademica.periodos')
                        ->with('year', $year)
                        ->with('periodos', $periodos);
    }

}
