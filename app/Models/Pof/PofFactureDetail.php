<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofFactureDetail extends Model {
    protected $table = 'pof_facture_detail';
    public $primaryKey = 'id_facture_detail';

    public function poffacture() {
        return $this->hasOne('App\Models\Pof\PofFacture', 'id_facture', 'id_facture');
    }
    
    public function poffacturedetaillien() {
        return $this->hasOne('App\Models\Pof\PofFactureDetailLien', 'id_facture_detail', 'id_facture_detail');
    }

    public function pofprestation() {
        return $this->hasOne('App\Models\Pof\PofPrestation', 'id_prestation', 'id_prestation');
    }

    public function poftarif() {
        return $this->hasOne('App\Models\Pof\PofTarif', 'id_tarif', 'id_tarif');
    }

    public function poffacturedetailenfant() {
        return $this->hasOne('App\Models\Pof\PofFactureDetail', 'id_facture_detail_pere', 'id_facture_detail');
    }

    public function pofcarte() {
        return $this->hasOne('App\Models\Pof\PofCarte', 'id_carte', 'id_carte');
    }
}