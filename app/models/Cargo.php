<?php

class Cargo extends Eloquent {

    protected $table = 'Employment';
    protected $primaryKey = 'cod_employment';
    public $timestamps = false;

   
     public function empleado(){
           return $this->hasOne('Empleado', 'cod_employee');
        }

}
