<?php

class Empleado extends Eloquent {

	protected $table = 'employee';
	protected $primaryKey = 'cod_employee';
	public $timestamps = false;

	/*public function familia()
    {
        return $this->hasOne('Familia', 'cod_family', 'cod_student');
    }

    public function usuario()
    {
        return $this->hasOne('Usuario', 'cod_family', 'cod_user');
    }*/

}
