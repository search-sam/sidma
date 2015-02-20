<?php

class Familia extends Eloquent {

	protected $table = 'family';
	protected $primaryKey = 'cod_family';
	public $timestamps = false;

	public function estudiante()
    {
        return $this->belongsTo('Estudiante', 'cod_family');
    }
     public function detallefamilia(){
         return $this->hasMany('DetalleFamilia','cod_family');
     }

    public function usuario()
    {
        return $this->belongsTo('Usuario', 'cod_family', 'cod_user');
    }

    public function tutor()
    {
        return $this->belongsTo('Tutor', 'cod_family');
    }

}
