<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofPrestationgroupeLien extends Model {
    protected $table = 'pof_prestation_groupe_lien';
    public $primaryKey = 'id_prestation_groupe_lien';
    public $timestamps = false;

    public function pofprestationgroupe() {
        return $this->hasOne('App\Models\Pof\PofPrestationgroupe', 'id_prestation_groupe', 'id_prestation_groupe');
    }

    public function pofprestation() {
        return $this->hasOne('App\Models\Pof\PofPrestation', 'id_prestation', 'id_prestation');
    }

    public function tarifdefaut() {
        return $this->hasOne('App\Models\Pof\PofTarif', 'id_tarif', 'id_tarif_defaut');
    }
}