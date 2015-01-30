<?php

class Usuario extends Eloquent {

	protected $table = 'user';
	protected $primaryKey = 'cod_user';
	public $timestamps = false;

	public function familia()
    {
        return $this->belongsTo('Familia');
    }

    public function estudiante()
    {
    	return $this->hasOne('Estudiante', 'cod_user');
    }

}
