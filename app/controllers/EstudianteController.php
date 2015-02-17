<?php

class EstudianteController extends BaseController {

	public function inicio()
	{
		$estudiantes = Estudiante::join('user', 'user.cod_user', '=', 'student.cod_user')
			->where('cod_profile','==',7)->get();

		return View::make('estudiante.estudiante')->with('estudiantes', $estudiantes);
	}

	public function nuevo()
	{
		$grados 	= Grado::all();
		$familias 	= Familia::all();

		return View::make('estudiante.nuevo')
			->with('grados', $grados)
			->with('familias', $familias);
	}

	public function guardar()
	{
		$input = Input::all();

		$carnet 				= DB::table('student')->select('student_card')->orderBy('cod_student', 'desc')->first();
		$card 					= Util::card_generate($carnet->student_card, $input);
		$usuario 				= new Usuario;
		$usuario->user 			= $card;
		$usuario->cod_profile 	= 7;
		$usuario->save();

		if (!empty($input['familia']))
			$identity = $input['familia'];
		else
		{
			$identificador 	= DB::select('SELECT `family_identity` FROM `family` ORDER BY `cod_family` DESC LIMIT 1');
			$identity 		= Util::family_identifier($identificador[0]->family_identity, $input);
		}
		$familia 					= new Familia;
		$familia->family_identity 	= $identity;
		$familia->cod_user 			= $usuario->cod_user;
		$familia->save();

		$estudiante 					= new Estudiante;
		$estudiante->student_card 		= $card;
		$estudiante->student_photo 		= $input['foto'];
		$estudiante->cod_family 		= $familia->cod_family;
		$estudiante->first_name 		= Util::ascii_transponse($input['nombre1']);
		$estudiante->second_name 		= Util::ascii_transponse($input['nombre2']);
		$estudiante->first_last_name 	= Util::ascii_transponse($input['apellido1']);
		$estudiante->second_last_name 	= Util::ascii_transponse($input['apellido2']);
		$estudiante->student_gender 	= $input['genero'];
		$estudiante->birth_date 		= Util::time_generate($input['dia'],$input['mes'],$input['anyo']);
		$estudiante->birth_country 		= Util::ascii_transponse($input['nacimiento-pais']);
		$estudiante->birth_city 		= Util::ascii_transponse($input['nacimiento-ciudad']);
		$estudiante->city_live 			= Util::ascii_transponse($input['ciudad-casa']);
		$estudiante->neighborhood_live 	= Util::ascii_transponse($input['barrio']);
		$estudiante->address_detail 	= Util::ascii_transponse($input['dir']);
		$estudiante->house_number 		= $input['num-casa'];
		$estudiante->email 				= $input['correo'];
		$estudiante->student_state 		= 0;
		$estudiante->cod_user 			= $usuario->cod_user;
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

		return Redirect::action('EstudianteController@datosmatricula', array('id' => $estudiante->cod_student));
	}

	public function datosmatricula()
	{
		$input = Input::all();
		$grados = Grado::all();

		return View::make('estudiante.datos')
			->with('grados', $grados)
			->with('id', $input['id']);
	}

	public function editar()
	{
		$input 	 	= Input::all();
		$estudiante = Estudiante::find($input['id']);
		$grados 	= Grado::all();

		return View::make('estudiante.editar')
			->with('grados', $grados)
			->with('estudiante', $estudiante);
	}

