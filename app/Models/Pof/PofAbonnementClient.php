<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofAbonnementClient extends Model {
    protected $table = 'pof_abonnement_client';
    public $primaryKey = 'id_abonnement_client';
    public $timestamps = false;

    public function pofabonnement() {
        return $this->hasOne('App\Models\Pof\PofAbonnement', 'id_abonnement', 'id_abonnement');
    }

    public function pofclient() {
        return $this->hasOne('App\Models\Pof\PofClient', 'id_client', 'id_client');
    }
}