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
        if (isset($input['nombreyear'])) {
            $year->name_school_year = $input['nombreyear'];
        }
        if (isset($input['fechainicio'])) {
            $year->date_from = Util::FormatDateMysql($input['fechainicio']);
        }
        if (isset($input['fechafin'])) {
            $year->date_to = Util::FormatDateMysql($input['fechafin']);
        }
        if (isset($input['evaluaciones'])) {
            $year->evaluation_quantity_semester = $input['evaluaciones'];
        }
         if (isset($input['notaminima'])) {
             $year->minimum_note = $input['notaminima'];
        }
         if (isset($input['creditos'])) {
            $year->minimum_failed_class = $input['creditos'];
        }
         if (isset($input['recargomora'])) {
           $year->surcharge_rate = $input['recargomora'];
        }
         if (isset($input['limitedias'])) {
           $year->surcharge_limit_days = $input['limitedias'];
        }   
        $year->save();
          if (isset($input['next_action'])) {
           return Redirect::action($input['next_action']);
        }    
         $msg = 'Se ha registrado correctamente un nuevo año lectivo al sistema :: <b>' . $year->name_school_year . '</b>';
        if (isset($input['cod_school_year'])) {
            $msg = 'Año lectivo <b>'.$year->name_school_year.'</b> :: Se han guardado correctamente los cambios realizados.';
        }
        return Redirect::action('AdmonacademicaController@inicio',array('#lectiveyear'))->with('message_year',$msg);
    }

    public function borrar() {
        $input = Input::all();
        $year = Year::find($input["current_year"]);
        $year->delete();

        //  return Redirect::action('AdmonacademicaController@inicio', array('cod_school_year' => $input["cod_school_year"]));
    }

}
