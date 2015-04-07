<?php

class Descuento extends Eloquent {

    protected $table = 'discount';
    protected $primaryKey = 'cod_discount';
    public $timestamps = false;

     public function scopeNotasigned($query, $cod_school_year) {
        return $query->whereNotExists(function($query) use($cod_school_year) {
                    return $query->select('*')
                                    ->from('year_discount')
                                    ->whereRaw('year_discount.cod_discount=discount.cod_discount AND year_discount.cod_school_year=' . $cod_school_year);
                })->get();
    }
    

}