	public function actulizar()
	{
		$input = Input::all();

		$estudiante 					= Estudiante::find($input['estudiante_id']);
		//$estudiante->student_card 		= $card;
		$estudiante->student_photo 		= $input['foto'];
		//$estudiante->cod_family 		= $familia->cod_family;
		$estudiante->first_name 		= Util::ascii_transponse($input['nombre1']);
		$estudiante->second_name 		= Util::ascii_transponse($input['nombre2']);
		$estudiante->first_last_name 	= Util::ascii_transponse($input['apellido1']);
		$estudiante->second_last_name 	= Util::ascii_transponse($input['apellido2']);
		$estudiante->student_gender 	= $input['genero'];
		$estudiante->birth_date 		= Util::time_generate($input['dia'],$input['mes'],$input['anyo']);
		$estudiante->birth_country 		= Util::ascii_transponse($input['nacimiento-pais']);
		$estudiante->birth_city 		= Util::ascii_transponse($input['nacimiento-ciudad']);
		$estudiante->city_live 			= Util::ascii_transponse($input['ciudad-casa']);
		$estudiante->neighborhood_live 	= Util::ascii_transponse($input['barrio']);
		$estudiante->address_detail 	= Util::ascii_transponse($input['dir']);
		$estudiante->house_number 		= $input['num-casa'];
		$estudiante->email 				= $input['correo'];
		$estudiante->student_state 		= 0;
		//$estudiante->cod_user 			= $usuario->cod_user;
		$estudiante->save();

                $academica = Academica::find($estudiante->academica->cod_academic_information);
		$academica->level_course				 = empty($input['grado'])?NULL:$input['grado'];
		$academica->studied_before 		 		 = empty($input['estudiado'])?NULL:$input['estudiado'];
		$academica->last_school			 		 = Util::ascii_transponse(empty($input['estudiado'])?NULL:$input['colegio']);
		$academica->city_last_school 		 	 = Util::ascii_transponse(empty($input['col-pais'])?NULL:$input['col-pais']);
		$academica->completed_grade 		 	 = Util::arrtostr(empty($input['cursos'])?NULL:$input['cursos']);
		$academica->reason_changing_school 		 = Util::arrtostr(empty($input['cambios'])?NULL:$input['cambios']);
		$academica->reason_chose_school	 		 = Util::arrtostr(empty($input['escogio'])?NULL:$input['escogio']);
		$academica->way_met_school		 		 = Util::arrtostr(empty($input['saber'])?NULL:$input['saber']);
		$academica->birth_certificate 	 		 = empty($input['partida'])?NULL:$input['partida'];
		$academica->good_standing 		 		 = empty($input['conducta'])?NULL:$input['conducta'];
		$academica->payment_solvency 		 	 = empty($input['solvencia'])?NULL:$input['solvencia'];
		$academica->school_grades 		 		 = Util::arrtostr(empty($input['cursos'])?NULL:$input['cursos']);
		$academica->insurance_student 	 		 = empty($input['seguro'])?NULL:$input['seguro'];
		$academica->tutor_compromise_signature 	 = empty($input['compromiso-tutor'])?NULL:$input['compromiso-tutor'];
		$academica->student_compromise_signature = empty($input['compromiso-estudiante'])?NULL:$input['compromiso-estudiante'];
		$academica->save();

		$administrativa = Administrativa::find($estudiante->administrativa->cod_admin_information);
		$administrativa->whom_student_live 			= empty($input['tutor'])?NULL:$input['tutor'];
		$administrativa->payment_responsable 		= empty($input['pago'])?NULL:$input['pago'];
		$administrativa->payment_plan_signature 	= empty($input['plan-pago'])?NULL:$input['plan-pago'];
		$administrativa->school_contract_signature 	= empty($input['contrato'])?NULL:$input['contrato'];
		$administrativa->transport_take 			= empty($input['transporte'])?NULL:$input['transporte'];
		$administrativa->save();

		$medica = Medica::find($estudiante->medica->cod_medical_information);
		$medica->common_allergie	 = Util::ascii_transponse(empty($input['alergia'])?NULL:$input['alergia']);
		$medica->medicine_allergie	 = Util::ascii_transponse(empty($input['medicamento'])?NULL:$input['medicamento']);
		$medica->physical_impediment = Util::ascii_transponse(empty($input['impedimento'])?NULL:$input['impedimento']);
		$medica->permanet_illness	 = Util::ascii_transponse(empty($input['enfermedad'])?NULL:$input['enfermedad']);
		$medica->emergency_call		 = empty($input['emergencia'])?NULL:$input['emergencia'];
		$medica->comment			 = Util::ascii_transponse(empty($input['comentario'])?NULL:$input['comentario']);
		$medica->save();

		return Redirect::action('EstudianteController@inicio');
	}

