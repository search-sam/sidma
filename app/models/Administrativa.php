<?php

class Administrativa extends Eloquent {

	protected $table = 'admin_information';
	protected $primaryKey = 'cod_admin_information';
	public $timestamps = false;

	public function estudiante()
    {
    	return $this->belongsTo('Estudiante', 'cod_admin_information', 'cod_student');
    }

}
