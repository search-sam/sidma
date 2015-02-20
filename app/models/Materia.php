<?php

class Materia extends Eloquent {

    protected $table = 'subject';
    protected $primaryKey = 'cod_subject';
    public $timestamps = false;

    
    public function grupoyears(){
        return $this->belongsToMany('Yeargroup','class','cod_subject','cod_year_grupo');
    }
    public function scopeNotadded($query,$cod_year_grupo) {
        return $query->whereNotExists(function($query) use($cod_year_grupo) {
                                    return $query->select('*')->from('class')
                                    ->whereRaw('class.cod_subject=subject.cod_subject and class.cod_year_grupo='.$cod_year_grupo);
                                    })->get();
    }
    
    public function scopeCodClass($query,$cod_subject,$cod_year_grupo) {
        return $query->select('cod_class')
                ->from('class')
                ->whereRaw('cod_subject='.$cod_subject.' and cod_year_grupo='.$cod_year_grupo)
            ->first();
    }
    
    

}
