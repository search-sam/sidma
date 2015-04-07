<?php

class Cargo extends Eloquent {

    protected $table = 'employment';
    protected $primaryKey = 'cod_employment';
    public $timestamps = false;

   
     public function empleado(){
           return $this->hasOne('Empleado', 'cod_employee');
        }

}
