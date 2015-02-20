<?php

class Docente extends Eloquent {

    protected $table = 'teacher';
    protected $primaryKey = 'cod_teacher';
    public $timestamps = false;

    public function yeargroup() {
        return $this->hasMany('Yeargroup','cod_teacher');
    }
    
    public function scopeNameTeacher($query,$cod_employee){
        return $this->raw("CONCAT(first_name,' ',firs_last_name)")
                ->join('employee','employee.cod_employee','=','teacher.cod_employee')
                ->whereRaw('teacher.cod_employee='.$cod_employee)->first();
    }
     public function empleado(){
           return $this->belongsTo('Empleado', 'cod_teacher','cod_employee');
        }

}
