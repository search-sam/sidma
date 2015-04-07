<?php

class Pagocuota extends Eloquent {

    protected $table = 'payment';//cod_receipt, cod_quota_payment
    protected $primaryKey = 'cod_payment';
    public $timestamps = false;

    public function recibo() {
        return $this->belongsTo('Recibo', 'cod_receipt');
    }

    public function cuota() {
        return $this->belongsTo('Cuotadepago', 'cod_quota_payment');
    }

}
