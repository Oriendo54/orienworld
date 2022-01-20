<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofCheval extends Model {
    protected $table = 'pof_cheval';
    public $primaryKey = 'id_cheval';

    public function PofCoursClient() {
        return $this->hasOne('App\Models\Pof\PofCoursClient', 'id_cheval', 'id_cheval');
    }
    
    public function PofChevalType() {
        return $this->hasOne('App\Models\Pof\PofChevalType', 'id_cheval_type', 'id_cheval_type');
    }
    
    public function PofChevalStatut() {
        return $this->hasOne('App\Models\Pof\PofChevalStatut', 'id_cheval_statut', 'id_cheval_statut');
    }

    public function pofclientcheval() {
        return $this->hasOne('App\Models\Pof\PofClientCheval', 'id_cheval', 'id_cheval');
    }

    public function pofchevalcharges() {
        return $this->hasMany('App\Models\Pof\PofChevalCharge', 'id_cheval', 'id_cheval');
    }
}