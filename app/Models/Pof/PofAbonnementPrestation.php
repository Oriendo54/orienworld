<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofAbonnementPrestation extends Model {
    protected $table = 'pof_abonnement_prestation';
    public $primaryKey = 'id_abonnement_prestation';
    public $timestamps = false;

    public function pofabonnement() {
        return $this->hasOne('App\Models\Pof\PofAbonnement', 'id_abonnement', 'id_abonnement');
    }

    public function pofprestation() {
        return $this->hasOne('App\Models\Pof\PofPrestation', 'id_prestation', 'id_prestation');
    }

    public function poftarif() {
        return $this->hasOne('App\Models\Pof\PofTarif', 'id_tarif', 'id_tarif');
    }
}