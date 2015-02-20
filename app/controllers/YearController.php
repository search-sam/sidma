<?php

class YearController extends BaseController {

    public function inicio() {
        $years = Periodo::all();
        return View::make('year.year')->with('years', $years);
    }

    public function nuevo() {
        
    }

    public function editar() {
        $input = Input::all();
        if (isset($input['cod_school_year'])) {
            $year = Year::find($input['cod_school_year']);
        } else {
            $year = New Year;
        }
        return View::make('year.editar')->with('year', $year);
    }

    public function NewOrEdit() {
        $input = Input::all();
        if (isset($input['cod_school_year'])) {
            $year = Year::find($input['cod_school_year']);
        } else {
            $year = new Year;
        }
        $year->name_school_year =             $input['nombreyear'];
        $year->date_from =                    Util::FormatDateMysql($input['fechainicio']);
        $year->date_to =                      Util::FormatDateMysql($input['fechafin']);
        $year->evaluation_quantity_semester = $input['evaluaciones'];
        $year->minimum_note =                 $input['notaminima'];
        $year->minimum_failed_class =         $input['creditos'];
        $year->surcharge_rate =               $input['recargomora'];
        $year->surcharge_limit_days =         $input['limitedias'];
        $year->save();
        return Redirect::action('AdmonacademicaController@inicio');
    }

    public function borrar() {
        $input = Input::all();
        $year = Year::find($input["current_year"]);
        $year->delete();

        //  return Redirect::action('AdmonacademicaController@inicio', array('cod_school_year' => $input["cod_school_year"]));
    }

}
