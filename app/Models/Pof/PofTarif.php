<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofTarif extends Model {
    protected $table = 'pof_tarif';
    public $primaryKey = 'id_tarif';
    public $timestamps = false;
    
    public function pofprestation() {
        return $this->hasOne('App\Models\Pof\PofPrestation', 'id_prestation', 'id_prestation');
    }
}