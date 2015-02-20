<?php

class Empleado extends Eloquent {

	protected $table = 'employee';
	protected $primaryKey = 'cod_employee';
	public $timestamps = false;

    public function getEmployeeNameAttribute(){
        return $this->attributes['first_name'].' '.$this->attributes['first_last_name'];
    }

	public function usuario(){
       return $this->belongsTo('Usuario', 'cod_employee', 'cod_user');
    }
    public function docente(){
       return $this->hasOne('Docente', 'cod_employee');
    }
     public function cargo(){
       return $this->belongsTo('Empleado', 'cod_employee','cod_employment');
    }

}
