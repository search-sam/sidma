<?php

class Year extends Eloquent {

    protected $table = 'school_year';
    protected $primaryKey = 'cod_school_year';
    public $timestamps = false;

    public function periodo() {
        return $this->hasOne('Periodo', 'cod_school_year');
    }
    
    public function vigente(){
        return $this->where('state_school_year',1)->first();
    }
    
    public function yeargroup() {
        return $this->hasMany('Yeargroup', 'cod_school_year');
    }   
    
    public function planesdepago(){
        return $this->belongsToMany('Plandepago','year_payment_plan','cod_school_year','cod_payment_plan');
    }
    public function conceptosdepago(){
         return $this->belongsToMany('Conceptodepago','year_payment_concept','cod_school_year','cod_concept');
    }
    public function grupos(){
        return $this->belongsToMany('Grupo','year_grupo','cod_school_year','cod_grupo');
    }
   

}
