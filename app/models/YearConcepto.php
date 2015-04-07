<?php

class YearConcepto extends Eloquent {

    protected $table = 'year_payment_concept';
    protected $primaryKey = 'cod_year_payment_concept';
    public $timestamps = false;
    
  
     public function mensualidad(){
         return $this->where('cod_concept',4)->first();
     }
     public function conceptodepago(){
         return $this->belongsTo('Conceptodepago','cod_concept');
     }
     
    
     
    

}
