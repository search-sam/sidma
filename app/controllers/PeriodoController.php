<?php

class PeriodoController extends BaseController {

    public function inicio() {
         if (Auth::check()) {            
        } else {
           return Redirect::to('login')->with('message', '<i class="glyphicon glyphicon-info-sign"></i> <strong>Denegado</strong>, debe ser usuario');
                 
        }
        $periodos = Periodo::all();       
        
        return View::make('periodo.periodo')
                ->with('periodos', $periodos);
               
    }
    
   
    
    
    public function nuevo() {
        $input = Input::all();
        $periodo = New Periodo;
        $cod_school_year = $input["cod_school_year"];

        $periodo->period_name = empty($input["fechainicio"]) ? NULL : empty($input["fechafin"]) ? NULL : empty($input["nombreperiodo"]) ? NULL : $input["nombreperiodo"];


        $periodo->date_from = Util::FormatDateMysql($input["fechainicio"]);
        $periodo->date_to = Util::FormatDateMysql($input["fechafin"]);
        $periodo->cod_school_year = $cod_school_year;
        $periodo->save();
        return Redirect::action('AdmonacademicaController@periodos', array('cod_school_year' => $cod_school_year));
    }
    
    public function generar(){
        $input = Input::all();
        $year = Year::find($input["cod_school_year"]);
     
        foreach(Util::$NamePeriod as $period =>$nombreperiodo){
         
          $periodo = New Periodo;
          $periodo->cod_school_year = $year->cod_school_year;
          $periodo->period_name = $nombreperiodo;
       
          $periodo->save();
         
        }
       return Redirect::action('AdmonacademicaController@periodos', array('cod_school_year' => $input["cod_school_year"]));

    }
    public function actualizarfechaperiodo (){
        
       $input = Input::all();
        $field = $input['field'];
        $field = explode('_', $field);
        $fixdate = $field[0].'_'.$field[1];
        $periodo = Periodo::find($field[2]);
        if($fixdate==='date_from'){
            $periodo->date_from = Util::FormatDateMysql($input['value']);
        }
        if($fixdate==='date_to'){
            $periodo->date_to = Util::FormatDateMysql($input['value']);
        }
        $periodo->save();
        
    }
    public function editar(){
          $input = Input::all();
         if(isset($input['cod_period'])){
             $periodo = Periodo::find($input['cod_period']);
            
         }else{
             $periodo = New Periodo;
         }
        return View::make('periodo.editar')->with('periodo', $periodo);
    }
    public function borrar() {
        $input = Input::all();    
        $periodo = Periodo::find($input["current_period"]);
        $periodo->delete();
        
        return Redirect::action('AdmonacademicaController@periodos', array('cod_school_year' => $input["cod_school_year"]));
    }

}
