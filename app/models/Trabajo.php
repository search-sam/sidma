<?php

class Trabajo extends Eloquent {

	protected $table = 'employment_information';
	protected $primaryKey = 'cod_employment_information';
	public $timestamps = false;

	
        public function detallefamilia(){
            return $this->belongsTo('DetalleFamilia','employment_information','cod_family_detail');
        }
        

    
}