<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofPrestationassociation extends Model {
    protected $table = 'pof_prestation_association';
    public $primaryKey = 'id_prestation_association';
    public $timestamps = false;

    public function pofprestationassociationliens() {
        return $this->hasMany('App\Models\Pof\PofPrestationassociationLien', 'id_prestation_association', 'id_prestation_association');
    }

    public function pofprestationassociationliensecondaires() {
        return $this->hasMany('App\Models\Pof\PofPrestationassociationLien', 'id_prestation_association', 'id_prestation_association')
                ->where('prestation_principale',null);
    }
}