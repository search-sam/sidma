<?php

class YearPlandepago extends Eloquent {

    protected $table = 'year_payment_plan';
    protected $primaryKey = 'cod_year_payment_plan';
    public $timestamps = false;
    
    public function estudianteplandepago(){
        return $this->hasMany('YearPlandepago','cod_year_payment_plan');
    }
    
    public function plandepago(){
        return $this->belongsTo('Plandepago','cod_payment_plan');
    }
  


}
