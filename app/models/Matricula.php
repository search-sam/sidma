<?php

class Matricula extends Eloquent {
    protected $table = 'enrollment';
    protected $primaryKey = 'cod_enrollment';
    public $timestamps = false;

    function yeargrupo(){
        return $this->belongsTo('Yeargroup','cod_year_grupo');
    }
      public function scopeInBolet($query,$cod_student){
        return $query->where('enrollment_state',1)->where('cod_student',$cod_student)->first();
        
    }

}
