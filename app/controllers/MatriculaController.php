<?php

class MatriculaController extends BaseController {

    public function inicio() {
        if (Auth::check()) {
            
        } else {
            return Redirect::to('login')->with('message', '<i class="glyphicon glyphicon-info-sign"></i> <strong>Denegado</strong>, debe ser usuario');
        }
        $year = new Year;
        $matriculas = Estudiante::orderBy('first_name', 'asc')->get();

        return View::make('matricula.matricula')->with('matriculas', $matriculas)->with('year', $year);
    }
    
    public function registrosactuales(){
        $year = new Year;
        $matriculas = Estudiante::orderBy('first_name', 'asc')->get();

        return View::make('matricula.registrosactuales')->with('matriculas', $matriculas)->with('year', $year);
    }

    public function enroll() {
        $input = Input::all();
        $matricula = Matricula::find($input['cod_enrollment']);
        $enrollment_type = isset($input['enrollment_type']) ? $input['enrollment_type'] : 1; //1 es matricula ordinaria
        $cod_year_grupo = isset($input['cod_year_grupo']) ? $input['cod_year_grupo'] : 0; //0 es que no selecciono nada
        $year = new Year;
        $cod_school_year = $year->vigente()->cod_school_year;
        if ($cod_year_grupo != 0) {
            $matricula->enrollment_type = $enrollment_type;
            $matricula->cod_year_grupo = $cod_year_grupo;
            $matricula->save();
            $cod_concept_enrollment = YearConcepto::whereRaw('cod_concept=3 AND cod_school_year=' . $cod_school_year)->first()->cod_year_payment_concept;
            $cod_concept_month = YearConcepto::whereRaw('cod_concept=4 AND cod_school_year=' . $cod_school_year)->first()->cod_year_payment_concept;
            $estudiante_plan_mensualidad = EstudiantePlandepago::where('cod_student', $matricula->cod_student)->where('cod_year_payment_concept', $cod_concept_month)->first();
            $estudiante_plan_matricula = EstudiantePlandepago::where('cod_student', $matricula->cod_student)->where('cod_year_payment_concept', $cod_concept_enrollment)->first();
            $quota_quantity_matricula = $estudiante_plan_matricula->yearplandepago->plandepago->payment_quantity;
            $quota_quantity_mensualidad = $estudiante_plan_mensualidad->yearplandepago->plandepago->payment_quantity;
            $end_date = $year->vigente()->date_to;

            $regular_payment_date_matricula = date("Y", strtotime($year->vigente()->date_from)) . '-' . (intval(date("m", strtotime($year->vigente()->date_from))) - $estudiante_plan_matricula->begin_payment_month + 1 ) . '-01';
            $regular_payment_date_mensualidad = date("Y", strtotime($year->vigente()->date_from)) . '-' . (intval(date("m", strtotime($year->vigente()->date_from))) - $estudiante_plan_mensualidad->begin_payment_month + 1) . '-01';
            $quota_mes = 12 * ($estudiante_plan_mensualidad->yearconcepto->normal_payment) * (100 - $estudiante_plan_mensualidad->yearplandepago->discount_rate) / 100 * (100 - $estudiante_plan_mensualidad->yeardescuento->discount_rate) / 100 / $quota_quantity_mensualidad;


            if ($matricula->enrollment_state == 0) {//Si matricula esta en estado 0 registro previo
                for ($i = 1; $i <= $quota_quantity_matricula; $i++) {
                    if (date('w', strtotime($regular_payment_date_matricula)) == 0) {
                        $regular_payment_date_matricula = date('Y-m-d', strtotime('+1 day', strtotime($regular_payment_date_matricula)));
                    } elseif (date('w', strtotime($regular_payment_date_matricula)) == 6) {
                        $regular_payment_date_matricula = date('Y-m-d', strtotime('+2 days', strtotime($regular_payment_date_matricula)));
                    }
                    $cuota_matricula = new Cuotadepago;
                    $cuota_matricula->cod_student_payment_plan = $estudiante_plan_matricula->cod_student_payment_plan;
                    $cuota_matricula->quota = $i;
                    $cuota_matricula->regular_payment_date = $regular_payment_date_matricula; // establecer la primera fecha de pago

                    $nma_limit_day = date('Y-m-d', strtotime('+' . $estudiante_plan_matricula->limit_payment_days . ' days', strtotime($regular_payment_date_matricula)));
                    if (date('w', strtotime($nma_limit_day)) == 0) {
                        $nma_limit_day = date('Y-m-d', strtotime('+1 day', strtotime($nma_limit_day)));
                    } elseif (date('w', strtotime($nma_limit_day)) == 6) {
                        $nma_limit_day = date('Y-m-d', strtotime('+2 days', strtotime($nma_limit_day)));
                    }
                    $cuota_matricula->limit_date = $nma_limit_day;
                    $cuota_matricula->quota_amount = $estudiante_plan_matricula->yearconcepto->normal_payment * (100 - $estudiante_plan_matricula->yearplandepago->discount_rate) / 100 * (100 - $estudiante_plan_matricula->yeardescuento->discount_rate) / 100;
                    $cuota_matricula->quota_payment_state = 0;

                    $regular_payment_date_matricula = date('Y-m-d', strtotime('+1 month', strtotime($regular_payment_date_matricula)));

                    $cuota_matricula->save();
                }
                for ($i = 1; $i <= $quota_quantity_mensualidad; $i++) {

                    if (date('w', strtotime($regular_payment_date_mensualidad)) == 0) {
                        $regular_payment_date_mensualidad = date('Y-m-d', strtotime('+1 day', strtotime($regular_payment_date_mensualidad)));
                    } elseif (date('w', strtotime($regular_payment_date_mensualidad)) == 6) {
                        $regular_payment_date_mensualidad = date('Y-m-d', strtotime('+2 days', strtotime($regular_payment_date_mensualidad)));
                    }
                    $cuota_mensualidad = new Cuotadepago;
                    $cuota_mensualidad->cod_student_payment_plan = $estudiante_plan_mensualidad->cod_student_payment_plan;
                    $cuota_mensualidad->quota = $i;
                    $cuota_mensualidad->regular_payment_date = $regular_payment_date_mensualidad; // establecer la primera fecha de pago

                    $nme_limit_day = date('Y-m-d', strtotime('+' . $estudiante_plan_mensualidad->limit_payment_days . ' days', strtotime($regular_payment_date_mensualidad)));
                     if (date('w', strtotime($nme_limit_day)) == 0) {
                       $nme_limit_day = date('Y-m-d', strtotime('+1 day', strtotime($nme_limit_day)));
                    } elseif (date('w', strtotime($nme_limit_day)) == 6) {
                        $nme_limit_day = date('Y-m-d', strtotime('+2 days', strtotime($nme_limit_day)));
                    }  
                    $cuota_mensualidad->limit_date = $nme_limit_day;
                    $cuota_mensualidad->quota_amount = $quota_mes; // se Multiplica el monto regular del concepto por 12, se aplica el descuento de acuerdo al plan(valor del dinero en el tiempo), y se aplica el descuento si aplica
                    $cuota_mensualidad->quota_payment_state = 0;

                    $regular_payment_date_mensualidad = date('Y', strtotime('+1 month', strtotime($regular_payment_date_mensualidad))) . '-' . date('m', strtotime('+1 month', strtotime($regular_payment_date_mensualidad))) . '-01';

                    $cuota_mensualidad->save();
                }
            }
            $matricula->enrollment_state = 1; //Ya estamos en Boleta de matricula
            $matricula->save();
            $msg = 'Se ha asignado el grupo ';
            return Redirect::action('MatriculaController@inicio')->with('message_matricula', $msg);
        }
    }

    public function registrar() {
        $input = Input::all();
        $matricula = Matricula::find($input['cod_enrollment']);
        $estudiante = Estudiante::find($matricula->cod_student);
        $cod_school_year = $input['cod_school_year'];
        $last_level = $estudiante->academica->level_course;
        $next_level = $last_level + 1;
        $grupos = Gruposcupos::whereRaw('cod_school_year=' . $cod_school_year . ' and cod_level=' . $next_level)->get();

        $next_grupos = Yeargroup::join('grupo', 'grupo.cod_grupo', '=', 'year_grupo.cod_grupo')
                        ->whereRaw('cod_school_year=' . $cod_school_year . ' and grupo.cod_level=' . $next_level)->get();
        return View::make('matricula.registrar')
                        ->with('estudiante', $estudiante)
                        ->with('matricula', $matricula)
                        ->with('next_grupos', $next_grupos)
                        ->with('grupos', $grupos);
    }

    public function editar() {
        
    }

}
