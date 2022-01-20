<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofFactureMoyenPaiement extends Model {
    protected $table = 'pof_facture_moyen_paiement';
    public $primaryKey = 'id_facture_moyen_paiement';
    public $timestamps = false;

    public function poffacture() {
        return $this->hasOne('App\Models\Pof\PofFacture', 'id_facture', 'id_facture');
    }
    
    public function pofmoyenpaiement() {
        return $this->hasOne('App\Models\Pof\PofMoyenPaiement', 'id_moyen_paiement', 'id_moyen_paiement');
    }
}