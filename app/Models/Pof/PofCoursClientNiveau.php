<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofCoursClientNiveau extends Model {
    protected $table = 'pof_cours_client_niveau';
    public $primaryKey = 'id_cours_client_niveau';
    public $timestamps = false;

    public function pofcours() {
        return $this->hasOne('App\Models\Pof\PofCours', 'id_cours', 'id_cours');
    }

    public function pofclientniveau() {
        return $this->hasOne('App\Models\Pof\PofClientNiveau', 'id_client_niveau', 'id_client_niveau');
    }
}