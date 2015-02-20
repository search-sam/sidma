<?php

class Nivel extends Eloquent {

	protected $table = 'level';
	protected $primaryKey = 'cod_level';
	public $timestamps = false;

    public function grupo()
    {
        return $this->hasOne('Grupo', 'cod_level');
    }

    

}
