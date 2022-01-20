<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofCarte extends Model {
    protected $table = 'pof_carte';
    public $primaryKey = 'id_carte';

    public function pofclient() {
        return $this->hasOne('App\Models\Pof\PofClient', 'id_client', 'id_client');
    }

    public function pofprestation() {
        return $this->hasOne('App\Models\Pof\PofPrestation', 'id_prestation', 'id_prestation');
    }

    public function poffacturedetails() {
        return $this->hasMany('App\Models\Pof\PofFactureDetail', 'id_carte', 'id_carte');
    }
}