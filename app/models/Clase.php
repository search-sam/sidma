<?php

class Clase extends Eloquent {

    protected $table = 'class';
    protected $primaryKey = 'cod_class';
    public $timestamps = false;   
   
    public function yeargroup() {
        return $this->belongsTo('Yeargroup','cod_class','cod_year_grupo');
    }
    

}
