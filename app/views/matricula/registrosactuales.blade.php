<thead>
    <tr>
        <th>Carnet</th>
        <th>Nombre</th>
        <th>Plan de pago</th>
        <th></th>
    </tr>
</thead>
<tbody>
    @foreach ($matriculas as $matricula)
    <?php
    $enrollment = new Matricula;
    $cod_enrollment = 0;
    if ($matricula->matriculas()->leftJoin('year_grupo', 'enrollment.cod_year_grupo', '=', 'year_grupo.cod_year_grupo', function($q) {
                return $q->where('cod_school_year', $year->vigente()->cod_school_year)->orWhere('enrollment_state', 0);
            })->count()) {
        $cod_enrollment = $matricula->matriculas()->leftJoin('year_grupo', 'enrollment.cod_year_grupo', '=', 'year_grupo.cod_year_grupo', function($q) {
                    return $q->where('cod_school_year', $year->vigente()->cod_school_year)->orWhere('enrollment_state', 0);
                })->first()->cod_enrollment;
        $enrollment = Matricula::find($cod_enrollment);
    }
    $dis = '';
    if (is_null($matricula->academica->level_course)) {
        $dis = 'disabled';
    }
    $year = new Year;
    $cod_school_year = $year->vigente()->cod_school_year;
    $cod_concept_month = YearConcepto::whereRaw('cod_concept=4 AND cod_school_year=' . $cod_school_year)->first()->cod_year_payment_concept;
    $student_payment_plan = EstudiantePlandepago::where('cod_student', $matricula->cod_student)->where('cod_year_payment_concept', $cod_concept_month)->first();
    if (!count($student_payment_plan)) {
        $dis = 'disabled';
    }

    $gruposabiertos = Yeargroup::join('grupo', 'year_grupo.cod_grupo', '=', 'grupo.cod_grupo')
                    ->where('cod_school_year', $cod_school_year)
                    ->where('grupo.cod_level', ($matricula->academica->level_course + 1))->count();

    if (!$gruposabiertos) {
        $dis = 'disabled';
    }
    $label_enrollment = ($enrollment->enrollment_state == 1) ? '<i class="glyphicon glyphicon-edit"></i><strong> Grupo ' . $enrollment->yeargrupo->grupo->nivel->level_name . '' . $enrollment->yeargrupo->grupo->grupo_name . ' :: Editar' : ((!$gruposabiertos) ? '<i class="glyphicon glyphicon-warning_sign"></i><strong> No hay grupo abierto' : '<i class="glyphicon glyphicon-plus"></i><strong> Boleta matricula');
    ?>
    <tr>
        <td>
            {{($enrollment->enrollment_state==4)?$matricula->student_card:'<div class="btn-group"><button id="'.$cod_enrollment.'" class="editenrollment btn btn-sm btn-default '.$dis.'">'. $label_enrollment.'</strong></button></div>'}}
        </td>
        <td>
            {{$matricula->first_name}}
            <?= empty($matricula->second_name) ? '' : $matricula->second_name; ?>
            {{$matricula->first_last_name}}
            <?= empty($matricula->second_last_name) ? '' : $matricula->second_last_name; ?>
            <?= empty($matricula->academica->last_school) ? '' : ':: <i class="glyphicon glyphicon-education"></i> <span style="color:#555;">' . $matricula->academica->last_school . '</span>' ?>
            <?php if (is_null($matricula->academica->level_course)) { ?>
                <label class="label label-danger" style="padding: 7px 10px;"><i class="glyphicon glyphicon-alert"></i> No se ha definido el ultimo curso</label>
                <a data-toggle="tooltip" data-placement="right" title="Editar estudiante" href="{{action('EstudianteController@editar')}}?id={{$matricula->cod_student}}" class="btn btn-sm inverse"> <i class="glyphicon glyphicon-pencil"></i></a>

            <?php } else { ?><span style="color:#555;">
                    (último nivel: <?= Util::levelname(Nivel::find($matricula->academica->level_course)->level_name) ?> )

                <?php } ?></span>
        </td>
        <td>
            <?php if (count($student_payment_plan)) { ?>
                <label class="label label-primary" style="padding: 7px 10px;">
                    <i class="glyphicon glyphicon-check"></i> {{Plandepago::find(YearPlandepago::find($student_payment_plan->cod_year_payment_plan)->cod_payment_plan)->plan_name}}
                </label>
            <?php } else { ?>
                <label class="label label-danger" style="padding: 7px 10px;">
                    <i class="glyphicon glyphicon-alert"></i>  No se ha definido
                </label>
                <a data-toggle="tooltip" data-placement="left" title="Agregar un plan de pago" href="{{action('EstudianteController@editar')}}?id={{$matricula->cod_student}}#academica" class="btn btn-sm inverse"> <i class="glyphicon glyphicon-pencil"></i></a>
            <?php } ?>
        </td>
        <td>
            <div class="btn-group">
                <button id="{{$matricula->cod_student}}" type="button" class="editdopay btn btn-sm btn-default"  <?= ($enrollment->enrollment_state == 1 || $enrollment->enrollment_state == 4) ? '' : 'disabled' ?>><span class="glyphicon glyphicon-usd"></span> Realizar pago</button>
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
