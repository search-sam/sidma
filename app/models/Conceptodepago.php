<?php

class Conceptodepago extends Eloquent {

    protected $table = 'concept';
    protected $primaryKey = 'cod_concept';
    public $timestamps = false;

   
    
    
    public function scopeNotasigned($query, $cod_school_year) {
        return $query->whereNotExists(function($query) use($cod_school_year) {
                    return $query->select('*')
                                    ->from('year_payment_concept')
                                    ->whereRaw('year_payment_concept.cod_concept=concept.cod_concept AND year_payment_concept.cod_school_year=' . $cod_school_year);
                })->get();
    }

}
