<?php

class YearDescuento extends Eloquent {

    protected $table = 'year_discount';
    protected $primaryKey = 'cod_year_discount';
    public $timestamps = false;
    
  public function descuento(){
      return $this->belongsTo('Descuento','cod_discount');
  }


}
