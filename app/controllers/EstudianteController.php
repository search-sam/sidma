<?php

class EstudianteController extends BaseController {

    public function inicio() {
        if (Auth::check()) {
            
        } else {
            return Redirect::to('login')->with('message', '<i class="glyphicon glyphicon-info-sign"></i> <strong>Denegado</strong>, debe ser usuario');
        }
        $estudiantes = Estudiante::all();

        return View::make('estudiante.estudiante')->with('estudiantes', $estudiantes);
    }

    public function new_receipt() {
        $input = Input::all();
        $recibo = New Recibo;
        $amount_to_pay = $input['amount_to_pay'];
        $recibo->date_receipt = date('Y-m-d H:i:s');
        $recibo->cod_student = $input['cod_student'];
        $recibo->payer_name = $input['payer_name'];
        $recibo->cod_payment_method = $input['payment_method'];
        $recibo->amount_usd = $input['amount_usd'];
        $recibo->amount_cor = $input['amount_cor'];
        $recibo->usd_rate = $input['usd_rate'];
        $recibo->total_amount_usd = $input['total_amount_usd'];
        $recibo->save();
        if(doubleval($amount_to_pay)<doubleval($recibo->total_amount_usd)){// hay vuelto      
            //tablas de change_receipt
            //cod_receipt, change_usd, change_cor, change_state
            $change_receipt = new Vueltorecibo;
            $tipo_moneda = $input['tipo_moneda'];
            $tipo_moneda = explode('/',$tipo_moneda);
            $type_coin = $tipo_moneda[0];
            $change = doubleval($tipo_moneda[1])*(-1);
              $change_receipt->cod_receipt = $recibo->cod_receipt;
            if($type_coin=='left_usd'){                
                $change_receipt->change_usd = $change;
            }else{
                 $change_receipt->change_cor = $change;
            }
            $change_receipt->save();
            
        }
        echo $recibo->cod_receipt;
    }

    public function new_payment() {// detalle del recibo
        $input = Input::all();
        $all_quotas_canceled = 1;
        $pagocuota = new Pagocuota();
        $pagocuota->cod_receipt = $input['cod_receipt'];
        $pagocuota->cod_quota_payment = $input['cod_quota_payment'];
        $pagocuota->payment_amount = $input['payment_amount']; //monto pagado en usd
        $pagocuota->save();
        //Modificamos el estado de la  cuota en sun plan de pago
        if ($pagocuota->payment_amount > 0) {
            if ($pagocuota->cuota->quota_amount == $pagocuota->payment_amount) {
                $pagocuota->cuota->quota_payment_state = 2; //Pagado
                $pagocuota->cuota->save();
            } else {
                $pagocuota->cuota->quota_payment_state = 1; //Abonado
                $pagocuota->cuota->save();
            }
            //Hay qu modificar el estado de plan de pago de ser necesario
            // Se modifica a estado 1 si y solo si todas sus cuotas tienen estado 2 o 3(Anulado);
            foreach ($pagocuota->cuota->estudianteplandepago->cuotas as $cod_quota => $cuota) {
                if ($cuota->quota_payment_state == 2 || $cuota->quota_payment_state == 3) {
                    
                } else {
                    $all_quotas_canceled = 0;
                    break;
                }
            }
            if ($all_quotas_canceled == 1) {
                $pagocuota->cuota->estudianteplandepago->state = 1;
                $pagocuota->cuota->estudianteplandepago->save();
                if ($pagocuota->cuota->estudianteplandepago->yearconcepto->conceptodepago->cod_concept == 3) {//3 es el concepto matricula
                    //debemos actualizar el estado de enrollment a matriculado
                    $boleta_matricula = Matricula::InBolet($pagocuota->cuota->estudianteplandepago->estudiante->cod_student);
                    $boleta_matricula->enrollment_state = 4; //4 es el codigo de matriculado
                    $boleta_matricula->save();
                    //Ahora hay que crearle el carnet al estudiante 
                    $apellidos = array();
                    $apellidos['apellido1'] = $pagocuota->cuota->estudianteplandepago->estudiante->first_last_name;
                    $apellidos['apellido2'] = $pagocuota->cuota->estudianteplandepago->estudiante->second_last_name;
                    $apellido2 = empty($apellidos['apellido2'][0]) ? 'X' : $apellidos['apellido2'][0];
                    $identificador = date('Y') . '-' . ucfirst($apellidos['apellido1'][0]) . ucfirst($apellido2) . '0' . '0' . '1';
                    $last_student_card = Estudiante::where('student_card', 'like', '%' . $identificador . '%')->orderBy('student_card', 'desc')->first();
                    $estudiante_identificador = is_null($last_student_card) ? null : $last_student_card->student_card;
                    $student_card = Util::card_generate($estudiante_identificador, $apellidos);
                    $cuota->estudianteplandepago->estudiante->student_card = $student_card;
                    $cuota->estudianteplandepago->estudiante->save();
                }
            }
        }
    }

