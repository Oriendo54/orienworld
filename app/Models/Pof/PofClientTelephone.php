<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofClientTelephone extends Model {
    protected $table = 'pof_client_telephone';
    public $primaryKey = 'id_client_telephone';
    public $timestamps = false;

    public function pofclient() {
        return $this->hasOne('App\Models\Pof\PofClient', 'id_client', 'id_client');
    }
}