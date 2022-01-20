<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofCoursEmplacement extends Model {
    protected $table = 'pof_cours_emplacement';
    public $primaryKey = 'id_cours_emplacement';

    public function pofcours() {
        return $this->hasOne('App\Models\Pof\PofCours', 'id_cours_emplacement', 'id_cours_emplacement');
    }
    
}