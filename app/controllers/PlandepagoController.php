<?php

class PlandepagoController extends BaseController {

    public function NewOrEdit() {
        $input = Input::all();
        if (isset($input['cod_payment_plan'])) {
            $payment_plan = Plandepago::find($input['cod_payment_plan']);
        } else {
            $payment_plan = new Plandepago;
        }
        $payment_plan->plan_name = $input['nombreplandepago'];
        $payment_plan->payment_quantity = $input['cantidadpagos'];
        $payment_plan->discount_rate = $input['descuento'];

        $payment_plan->save();
         $msg = 'Se ha registrado correctamente un nuevo plan de pago al sistema :: <b>' . $payment_plan->plan_name . '</b>';
        if (isset($input['cod_payment_plan'])) {
            $msg = 'Plan de pago <b>' . $payment_plan->plan_name . '</b> :: Se han guardado correctamente los cambios realizados.';
        }
        return Redirect::action('AdministrativaController@inicio',array('#payment_plans'))->with('message_payment_plan',$msg);
    }
   public function gestionpago(){
       $input = Input::all();
       $cod_student = $input['cod_student'];
       $year = new Year;
       $cod_school_year = $year->vigente()->cod_school_year;
       $estudiante = Estudiante::find($cod_student);
       return View::make('plandepago.gestionpago')->with('cod_student',$cod_student)
           ->with('estudiante',$estudiante)->with('cod_school_year',$cod_school_year);
   }
   public function realizarpago(){
       
   }
    public function editar() {
        $input = Input::all();
        if (isset($input['cod_payment_plan'])) {
            $payment_plan = Plandepago::find($input['cod_payment_plan']);
        } else {
            $payment_plan = New Plandepago;
        }
        return View::make('plandepago.editar')->with('payment_plan', $payment_plan);


//return Redirect::action('AdmonacademicaController@inicio');
    }

    public function borrar() {
        $input = Input::all();
        $payment_plan = Plandepago::find($input["cod_payment_plan"]);
        return View::make('plandepago.borrar')->with('payment_plan', $payment_plan);
    }

    public function borrarplan() {
        $input = Input::all();
        $payment_plan = Plandepago::find($input["cod_payment_plan"]);
        $payment_plan->delete();
        return Redirect::action('AdministrativaController@inicio');
    }

    public function agregar() {
        $input = Input::all();
        $year = Year::find($input['cod_school_year']);
        if (isset($input['cod_year_payment_plan'])) {
            $my_year_payment_plan = YearPlandepago::find($input['cod_year_payment_plan']);
        } else {
            $my_year_payment_plan = new YearPlandepago;
        }
        return View::make('plandepago.agregar')->with('year', $year)->with('my_year_payment_plan', $my_year_payment_plan);
    }

    public function addtoyear() {
        $input = Input::all();
        if (isset($input['cod_school_year'])) {
            $cod_school_year = $input['cod_school_year'];           
        }

        if (isset($input['cod_year_payment_plan'])) {
            $year_payment_plan = YearPlandepago::find($input['cod_year_payment_plan']);
        } else {
            $year_payment_plan = new YearPlandepago;
            $year_payment_plan->cod_payment_plan = $input['cod_payment_plan'];
            $year_payment_plan->cod_school_year = $cod_school_year;
        }
        $year_payment_plan->discount_rate = $input['discount_rate'];
        $year_payment_plan->save();
        $array = array();
        $array['plan_name'] = Plandepago::find($year_payment_plan->cod_payment_plan)->plan_name;
        $array['payment_quantity'] = Plandepago::find($year_payment_plan->cod_payment_plan)->payment_quantity;
        $array['discount_rate'] = $year_payment_plan->discount_rate;
        $array['cod_year_payment_plan'] = $year_payment_plan->cod_year_payment_plan;
         if (isset($input['cod_year_payment_plan'])) {
           return Redirect::action('AdministrativaController@adminyear',array('cod_school_year'=>$year_payment_plan->cod_school_year));
         }else{
         return $array;}
    }

}
