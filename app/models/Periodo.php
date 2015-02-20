<?php

class Periodo extends Eloquent {

    protected $table = 'period';
    protected $primaryKey = 'cod_period';
    public $timestamps = false;

    public function year() {
        return $this->belongsTo('School_Year', 'cod_periodo', 'cod_school_year');
    }

}
