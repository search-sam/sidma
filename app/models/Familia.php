<?php

class Familia extends Eloquent {

    protected $table = 'family';
    protected $primaryKey = 'cod_family';
    public $timestamps = false;

   
    public function estudiantes(){
        return $this->hasMany('Estudiante','cod_family');
    }
    
    public function detallefamilia() {
        return $this->hasMany('DetalleFamilia', 'cod_family');
    }

    public function usuario() {
        return $this->hasOne('Usuario', 'cod_user');
    }

    public function tutor() {
        return $this->belongsTo('Tutor', 'cod_family');
    }

}
