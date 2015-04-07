<?php

class Recibo extends Eloquent {

    protected $table = 'receipt';
    protected $primaryKey = 'cod_receipt';
    public $timestamps = false;

    public function estudiante(){
        return $this->belongsTo('Estudiante','cod_student');
    }
}
