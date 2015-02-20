<?php

class FamiliaController extends BaseController {

    public function inicio() {
        $familias = Familia::all();

        return View::make('familia.familia')->with('familias', $familias);
    }

    public function agregar() {
        $grupos = Grado::all();

        return View::make('familia.agregar')->with('grupos', $grupos);
    }

    public function padrenuevo() {
        $cod = Input::all();
   
        return View::make('familia.padrenuevo')->with('familia_id', $cod['familia_id']);
    }


    public function tutoragregar() {
        $input = Input::all();
       
        $tutor = new DetalleFamilia;//los datos del tutor son los de family_detail
        $return = $input['return'];
        $tutor->cod_family = empty($input['familia_id']) ? NULL : $input['familia_id'];
        $tutor->relationship = empty($input['relacion']) ? NULL : $input['relacion'];
        $tutor->first_name = Util::ascii_transponse(empty($input['primer-nombre']) ? NULL : $input['primer-nombre']);
        $tutor->second_name = Util::ascii_transponse(empty($input['segundo-nombre']) ? NULL : $input['segundo-nombre']);
        $tutor->first_last_name = Util::ascii_transponse(empty($input['primer-apellido']) ? NULL : $input['primer-apellido']);
        $tutor->second_last_name = Util::ascii_transponse(empty($input['segundo-apellido']) ? NULL : $input['segundo-apellido']);
        $tutor->family_gender = empty($input['familia_id']) ? NULL : $input['familia_id'];
        $tutor->phone = empty($input['tel-convencional']) ? NULL : $input['tel-convencional'];
        $tutor->mobile = empty($input['tel-celular']) ? NULL : $input['tel-celular'];
        $tutor->other_phone = empty($input['tel-otro']) ? NULL : $input['tel-otro'];
        $tutor->email = empty($input['tutor-correo']) ? NULL : $input['tutor-correo'];
        $tutor->city_live = Util::ascii_transponse(empty($input['tutor-cuidad']) ? NULL : $input['tutor-cuidad']);
        $tutor->neighborhood_live = Util::ascii_transponse(empty($input['tutor-barrio']) ? NULL : $input['tutor-barrio']);
        $tutor->address_detail = Util::ascii_transponse(empty($input['tutor-dir']) ? NULL : $input['tutor-dir']);
        $tutor->house_number = empty($input['tutor-num-casa']) ? NULL : $input['tutor-num-casa'];
        $tutor->save();

        $trabajo = new Trabajo;
        $trabajo->cod_family_detail = $tutor->cod_family_detail;
        $trabajo->company_name = Util::ascii_transponse(empty($input['tutor-empresa']) ? NULL : $input['tutor-empresa']);
        $trabajo->company_owner = empty($input['propietario']) ? NULL : $input['propietario'];
        $trabajo->company_phone = empty($input['empresa-convencional']) ? NULL : $input['empresa-convencional'];
        $trabajo->phone_extension = empty($input['empresa-extension']) ? NULL : $input['empresa-extension'];
        $trabajo->company_position = Util::ascii_transponse(empty($input['cargo']) ? NULL : $input['cargo']);
        $trabajo->company_mobile = empty($input['empresa-celular']) ? NULL : $input['empresa-celular'];
        $trabajo->company_email = empty($input['tutor-correo']) ? NULL : $input['tutor-correo'];
        $trabajo->save();

        if($return=='true'){
            return Redirect::action('FamiliaController@padrenuevo', array('familia_id' => $input['familia_id']));
        }else{
            return Redirect::action('EstudianteController@inicio');
        }
        
        
        
    }

}