	public function deshabilitar()
	{
		$input = Input::all();

		$estudiante = Estudiante::find($input['id']);
		$estudiante->student_state = $input['val'];
		$estudiante->save();

		return Redirect::action('EstudianteController@inicio');
	}

	public function guardardatos()
	{
		$input = Input::all();

		$estudiante = Estudiante::find($input['estudiante_id']);
		$academica = Academica::find($estudiante->academica->cod_academic_information);
		$academica->level_course				 = empty($input['grado'])?NULL:$input['grado'];
		$academica->studied_before 		 		 = empty($input['estudiado'])?NULL:$input['estudiado'];
		$academica->last_school			 		 = Util::ascii_transponse(empty($input['estudiado'])?NULL:$input['estudiado']);
		$academica->city_last_school 		 	 = Util::ascii_transponse(empty($input['col-pais'])?NULL:$input['col-pais']);
		$academica->completed_grade 		 	 = Util::arrtostr(empty($input['cursos'])?NULL:$input['cursos']);
		$academica->reason_changing_school 		 = Util::arrtostr(empty($input['cambios'])?NULL:$input['cambios']);
		$academica->reason_chose_school	 		 = Util::arrtostr(empty($input['escogio'])?NULL:$input['escogio']);
		$academica->way_met_school		 		 = Util::arrtostr(empty($input['saber'])?NULL:$input['saber']);
		$academica->birth_certificate 	 		 = empty($input['partida'])?NULL:$input['partida'];
		$academica->good_standing 		 		 = empty($input['conducta'])?NULL:$input['conducta'];
		$academica->payment_solvency 		 	 = empty($input['solvencia'])?NULL:$input['solvencia'];
		$academica->school_grades 		 		 = Util::arrtostr(empty($input['cursos'])?NULL:$input['cursos']);
		$academica->insurance_student 	 		 = empty($input['seguro'])?NULL:$input['seguro'];
		$academica->tutor_compromise_signature 	 = empty($input['compromiso-tutor'])?NULL:$input['compromiso-tutor'];
		$academica->student_compromise_signature = empty($input['compromiso-estudiante'])?NULL:$input['compromiso-estudiante'];
		$academica->save();

		$administrativa = Administrativa::find($estudiante->administrativa->cod_admin_information);
		$administrativa->whom_student_live 			= empty($input['tutor'])?NULL:$input['tutor'];
		$administrativa->payment_responsable 		= empty($input['pago'])?NULL:$input['pago'];
		$administrativa->payment_plan_signature 	= empty($input['plan-pago'])?NULL:$input['plan-pago'];
		$administrativa->school_contract_signature 	= empty($input['contrato'])?NULL:$input['contrato'];
		$administrativa->transport_take 			= empty($input['transporte'])?NULL:$input['transporte'];
		$administrativa->save();

		$medica = Medica::find($estudiante->medica->cod_medical_information);
		$medica->common_allergie	 = Util::ascii_transponse(empty($input['alergia'])?NULL:$input['alergia']);
		$medica->medicine_allergie	 = Util::ascii_transponse(empty($input['medicamento'])?NULL:$input['medicamento']);
		$medica->physical_impediment = Util::ascii_transponse(empty($input['impedimento'])?NULL:$input['impedimento']);
		$medica->permanet_illness	 = Util::ascii_transponse(empty($input['enfermedad'])?NULL:$input['enfermedad']);
		$medica->emergency_call		 = empty($input['emergencia'])?NULL:$input['emergencia'];
		$medica->comment			 = Util::ascii_transponse(empty($input['comentario'])?NULL:$input['comentario']);
		$medica->save();

		$familia = Familia::where('cod_user', '=', $estudiante->cod_user)->get();
		return Redirect::action('FamiliaController@padrenuevo', array('familia_id' => $familia[0]->cod_family));
               // return Redirect::action('EstudianteController@inicio');
	}
}
