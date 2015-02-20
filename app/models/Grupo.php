<?php

class Grupo extends Eloquent {

    protected $table = 'grupo';
    protected $primaryKey = 'cod_grupo';
    public $timestamps = false;

    public function scopeNotasigned($query) {
        return $query->whereNotExists(function($query) {
                return $query->select('*')
                             ->from('year_grupo')
                             ->whereRaw('year_grupo.cod_grupo=grupo.cod_grupo');
                })->get();
    }

    public function classroom() {
        return $this->belongsTo('Classroom', 'cod_grupo', 'cod_classroom');
    }

    public function yeargroup() {
        return $this->hasMany('Yeargroup', 'cod_grupo');
    }



    public function years(){
        return $this->belongsToMany('Year','year_grupo','cod_grupo','cod_school_year');
    }

    public function nivel() {
        return $this->belongsTo('Nivel', 'cod_level', 'cod_grupo');
    }

}
