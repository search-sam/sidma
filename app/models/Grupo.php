<?php

class Grupo extends Eloquent {

    protected $table = 'grupo';
    protected $primaryKey = 'cod_grupo';
    public $timestamps = false;

    public function scopeNotasigned($query, $cod_school_year) {
        return $query->whereNotExists(
                function ($query) use ($cod_school_year) {
                    return $query->select('*')
                                    ->from('year_grupo')
                                    ->whereRaw('year_grupo.cod_grupo=grupo.cod_grupo AND year_grupo.cod_school_year='.$cod_school_year);
                                   
                })->get();
    }

    public function classroom() {
        return $this->belongsTo('Classroom', 'cod_grupo', 'cod_classroom');
    }

    public function yeargroup() {
        return $this->hasMany('Yeargroup', 'cod_grupo');
    }

<<<<<<< HEAD
    public function years() {
        return $this->belongsToMany('Year', 'year_grupo', 'cod_grupo', 'cod_school_year');
=======


    public function years(){
        return $this->belongsToMany('Year','year_grupo','cod_grupo','cod_school_year');
>>>>>>> b248824688b330e9e66101235b80bafb5ae5f18a
    }

    public function nivel() {
        return $this->belongsTo('Nivel', 'cod_level');
    }

}
