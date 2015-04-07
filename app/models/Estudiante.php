<?php

class Estudiante extends Eloquent {

    protected $table = 'student';
    protected $primaryKey = 'cod_student';
    public $timestamps = false;

    public function familia() {
        return $this->belongsTo('Familia', 'cod_family');
    }

    public function usuario() {
        return $this->belongsTo('Usuario', 'cod_student', 'cod_user');
    }

    public function academica() {
        return $this->hasOne('Academica', 'cod_student');
    }
    
    public function matriculas(){
        return $this->hasMany('Matricula','cod_student');
    }

    public function administrativa() {
        return $this->hasOne('Administrativa', 'cod_student');
    }
    public function conceptodepago(){
        return $this->belongsToMany('YearConcepto','student_payment_plan','cod_student','cod_year_payment_concept')->first();
    }
    public function medica() {
        return $this->hasOne('Medica', 'cod_student');
    }
    public function planesdepago(){
        return $this->hasMany('EstudiantePlandepago','cod_student');
    }

}
