<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofFactureBonachat extends Model {
    protected $table = 'pof_facture_bonachat';
    public $primaryKey = 'id_facture_bonachat';
    public $timestamps = false;

    public function poffacture() {
        return $this->hasOne('App\Models\Pof\PofFacture', 'id_facture', 'id_facture');
    }
    
    public function pofbonachat() {
        return $this->hasOne('App\Models\Pof\PofBonachat', 'id_bonachat', 'id_bonachat');
    }
}