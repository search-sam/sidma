
<?php
$cod_student = isset($_REQUEST['cod_student']) ? $_REQUEST['cod_estudent'] : '';
?>
<form id="formnewedit" action="{{action('EstudianteController@createenrollment')}}<?= empty($cod_student) ? '' : "?cod_student=$estudiante->cod_student" ?>" method="post" class="form-horizontal" role="form">
    <div class="modal-dialog">
        <div id="neworeditemployee" class="modal-content">
            
           
      
        </div>
    </div>
</form>