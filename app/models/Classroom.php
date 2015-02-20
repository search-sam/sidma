<?php

class Classroom extends Eloquent {

	protected $table = 'classroom';
	protected $primaryKey = 'cod_classroom';
	public $timestamps = false;

    public function grupo()
    {
        return $this->hasOne('Grupo', 'cod_classroom');
    }

    

}
