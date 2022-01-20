<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofFacture extends Model {
    protected $table = 'pof_facture';
    public $primaryKey = 'id_facture';

    public function pofclient() {
        return $this->hasOne('App\Models\Pof\PofClient', 'id_client', 'id_client');
    }

    public function poffacturedetails() {
        return $this->hasMany('App\Models\Pof\PofFactureDetail', 'id_facture', 'id_facture')->orderBy('id_facture_detail','asc');
    }
    
    public function poffacturedetailliens() {
        return $this->hasMany('App\Models\Pof\PofFactureDetailLien', 'id_facture', 'id_facture');
    }

    public function poffacturestatut() {
        return $this->hasOne('App\Models\Pof\PofFactureStatut', 'id_facture_statut', 'id_facture_statut');
    }

    public function poffacturebonachats() {
        return $this->hasMany('App\Models\Pof\PofFactureBonachat', 'id_facture', 'id_facture');
    }

    public function poffacturemoyenspaiement() {
        return $this->hasMany('App\Models\Pof\PofFactureMoyenPaiement', 'id_facture', 'id_facture');
    }
}