<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofClientAdresse extends Model {
    protected $table = 'pof_client_adresse';
    public $primaryKey = 'id_client_adresse';
    public $timestamps = false;

    public function pofclient() {
        return $this->hasOne('App\Models\Pof\PofClient', 'id_client', 'id_client');
    }
}