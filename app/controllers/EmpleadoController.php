<?php

class EmpleadoController extends BaseController {

    public function inicio() {
         if (Auth::check()) {            
        } else {
           return Redirect::to('login')->with('message', '<i class="glyphicon glyphicon-info-sign"></i> <strong>Denegado</strong>, debe ser usuario');
                 
        }
        $cargos = Cargo::all();
        $empleados = Empleado::all();
        return View::make('empleado.empleado')
                        ->with('empleados', $empleados)
                        ->with('cargos', $cargos);
    }

    public function editar() {
        $input = Input::all();
        $cargos = Cargo::all();
        if (isset($input['cod_employee'])) {
            $empleado = Empleado::find($input['cod_employee']);
        } else {
            $empleado = New Empleado;
        }
        return View::make('empleado.editar')
                        ->with('empleado', $empleado)
                        ->with('cargos', $cargos);
    }

    public function NewOrEdit() {
        $input = Input::all();
        $isNew = 1;
         $cod_profile = 6; 
        if (isset($input['cod_employee'])) {
            $empleado = Empleado::find($input['cod_employee']);
            $isNew = 0;
        } else {
            //SI es nuevo se creará un usuario primero
            $usuario = New Usuario();
            $usuario->user = $input["cedula"];
            $usuario->password = Util::RandomString(7, 1, 1, 0); //
            //perfiles: admin, director, secretaria, coordinador, docente guía, docente, estudiante, tutor
            $cargos = Cargo::all();
            foreach ($cargos as $cod_cargo => $cargo) {
                $cargosarray[$cargo->cod_employment] = $cargo->employment_name;
            }
           //perfil del docente; es el perfil del empleado más común a insertar     
            if (preg_match('/coordin/i', $cargosarray[$input['cargo']])) {
                $cod_profile = 4; //perfil del coordinador
            }
            if (preg_match('/secret/i', $cargosarray[$input['cargo']])) {
                $cod_profile = 3; //perfil del secreatri@ acádemico   
            }
            if (preg_match('/director/i', $cargosarray[$input['cargo']])) {
                $cod_profile = 2; //perfil del director
            }
            $usuario->cod_profile = $cod_profile; //Código de perfil para el usuario que se va a crear
            $usuario->save();
            $empleado = new Empleado;
            $empleado->cod_user = $usuario->cod_user; //Despues de crearse el usuario se asigna al cod_user del empleado
            $empleado->cod_employment = $input['cargo'];
        }

        $empleado->cedula = $input['cedula'];
        $empleado->first_name = $input['primernombre'];
        $empleado->second_name = $input['segundonombre'];
        $empleado->first_last_name = $input['primerapellido'];
        $empleado->second_last_name = $input['segundoapellido'];
        $empleado->employee_gender = $input['genero'];
        $empleado->city_live = $input['ciudad'];
        $empleado->neighborhood_live = $input['barrio'];
        $empleado->address_detail = $input['direccion'];
        $empleado->house_number = $input['numerocasa'];
        $empleado->phone = $input['telefono'];
        $empleado->mobile = $input['celular'];
        $empleado->other_phone = $input['otrotelefono'];
        $empleado->email = $input['email'];
        $empleado->institutional_email = $input["emailempresarial"];
        $empleado->degree = $input['nivelestudios'];
        $empleado->employee_state = 0; //Estado por defecto del empleado: activo
        $empleado->save();
        if ($cod_profile == 6 && $isNew == 1) {//si se mantienen el perfil de docente se agrega a la tabla teacher
            $docente = New Docente;
            $docente->cod_employee = $empleado->cod_employee;
            //falta establecer los campos de edit_note && limit_edit_note
            $docente->save();
        }
         $msg = 'Se ha registrado correctamente un nuevo empleado al sistema :: <b>' . $empleado->EmployeeName . '</b>';
        if (isset($input['cod_employee'])) {
            $msg = 'Empleado <b>'.$empleado->EmployeeName.'</b> :: Se han guardado correctamente los cambios realizados.';
        }
        return Redirect::action('EmpleadoController@inicio',array('#employees'))->with('message_employee',$msg);
    }

}
