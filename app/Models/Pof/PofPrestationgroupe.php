<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofPrestationgroupe extends Model {
    protected $table = 'pof_prestation_groupe';
    public $primaryKey = 'id_prestation_groupe';
    public $timestamps = false;

    public function pofprestationgroupeliens() {
        return $this->hasMany('App\Models\Pof\PofPrestationgroupeLien', 'id_prestation_groupe', 'id_prestation_groupe');
    }    
}