    public function detalleplandepago() {
        $input = Input::all();
        $estudiante_plandepago = EstudiantePlandepago::find($input['cod_student_payment_plan']);
        $cuotas = Saldocuota::where('cod_student_payment_plan', $estudiante_plandepago->cod_student_payment_plan)->orderBy('quota', 'asc')->get();
        return View::make('estudiante.detalleplandepago')
                        ->with('estudiante_plandepago', $estudiante_plandepago)
                        ->with('cuotas', $cuotas);
    }

    public function docontinue() {
        return View::make('estudiante.docontinue');
    }

    public function doasignfamily() {
        return View::make('estudiante.doasignfamily');
    }

    public function nuevo() {
        $grados = Grado::all();
        $familias = Familia::all();

        return View::make('estudiante.nuevo')
                        ->with('grados', $grados)
                        ->with('familias', $familias);
    }

    public function generateenrollment() {
        $input = Input::all();
        $cod_student = $input['cod_student'];
        return view::make('estudiante.generateenrollment')
                        ->with('cod_student', $cod_student);
    }

    public function documents() {
        $input = Input::all();
        $cod_student = $input['cod_student'];
        $estudiante = Estudiante::find($cod_student);
        $documentos = array();
        //Partida de nacimiento, Certificado de conducta, Solvencia de pago, Seguro escolar, Compromiso del tutor, Compromiso del estudiante, 
        $documentos['Partida de nacimiento'] = $estudiante->academica->birth_certificate;
        $documentos['Certificado de conducta'] = $estudiante->academica->good_standing;
        $documentos['Solvencia de pago'] = $estudiante->academica->payment_solvency;
        $documentos['Seguro escolar'] = $estudiante->academica->insurance_student;
        $documentos['Compromiso del tutor'] = $estudiante->academica->tutor_compromise_signature;
        $documentos['Compromiso del estudiante'] = $estudiante->academica->student_compromise_signature;
        echo "<div class='modal-dialog'>";
        echo "<div class='modal-content'>";
        echo "<div class='panel-body'>";
        foreach ($documentos as $documento => $state) {
            $class_i = ($state == 1) ? "info-sign" : "warning-sign";
            $class_alert = ($state == 1) ? "success" : "danger";
            echo "<div class='alert alert-$class_alert'>";
            echo "<h5><i class='glyphicon glyphicon-$class_i'></i> <strong>$documento</strong></5>";
            echo "</div>";
        }
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    public function createenrollment() {
        
    }

    public function guardar() {
        $input = Input::all();
        //hasta este momento no se debe generar un usuario al estudiante ps no esta matriculado aun
        //el query de $carnet solo manda el primer registro de la tabla estudiante siempre va a ser el mismo
        //$carnet = DB::table('student')->select('student_card')->orderBy('cod_student', 'desc')->first();
        //$last_student_card = Estudiante::all()->last()->student_card;
        //$card = Util::card_generate($last_student_card, $input);
        $cod_family = $input['cod_family'];
        $newfamily = 0;
        if ($cod_family == 0) {//si es una nueva familia se crea un usuario de familia
            //SE GENERA EL USUARIO PARA FAMILIA
            $apellido2 = empty($input['apellido2']) ? 'X' : $input['apellido2'][0];
            $identificador = date('Y') . '-F' . ucfirst($input['apellido1'][0]) . ucfirst($apellido2) . '0' . '0' . '1';
            $last_family_identity = Familia::where('family_identity', 'like', '%' . $identificador . '%')->orderBy('family_identity', 'desc')->first();
            $familia_identificador = is_null($last_family_identity) ? null : $last_family_identity->family_identity;
            $family_identity = Util::family_identifier($familia_identificador, $input);
            $usuario = new Usuario;
            $usuario->user = $family_identity;
            $usuario->password = Util::RandomString(7, 1, 1, 0);
            $usuario->cod_profile = 8;
            $usuario->save();
            //
            $familia = new Familia;
            $familia->cod_user = $usuario->cod_user;

            $familia->family_identity = $family_identity;
            $familia->save();
            $cod_family = $familia->cod_family;
            $newfamily = 1;
        }



        $estudiante = new Estudiante;
        // $estudiante->student_card = $card;
        // $estudiante->student_photo = $input['foto'];
        $estudiante->cod_family = $cod_family;
        $estudiante->first_name = Util::ascii_transponse($input['nombre1']);
        $estudiante->second_name = Util::ascii_transponse($input['nombre2']);
        $estudiante->first_last_name = Util::ascii_transponse($input['apellido1']);
        $estudiante->second_last_name = Util::ascii_transponse($input['apellido2']);
        $estudiante->student_gender = $input['genero'];
        $estudiante->birth_date = Util::time_generate($input['dia'], $input['mes'], $input['anyo']);
        $estudiante->birth_country = Util::ascii_transponse($input['nacimiento-pais']);
        $estudiante->birth_city = Util::ascii_transponse($input['nacimiento-ciudad']);
        $estudiante->city_live = Util::ascii_transponse($input['ciudad-casa']);
        $estudiante->neighborhood_live = Util::ascii_transponse($input['barrio']);
        $estudiante->address_detail = Util::ascii_transponse($input['dir']);
        $estudiante->house_number = $input['num-casa'];
        $estudiante->email = $input['correo'];
        $estudiante->student_state = 0;
        //$estudiante->cod_user = $usuario->cod_user;
        $estudiante->save();

        $academica = new Academica;
        $academica->cod_student = $estudiante->cod_student;
        $academica->save();

        $administrativa = new Administrativa;
        $administrativa->cod_student = $estudiante->cod_student;
        $administrativa->save();

        $medica = new Medica;
        $medica->cod_student = $estudiante->cod_student;
        $medica->save();

        $msg = '<b>Paso 1</b>: Se ha registrado correctamente un nuevo estudiante al sistema :: <b>' . $estudiante->first_name . ' ' . $estudiante->first_last_name . '</b>. Complete la siguiente información.';
        return Redirect::action('EstudianteController@datosmatricula', array('id' => $estudiante->cod_student, 'cod_family' => $cod_family, 'newfamily' => $newfamily))->with('message_student', $msg);
    }

    public function datosmatricula() {
        $input = Input::all();
        $grados = Grado::all();
        $cod_family = $input['cod_family'];
        $newfamily = $input['newfamily'];
        $year = new Year;
        $estudiante = Estudiante::find($input['id']);
        $year_payment_plans = YearPlandepago::where('cod_school_year', $year->vigente()->cod_school_year)->get();
        $year_discounts = YearDescuento::where('cod_school_year', $year->vigente()->cod_school_year)->get();
        return View::make('estudiante.datos')
                        ->with('grados', $grados)
                        ->with('id', $input['id'])
                        ->with('cod_family', $cod_family)
                        ->with('newfamily', $newfamily)
                        ->with('year_payment_plans', $year_payment_plans)
                        ->with('year_discounts', $year_discounts)
                        ->with('estudiante', $estudiante);
    }

    public function editar() {
        $input = Input::all();
        $estudiante = Estudiante::find($input['id']);
        $grados = Grado::all();
        $year = new Year;
        $cod_school_year = $year->vigente()->cod_school_year;
        $year_payment_plans = YearPlandepago::where('cod_school_year', $cod_school_year)->get();
        $year_discounts = YearDescuento::where('cod_school_year', $cod_school_year)->get();


        return View::make('estudiante.editar')
                        ->with('grados', $grados)
                        ->with('estudiante', $estudiante)
                        ->with('year_payment_plans', $year_payment_plans)
                        ->with('year_discounts', $year_discounts)
                        ->with('cod_school_year', $cod_school_year);
    }

    public function actulizar() {
        $input = Input::all();
        $year = new Year;
        $cod_school_year = $year->vigente()->cod_school_year;
        $estudiante = Estudiante::find($input['estudiante_id']);
        //$estudiante->student_card 		= $card;
        //$estudiante->student_photo = $input['foto'];
        //$estudiante->cod_family 		= $familia->cod_family;
        $estudiante->first_name = Util::ascii_transponse($input['nombre1']);
        $estudiante->second_name = Util::ascii_transponse($input['nombre2']);
        $estudiante->first_last_name = Util::ascii_transponse($input['apellido1']);
        $estudiante->second_last_name = Util::ascii_transponse($input['apellido2']);
        $estudiante->student_gender = $input['genero'];
        $estudiante->birth_date = Util::time_generate($input['dia'], $input['mes'], $input['anyo']);
        $estudiante->birth_country = Util::ascii_transponse($input['nacimiento-pais']);
        $estudiante->birth_city = Util::ascii_transponse($input['nacimiento-ciudad']);
        $estudiante->city_live = Util::ascii_transponse($input['ciudad-casa']);
        $estudiante->neighborhood_live = Util::ascii_transponse($input['barrio']);
        $estudiante->address_detail = Util::ascii_transponse($input['dir']);
        $estudiante->house_number = $input['num-casa'];
        $estudiante->email = $input['correo'];
        $estudiante->student_state = 0;
        $estudiante->save();



        $academica = Academica::find($estudiante->academica->cod_academic_information);
        $academica->level_course = empty($input['grado']) ? NULL : $input['grado'];
        $academica->studied_before = empty($input['estudiado']) ? NULL : $input['estudiado'];
        $academica->last_school = Util::ascii_transponse(empty($input['estudiado']) ? NULL : $input['colegio']);
        $academica->city_last_school = Util::ascii_transponse(empty($input['col-pais']) ? NULL : $input['col-pais']);
        $academica->completed_grade = Util::arrtostr(empty($input['cursos']) ? NULL : $input['cursos']);
        $academica->reason_changing_school = Util::arrtostr(empty($input['cambios']) ? NULL : $input['cambios']);
        $academica->reason_chose_school = Util::arrtostr(empty($input['escogio']) ? NULL : $input['escogio']);
        $academica->way_met_school = Util::arrtostr(empty($input['saber']) ? NULL : $input['saber']);
        $academica->birth_certificate = empty($input['partida']) ? NULL : $input['partida'];
        $academica->good_standing = empty($input['conducta']) ? NULL : $input['conducta'];
        $academica->payment_solvency = empty($input['solvencia']) ? NULL : $input['solvencia'];
        $academica->school_grades = Util::arrtostr(empty($input['cursos']) ? NULL : $input['cursos']);
        $academica->insurance_student = empty($input['seguro']) ? NULL : $input['seguro'];
        $academica->tutor_compromise_signature = empty($input['compromiso-tutor']) ? NULL : $input['compromiso-tutor'];
        $academica->student_compromise_signature = empty($input['compromiso-estudiante']) ? NULL : $input['compromiso-estudiante'];
        $academica->save();

        $administrativa = Administrativa::find($estudiante->administrativa->cod_admin_information);
        $administrativa->whom_student_live = $input['tutor'];
        $administrativa->payment_responsable = $input['pago'];
        $administrativa->payment_plan_signature = empty($input['plan-pago']) ? NULL : $input['plan-pago'];
        $administrativa->school_contract_signature = empty($input['contrato']) ? NULL : $input['contrato'];
        $administrativa->transport_take = empty($input['transporte']) ? NULL : $input['transporte'];
        if ($input['tutor'] == 5) {
            $administrativa->other_tutor = trim($input['tutorinput']);
        }
        if ($input['pago'] == 5) {
            $administrativa->other_payment_responsable = trim($input['pagoinput']);
        }
        $administrativa->save();

        $medica = Medica::find($estudiante->medica->cod_medical_information);
        $medica->common_allergie = Util::ascii_transponse(empty($input['alergia']) ? NULL : $input['alergia']);
        $medica->medicine_allergie = Util::ascii_transponse(empty($input['medicamento']) ? NULL : $input['medicamento']);
        $medica->physical_impediment = Util::ascii_transponse(empty($input['impedimento']) ? NULL : $input['impedimento']);
        $medica->permanet_illness = Util::ascii_transponse(empty($input['enfermedad']) ? NULL : $input['enfermedad']);
        $medica->emergency_call = empty($input['emergencia']) ? NULL : $input['emergencia'];
        $medica->comment = Util::ascii_transponse(empty($input['comentario']) ? NULL : $input['comentario']);
        $medica->save();

        if (!empty($input['myplandepago'])) {
            if (empty($input['cod_student_payment_plan'])) {//aqui no se han ingresado el plan de pago de mensualidad y matricula
                $estudiante_plan_mensualidad = new EstudiantePlandepago;
                $estudiante_plan_matricula = new EstudiantePlandepago;
                $cod_concept_month = YearConcepto::whereRaw('cod_concept=4 AND cod_school_year=' . $cod_school_year)->first()->cod_year_payment_concept;
                $cod_concept_enrollment = YearConcepto::whereRaw('cod_concept=3 AND cod_school_year=' . $cod_school_year)->first()->cod_year_payment_concept;
                $cod_year_payment_plan_0 = YearPlandepago::whereRaw('cod_payment_plan=1 AND cod_school_year=' . $cod_school_year)->first()->cod_year_payment_plan;

                $estudiante_plan_mensualidad->cod_student = $estudiante->cod_student;
                $estudiante_plan_mensualidad->cod_year_payment_concept = $cod_concept_month;
                $estudiante_plan_mensualidad->cod_year_payment_plan = $input['plandepago'];
                $estudiante_plan_mensualidad->cod_school_year = $cod_school_year;

                $estudiante_plan_matricula->cod_student = $estudiante->cod_student;
                $estudiante_plan_matricula->cod_year_payment_concept = $cod_concept_enrollment;
                $estudiante_plan_matricula->cod_year_payment_plan = $cod_year_payment_plan_0;
                $estudiante_plan_matricula->cod_school_year = $cod_school_year;
            } else {
                $cod_concept_enrollment = YearConcepto::whereRaw('cod_concept=3 AND cod_school_year=' . $cod_school_year)->first()->cod_year_payment_concept;

                $estudiante_plan_mensualidad = EstudiantePlandepago::find($input['cod_student_payment_plan']);
                $estudiante_plan_matricula = EstudiantePlandepago::where('cod_student', $estudiante->cod_student)->where('cod_year_payment_concept', $cod_concept_enrollment)->first();
            }
            $estudiante_plan_mensualidad->cod_payment_method = $input['metododepago'];

            $estudiante_plan_mensualidad->cod_year_discount = $input['descuento'];
            $estudiante_plan_mensualidad->limit_payment_days = $input['limitedias'];
            $estudiante_plan_mensualidad->begin_payment_month = $input['iniciames'];

            $estudiante_plan_matricula->cod_payment_method = 1;
            $estudiante_plan_matricula->cod_year_discount = $input['descuento'];
            $estudiante_plan_matricula->limit_payment_days = $input['limitedias'];
            $estudiante_plan_matricula->begin_payment_month = $input['iniciames'];

            $estudiante_plan_matricula->save();
            $estudiante_plan_mensualidad->save();
            //Se debe ingresar a la tabla de enrollment
            //enrollment_date, cod_student, enrollment_type, cod_year_grupo, enrollment_state
            if ($estudiante->matriculas()->leftJoin('year_grupo', 'enrollment.cod_year_grupo', '=', 'year_grupo.cod_year_grupo', function($q) {
                        return $q->where('cod_school_year', $year->vigente()->cod_school_year)->orWhere('enrollment_state', 0);
                    })->count() == 0) {
                //cod_student, cod_year_grupo, enrollment_date, enrollment_state, enrollment_type;
                //enrollment_state = 0, Registro previo;enrollment type is null
                $matricula = new Matricula;
                $matricula->cod_student = $estudiante->cod_student;
                $matricula->enrollment_date = date('Y-m-d H:i:s');
                $matricula->enrollment_state = 0; //Registro previo
                $matricula->save();
            }
        }

        $msg = 'Estudiante <b>' . $estudiante->first_name . ' ' . $estudiante->first_last_name . '</b> :: Se han guardado correctamente los cambios realizados';

        return Redirect::action('EstudianteController@inicio')->with('message_student', $msg);
    }

    public function deshabilitar() {
        $input = Input::all();

        $estudiante = Estudiante::find($input['id']);
        $estudiante->student_state = $input['val'];
        $estudiante->save();

        return Redirect::action('EstudianteController@inicio');
    }

    public function guardardatos() {
        $input = Input::all();

        $estudiante = Estudiante::find($input['estudiante_id']);
        $academica = Academica::find($estudiante->academica->cod_academic_information);
        $academica->level_course = empty($input['grado']) ? NULL : $input['grado'];
        $academica->studied_before = empty($input['estudiado']) ? NULL : $input['estudiado'];
        $academica->last_school = Util::ascii_transponse(empty($input['estudiado']) ? NULL : $input['colegio']);
        $academica->city_last_school = Util::ascii_transponse(empty($input['col-pais']) ? NULL : $input['col-pais']);
        $academica->completed_grade = Util::arrtostr(empty($input['cursos']) ? NULL : $input['cursos']);
        $academica->reason_changing_school = Util::arrtostr(empty($input['cambios']) ? NULL : $input['cambios']);
        $academica->reason_chose_school = Util::arrtostr(empty($input['escogio']) ? NULL : $input['escogio']);
        $academica->way_met_school = Util::arrtostr(empty($input['saber']) ? NULL : $input['saber']);
        $academica->birth_certificate = empty($input['partida']) ? NULL : $input['partida'];
        $academica->good_standing = empty($input['conducta']) ? NULL : $input['conducta'];
        $academica->payment_solvency = empty($input['solvencia']) ? NULL : $input['solvencia'];
        $academica->school_grades = Util::arrtostr(empty($input['cursos']) ? NULL : $input['cursos']);
        $academica->insurance_student = empty($input['seguro']) ? NULL : $input['seguro'];
        $academica->tutor_compromise_signature = empty($input['compromiso-tutor']) ? NULL : $input['compromiso-tutor'];
        $academica->student_compromise_signature = empty($input['compromiso-estudiante']) ? NULL : $input['compromiso-estudiante'];
        $academica->save();

        $administrativa = Administrativa::find($estudiante->administrativa->cod_admin_information);
        $administrativa->whom_student_live = empty($input['tutor']) ? NULL : $input['tutor'];
        $administrativa->payment_responsable = empty($input['pago']) ? NULL : $input['pago'];
        $administrativa->payment_plan_signature = empty($input['plan-pago']) ? NULL : $input['plan-pago'];
        $administrativa->school_contract_signature = empty($input['contrato']) ? NULL : $input['contrato'];
        $administrativa->transport_take = empty($input['transporte']) ? NULL : $input['transporte'];
        $administrativa->save();

        $medica = Medica::find($estudiante->medica->cod_medical_information);
        $medica->common_allergie = Util::ascii_transponse(empty($input['alergia']) ? NULL : $input['alergia']);
        $medica->medicine_allergie = Util::ascii_transponse(empty($input['medicamento']) ? NULL : $input['medicamento']);
        $medica->physical_impediment = Util::ascii_transponse(empty($input['impedimento']) ? NULL : $input['impedimento']);
        $medica->permanet_illness = Util::ascii_transponse(empty($input['enfermedad']) ? NULL : $input['enfermedad']);
        $medica->emergency_call = empty($input['emergencia']) ? NULL : $input['emergencia'];
        $medica->comment = Util::ascii_transponse(empty($input['comentario']) ? NULL : $input['comentario']);
        $medica->save();
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////        PLAN DE PAGO    //////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////
        if (isset($input['plandepago'])) {
            if ($input['plandepago'] != 0) {// si el cod_payment_plan es disitinto de 0
                // Obtenemos el año vigente
                $year = new Year;
                $cod_school_year = $year->vigente()->cod_school_year;
                //cod_student, cod_year_payment_plan, cod_year_payment_concept, cod_year_discount, cod_payment_method, begin_payment_month, limit_payment_days, cod_school_year
                $cod_year_payment_plan = $input['plandepago'];
                $cod_year_payment_plan_0 = YearPlandepago::whereRaw('cod_payment_plan=1 AND cod_school_year=' . $cod_school_year)->first()->cod_year_payment_plan;
                $cod_year_discount = $input['descuento'];
                $begin_payment_month = $input['iniciames'];
                $limit_payment_days = $input['limitedias'];
                $cod_payment_method = $input['metododepago']; //por defecto es 1 para efectivo
                //cod_concept 3 por defecto de matricula; cod_concept 4 por defecto de Mensualidad
                //Hay que obtener el cod_year_payment_concept de matricula y mensualidad
                $cod_concept_enrollment = YearConcepto::whereRaw('cod_concept=3 AND cod_school_year=' . $cod_school_year)->first()->cod_year_payment_concept;
                $cod_concept_month = YearConcepto::whereRaw('cod_concept=4 AND cod_school_year=' . $cod_school_year)->first()->cod_year_payment_concept;
                //Se ingresa automaticamente el concepto de matricula con el plan 0
                ///////////////////////////////////////////////////////////////////////////////////////////////////////
                $estudiante_plan_matricula = new EstudiantePlandepago;
                $estudiante_plan_mensualidad = new EstudiantePlandepago;
                ///////////////////////////////////////////////////////////////////////////////////////////////////////
                $estudiante_plan_matricula->cod_student = $estudiante->cod_student;
                $estudiante_plan_mensualidad->cod_student = $estudiante->cod_student;

                $estudiante_plan_matricula->cod_year_payment_plan = $cod_year_payment_plan_0;
                $estudiante_plan_mensualidad->cod_year_payment_plan = $cod_year_payment_plan;

                $estudiante_plan_matricula->cod_year_payment_concept = $cod_concept_enrollment;
                $estudiante_plan_mensualidad->cod_year_payment_concept = $cod_concept_month;

                $estudiante_plan_matricula->cod_year_discount = $cod_year_discount;
                $estudiante_plan_mensualidad->cod_year_discount = $cod_year_discount;

                $estudiante_plan_matricula->cod_payment_method = 1; // Efectivo por default;
                $estudiante_plan_mensualidad->cod_payment_method = $cod_payment_method;

                $estudiante_plan_matricula->begin_payment_month = $begin_payment_month;
                $estudiante_plan_mensualidad->begin_payment_month = $begin_payment_month;

                $estudiante_plan_matricula->limit_payment_days = $limit_payment_days;
                $estudiante_plan_mensualidad->limit_payment_days = $limit_payment_days;

                $estudiante_plan_matricula->cod_school_year = $cod_school_year; // Efectivo por default;
                $estudiante_plan_mensualidad->cod_school_year = $cod_school_year;
                //$year->vigente()->planesdepago;
                //Hay que verificar si ya existen los registros de este estudiante con la matricula y la mensualidad
                if (count(EstudiantePlandepago::whereRaw('cod_student=' . $estudiante->cod_student . ' AND cod_year_payment_concept=' . $cod_concept_enrollment)->first()) == 0) {
                    $estudiante_plan_matricula->save();
                }
                if (count(EstudiantePlandepago::whereRaw('cod_student=' . $estudiante->cod_student . ' AND cod_year_payment_concept=' . $cod_concept_month)->first()) == 0) {
                    $estudiante_plan_mensualidad->save();
                }
                if ($estudiante->matriculas()->leftJoin('year_grupo', 'enrollment.cod_year_grupo', '=', 'year_grupo.cod_year_grupo', function($q) {
                            return $q->where('cod_school_year', $year->vigente()->cod_school_year)->orWhere('enrollment_state', 0);
                        })->count() == 0) {
                    //cod_student, cod_year_grupo, enrollment_date, enrollment_state, enrollment_type;
                    //enrollment_state = 0, Registro previo;enrollment type is null
                    $matricula = new Matricula;
                    $matricula->cod_student = $estudiante->cod_student;
                    $matricula->enrollment_date = date('Y-m-d H:i:s');
                    $matricula->enrollment_state = 0; //Registro previo
                    $matricula->save();
                }
                //Se debe generar las cuotas de cada plan concepto Matricula y Mensualidad
                //cod_student_payment_plan, quota=i++, regular_payment_date, limit_day, quota_amount, quota_payment_state
            }
        }
        $cod_family = $input['cod_family'];
        $newfamily = $input['newfamily'];
        $msg = 'Se ha registrado correctamente un nuevo estudiante al sistema :: <b>' . $estudiante->first_name . ' ' . $estudiante->first_last_name . '</b>';
        $msg2 = '<b>Paso 2</b>: Se ha registrado correctamente la información académica, administrativa y médica de <b>' . $estudiante->first_name . ' ' . $estudiante->first_last_name . '</b> :: Complete la siguiente información (Familia).';

        if ($newfamily == 1) {//Si el estudiante nos da una nueva familia
            return Redirect::action('FamiliaController@padrenuevo', array('familia_id' => $cod_family, 'cod_student' => $estudiante->cod_student))->with('message_student', $msg2);
        } else {
            return Redirect::action('EstudianteController@inicio')->with('message_student', $msg);
        }
    }

}
