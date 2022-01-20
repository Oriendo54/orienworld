<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofClientCheval extends Model {
    protected $table = 'pof_client_cheval';
    public $primaryKey = 'id_client_cheval';
    
    public function pofcheval() {
        return $this->hasOne('App\Models\Pof\PofCheval', 'id_cheval', 'id_cheval');
    }
    
    public function pofclient() {
        return $this->hasOne('App\Models\Pof\PofClient', 'id_client', 'id_client');
    }
    
    public function pofclientchevalstatut() {
        return $this->hasOne('App\Models\Pof\PofClientChevalStatut', 'id_client_cheval_statut', 'id_client_cheval_statut');
    }
}