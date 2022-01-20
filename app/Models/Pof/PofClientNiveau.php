<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofClientNiveau extends Model {
    protected $table = 'pof_client_niveau';
    public $primaryKey = 'id_client_niveau';

    public function pofclient() {
        return $this->hasOne('App\Models\Pof\PofClient', 'id_client_niveau', 'id_client_niveau');
    }
    
}