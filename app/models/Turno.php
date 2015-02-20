<?php

class Turno extends Eloquent {

    protected $table = 'shift';
    protected $primaryKey = 'cod_shift';
    public $timestamps = false;

    public function yeargroup() {
        return $this->hasMany('Yeargroup', 'cod_shift');
    }

}
