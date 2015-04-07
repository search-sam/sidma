<?php

class GrupoController extends BaseController {

    public function inicio() {
        $grupos = Grupo::all();
        return View::make('admonacademica.admoncademica')->with('grupos', $grupos);
    }

    public function agregar() {
        $input = Input::all();
        $classroom = Classroom::find($input['cod_classroom']);
        $niveles = Nivel::all();
        return View::make('grupo.agregar')->with('classroom', $classroom)
                        ->with('niveles', $niveles);
    }

    public function reasignar() {
        $input = Input::all();
        $grupo = Grupo::find($input['cod_grupo']);
        return View::make('grupo.reasignar')->with('grupo', $grupo);
    }

    public function neworedit() {
        $input = Input::all();
        $cod_school_year = $input['cod_school_year'];
        if (isset($input['cod_year_grupo'])) {
            $yeargrupo = Yeargroup::find($input['cod_year_grupo']);
        } else {
            $yeargrupo = new Yeargroup;
            $yeargrupo->cod_grupo = $input['grupo'];
            $yeargrupo->cod_school_year = $cod_school_year;
        }
        $yeargrupo->cod_teacher = $input['docente'];
        $yeargrupo->cod_shift = $input['turno'];
        $yeargrupo->save();
        $msg = 'Se ha registrado correctamente una nueva grupo al año académico vigente del sistema :: <b>' . Grupo::find($yeargrupo->cod_grupo)->grupo_name . '</b>';
        if (isset($input['cod_year_grupo'])) {
            $msg = 'Grupo <b>' . Nivel::find((Grupo::find($yeargrupo->cod_grupo)->cod_level))->level_name . '' . Grupo::find($yeargrupo->cod_grupo)->grupo_name . '</b> | ' . Year::find($yeargrupo->cod_school_year)->name_school_year . ' :: Se han guardado correctamente los cambios realizados.';
        }
        return Redirect::action('AdmonacademicaController@periodos', array('#groupsyear', 'cod_school_year' => $cod_school_year))->with('message_group_year', $msg);
    }

    public function gruposyear() {
        $input = Input::all();
        $year = Year::find($input['cod_school_year']);
        $grupos = new Grupo;
        $docentes = new Docente;
        $turnos = new Turno;
        if (isset($input['cod_year_grupo'])) {
            $grupoyear = Yeargroup::find($input['cod_year_grupo']);
        } else {
            $grupoyear = New Yeargroup;
        }
        return View::make('grupo.gruposyear')
                        ->with('year', $year)
                        ->with('docentes', $docentes)
                        ->with('turnos', $turnos)
                        ->with('grupos', $grupos)
                        ->with('grupoyear', $grupoyear);
    }

    public function reasignargrupo() {
        $input = Input::all();
        $grupo = Grupo::find($input['cod_grupo']);
        $grupo->cod_classroom = $input['new_cod_classroom']; //se cambia el grupo


        $grupo2 = Grupo::find(Classroom::find($input['new_cod_classroom'])->grupo->cod_grupo);
        $grupo2->cod_classroom = $input['actual_cod_classroom'];
        $grupo->save();
        $grupo2->save();
        $msg = 'Se ha reasignado correctamente el grupo <b>'.Nivel::find($grupo->cod_level)->level_name.''.$grupo->grupo_name.'</b> al aula :: <b>' . Classroom::find($grupo->cod_classroom)->classroom_name . '</b>';
      return Redirect::action('AdmonacademicaController@inicio',array('#classrooms'))->with('message_reasign',$msg);
    }

    public function agregargrupo() {
        $input = Input::all();
        $grupo = new Grupo;
        $grupo->cod_level = $input["nivel"];
        $grupo->cod_classroom = $input["cod_classroom"];
        $grupo->grupo_name = $input["nombregrupo"];
        $grupo->save();
        $msg = 'Se ha agregado correctamente un nuevo grupo <b>'.Nivel::find($grupo->cod_level)->level_name.''.$grupo->grupo_name.'</b> en al aula :: <b>' . Classroom::find($grupo->cod_classroom)->classroom_name . '</b>';
      
        return Redirect::action('AdmonacademicaController@inicio',array('#classrooms'))->with('message_add',$msg);
    }

}
