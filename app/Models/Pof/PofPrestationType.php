<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofPrestationType extends Model {
    protected $table = 'pof_prestation_type';
    public $primaryKey = 'id_prestation_type';
    public $timestamps = false;

    public function pofprestation() {
        return $this->hasOne('App\Models\Pof\PofPrestation', 'id_prestation_type', 'id_prestation_type');
    }
}