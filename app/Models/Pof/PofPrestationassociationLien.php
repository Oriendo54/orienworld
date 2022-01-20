<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofPrestationassociationLien extends Model {
    protected $table = 'pof_prestation_association_lien';
    public $primaryKey = 'id_prestation_association_lien';
    public $timestamps = false;

    public function pofprestation() {
        return $this->hasOne('App\Models\Pof\PofPrestation', 'id_prestation', 'id_prestation');
    }
    
    public function pofprestationassociation() {
        return $this->hasOne('App\Models\Pof\PofPrestationassociation', 'id_prestation_association', 'id_prestation_association');
    }
}