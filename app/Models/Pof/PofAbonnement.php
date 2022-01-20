<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofAbonnement extends Model {
    protected $table = 'pof_abonnement';
    public $primaryKey = 'id_abonnement';
    public $timestamps = false;

    public function pofabonnementclient() {
        return $this->hasOne('App\Models\Pof\PofAbonnementClient', 'id_abonnement', 'id_abonnement');
    }

    public function pofabonnementprestations() {
        return $this->hasMany('App\Models\Pof\PofAbonnementPrestation', 'id_abonnement', 'id_abonnement');
    }

    // A utiliser dans le cas des pensions et des cotisations, qui n'ont qu'une prestation (donc un seul abonnementprestation)
    public function pofabonnementprestation() {
        return $this->hasOne('App\Models\Pof\PofAbonnementPrestation', 'id_abonnement', 'id_abonnement');
    }
}