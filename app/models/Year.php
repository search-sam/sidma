<?php

class Year extends Eloquent {

    protected $table = 'school_year';
    protected $primaryKey = 'cod_school_year';
    public $timestamps = false;

    public function periodo() {
        return $this->hasOne('Periodo', 'cod_school_year');
    }

    public function yeargroup() {
        return $this->hasMany('Yeargroup', 'cod_school_year');
    }
    
    public function grupos(){
        return $this->belongsToMany('Grupo','year_grupo','cod_school_year','cod_grupo');
    }
   

}
