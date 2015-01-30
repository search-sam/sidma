<?php

class Tutor extends Eloquent {

	protected $table = 'family_detail';
	protected $primaryKey = 'cod_family_detail';
	public $timestamps = false;

	public function familia()
    {
        return $this->hasOne('Familia', 'cod_family', 'cod_family_detail');
    }

    public function trabajo()
    {
        return $this->hasMany('Trabajo', 'cod_employment_information', 'cod_family_detail');
    }

}
