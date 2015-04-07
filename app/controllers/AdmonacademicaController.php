<?php

class AdmonAcademicaController extends BaseController {

    public function inicio() {
         if (Auth::check()) {            
        } else {
           return Redirect::to('login')->with('message', '<i class="glyphicon glyphicon-info-sign"></i> <strong>Denegado</strong>, debe ser usuario');
                 
        }
        $years = Year::all();
        $classrooms = Classroom::all();
        $niveles = Nivel::all();
        $materias = Materia::all();
        $turnos = Turno::all();

        return View::make('admonacademica.admonacademica')
            ->with('years', $years)
            ->with('classrooms', $classrooms)
            ->with('niveles', $niveles)
            ->with('materias', $materias)
            ->with('turnos', $turnos);
    }

    public function periodos() {
        $input = Input::all();
        $year = Year::find($input['cod_school_year']);
        $periodos = Periodo::where('cod_school_year', '=', $year->cod_school_year)->get();
        $grupoyears = YearGroup::whereRaw('cod_school_year='.$year->cod_school_year)->get();
        $docentes = new Docente;
        $turnos = new Turno;
        $grupos = new Grupo;
        return View::make('admonacademica.periodos')
                        ->with('year', $year)
                        ->with('periodos', $periodos)
                        ->with('grupoyears', $grupoyears)
                        ->with('docentes',$docentes)
                        ->with('turnos',$turnos)
                        ->with('grupos',$grupos);
    }

}
