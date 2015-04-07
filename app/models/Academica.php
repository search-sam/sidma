<?php

class Academica extends Eloquent {

	protected $table = 'academic_information';
	protected $primaryKey = 'cod_academic_information';
	public $timestamps = false;

	public function estudiante()
    {
    	return $this->belongsTo('Estudiante', 'cod_academic_information', 'cod_student');
    }
    
    
    public function scopedocumentos($query,$cod_student){
        //Partida de nacimiento, Certificado de conducta, Solvencia de pago, Seguro escolar, Compromiso del tutor, Compromiso del estudiante, 
       return $query->select('birth_certificate','good_standing','payment_solvency','insurance_student','tutor_compromise_signature','student_compromise_signature')
                    ->whereRaw('cod_student='.$cod_student)->first();
    }

}
