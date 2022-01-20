<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofFactureDetailLien extends Model {
    protected $table = 'pof_facture_detail_lien';
    public $primaryKey = 'id_facture_detail';

    public function poffacture() {
        return $this->hasOne('App\Models\Pof\PofFacture', 'id_facture', 'id_facture');
    }
}