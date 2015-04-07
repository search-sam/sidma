<?php

class EstudiantePlandepago extends Eloquent {

    protected $table = 'student_payment_plan';
    protected $primaryKey = 'cod_student_payment_plan';
    public $timestamps = false;
     
    public function yearplandepago(){
        return $this->belongsTo('YearPlandepago','cod_year_payment_plan');
    }
    public function estudiante(){
        return $this->belongsTo('Estudiante','cod_student');
    }
    public function yearconcepto(){
        return $this->belongsTo('YearConcepto','cod_year_payment_concept');
    }
    public function yeardescuento(){
        return $this->belongsTo('YearDescuento','cod_year_discount');
    }
    public function scopeInforce($query,$cod_school_year,$cod_student){
        return $query->where('cod_student',$cod_student)
                ->join('year_payment_plan','year_payment_plan.cod_year_payment_plan','=','student_payment_plan.cod_year_payment_plan')
            ->where('year_payment_plan.cod_school_year',$cod_school_year)
                ->where('student_payment_plan.state','<',1)->get();
        
    }
    public function metododepago(){
        return $this->belongsTo('Metododepago','cod_payment_method');
    } 
    public function cuotas(){
        return $this->hasMany('Cuotadepago','cod_student_payment_plan');
    }


}
