<h1 class="page-header" id="hschool_year">Aulas de clases <button id="NewClassroom" data-toggle="modal" data-target="#NewOrEditModal" class="btn btn-success">Nueva aula</button>
    
</h1>
<div class="table-responsive">
    <table id="tableclassroom" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr> 
                <th>Creación</th>
                <th>Aula</th>
                <th>Edificio</th>
                <th>Capacidad</th>
                <th>Descripción</th>
                  <th></th>
                <th>Grupo</th>
                 <th>Nivel</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classrooms as $classroom)
            <tr  id="{{$classroom->cod_classroom}}">
                <td>{{Util::FormatDate($classroom->create_date)}}</td>
                <td>{{$classroom->classroom_name}}</td>
               <td>{{$classroom->building}}</td>
                <td>{{$classroom->capacity}}</td>
                <td>{{$classroom->description}}</td>
                <td>
                    <div class="btn-group">
                        <button id="{{$classroom->cod_classroom}}"  type="button" data-toggle="modal" data-target="#NewOrEditModal" class="editclassroom btn btn-sm btn-default edit" ><span class="glyphicon glyphicon-edit"></span>Editar</button>
                    </div>
                    <div class="btn-group">
                        <button id="{{$classroom->cod_classroom}}" data-toggle="modal" data-target="#DelClassroomModal" class="bdeleteclassroom btn btn-sm btn-warning">Eliminar</button>
                    </div>
                </td>
                <td><?= empty($classroom->grupo->grupo_name)?"<div class='btn-group'><button id='".$classroom->cod_classroom."' data-toggle='modal' data-target='#NewOrEditModal' type='button' class='creategroup btn btn-sm btn-info' ><span class='glyphicon glyphicon-edit'></span>Crear grupo</button></div>":'<b>'.$classroom->grupo->grupo_name."</b> <div class='btn-group'><button id='".$classroom->grupo->cod_grupo."' data-toggle='modal' data-target='#NewOrEditModal' type='button' class='changegroup btn btn-sm btn-default' ><span class='glyphicon glyphicon-edit'></span>Cambiar</button></div>"?></td>
                <td><?= empty($classroom->grupo->cod_level)?'No asignado':Nivel::find($classroom->grupo->cod_level)->level_name?></td>
               
            </tr>
            @endforeach
        </tbody>
    </table>
</div>