<?php

class DetalleFamilia extends Eloquent {

	protected $table = 'family_detail';
	protected $primaryKey = 'cod_family_detail';
	public $timestamps = false;

	
     public function familia(){
         return $this->belongsTo('Familia','cod_family_detail','cod_family');
     }
     public function infotrabajo(){
         return $this->hasOne('Trabajo','cod_family_detail');
     }
     
     
     public function getNombreFamiliaAttribute(){
         return $this->attributes['first_name'].' '.$this->attributes['second_name']. ' '.$this->attributes['first_last_name'];
     }

  
}
