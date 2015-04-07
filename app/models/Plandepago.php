<?php

class Plandepago extends Eloquent {

    protected $table = 'payment_plan';
    protected $primaryKey = 'cod_payment_plan';
    public $timestamps = false;
    
     public function scopeNotasigned($query,$cod_school_year) {
        return $query->whereNotExists(function($query) use($cod_school_year) {
                return $query->select('*')
                             ->from('year_payment_plan')
                             ->whereRaw('year_payment_plan.cod_payment_plan=payment_plan.cod_payment_plan AND year_payment_plan.cod_school_year='.$cod_school_year);
                        
                })->get();
    }


}
