<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofClientStatut extends Model {
    protected $table = 'pof_client_statut';
    public $primaryKey = 'id_client_statut';
    public $timestamps = false;

    public function pofclient() {
        return $this->hasOne('App\Models\Pof\PofClient', 'id_client_statut', 'id_client_statut');
    }
}