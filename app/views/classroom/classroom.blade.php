<h1 class="page-header mypageheader" id="hschool_year">Aulas de clases <button id="NewClassroom"  class="btn btn-success">Nueva aula</button>
    
</h1>
<div class="table-responsive">
    <table id="tableclassroom" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr> 
                <th>Aula</th>
                <th>Edificio</th>
                <th>Capacidad</th>
                <th>Descripción</th>
                  <th></th>
                <th>Grupo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classrooms as $classroom)
            <tr  id="{{$classroom->cod_classroom}}">
                <td>{{$classroom->classroom_name}}</td>
               <td>{{$classroom->building}}</td>
                <td>{{$classroom->capacity}}</td>
                <td>{{$classroom->description}}</td>
                <td>
                    <div class="btn-group">
                        <button id="{{$classroom->cod_classroom}}"  type="button"  class="editclassroom btn btn-sm btn-default" ><span class="glyphicon glyphicon-edit"></span>Editar</button>
                    </div>
                    <div class="btn-group">
                        <button id="{{$classroom->cod_classroom}}" class="deleteclassroom btn btn-sm btn-warning">Eliminar</button>
                    </div>
                </td>
                <td><?= empty($classroom->grupo->grupo_name)?"<div class='btn-group'><button id='".$classroom->cod_classroom."'  type='button' class='creategroup btn btn-sm btn-info' ><span class='glyphicon glyphicon-edit'></span> Crear grupo</button></div>":'<div class="btn-group"><div class="btn btn-sm btn-primary"><b>'.Nivel::find($classroom->grupo->cod_level)->level_name.''.$classroom->grupo->grupo_name."</b></div> <div class='btn-group'><button id='".$classroom->grupo->cod_grupo."' type='button' class='changegroup btn btn-sm btn-default' ><span class='glyphicon glyphicon-edit'></span> Reasignar</button></div></div>"?></td>
                
               
            </tr>
            @endforeach
        </tbody>
    </table>
</div>