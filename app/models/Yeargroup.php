<?php

class Yeargroup extends Eloquent {

    protected $table = 'year_grupo';
    protected $primaryKey = 'cod_year_grupo';
    public $timestamps = false;

    public function materias(){
        return $this->belongsToMany('Materia','class','cod_year_grupo','cod_subject');
    }
    public function grupo() {
        return $this->belongsTo('Grupo','cod_grupo');
    }
     public function docente() {
        return $this->belongsTo('Docente','cod_teacher');
    }
     public function turno() {
        return $this->belongsTo('Turno','cod_shift');
    }
     public function year() {
        return $this->belongsTo('Year','cod_school_year');
    }
   

}
