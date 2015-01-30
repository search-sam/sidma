<?php

class Academica extends Eloquent {

	protected $table = 'academic_information';
	protected $primaryKey = 'cod_academic_information';
	public $timestamps = false;

	public function estudiante()
    {
    	return $this->belongsTo('Estudiante', 'cod_academic_information', 'cod_student');
    }

}
