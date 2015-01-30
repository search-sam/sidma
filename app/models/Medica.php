<?php

class Medica extends Eloquent {

	protected $table = 'medical_information';
	protected $primaryKey = 'cod_medical_information';
	public $timestamps = false;

	public function estudiante()
    {
    	return $this->belongsTo('Estudiante', 'cod_medical_information', 'cod_student');
    }

}
