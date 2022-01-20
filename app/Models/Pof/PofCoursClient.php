<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofCoursClient extends Model {
    protected $table = 'pof_cours_client';
    public $primaryKey = 'id_cours_client';
    public $timestamps = false;

    public function pofcours() {
        return $this->hasOne('App\Models\Pof\PofCours', 'id_cours', 'id_cours');
    }

    public function pofclient() {
        return $this->hasOne('App\Models\Pof\PofClient', 'id_client', 'id_client');
    }

    public function pofcheval() {
        return $this->hasOne('App\Models\Pof\PofCheval', 'id_cheval', 'id_cheval');
    }

    public function pofcarte() {
        return $this->hasOne('App\Models\Pof\PofCarte', 'id_carte', 'id_carte');
    }
}