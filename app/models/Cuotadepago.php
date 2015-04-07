<?php

class Cuotadepago extends Eloquent {

    protected $table = 'quota_payment';
    protected $primaryKey = 'cod_quota_payment';
    public $timestamps = false;
   
   public function estudianteplandepago(){
         return $this->belongsTo('EstudiantePlandepago','cod_student_payment_plan');
     }


}
