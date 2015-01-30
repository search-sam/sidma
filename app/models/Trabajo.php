<?php

class Trabajo extends Eloquent {

	protected $table = 'employment_information';
	protected $primaryKey = 'cod_employment_information';
	public $timestamps = false;

	public function tutor()
    {
        return $this->belongsTo('Tutor');
    }

    
}