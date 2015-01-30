<?php

class Familia extends Eloquent {

	protected $table = 'family';
	protected $primaryKey = 'cod_family';
	public $timestamps = false;

	public function estudiante()
    {
        return $this->belongsTo('Estudiante', 'cod_family');
    }

    public function usuario()
    {
        return $this->hasMany('Usuario', 'cod_user', 'cod_family');
    }

    public function tutor()
    {
        return $this->belongsTo('Tutor', 'cod_family');
    }

}
