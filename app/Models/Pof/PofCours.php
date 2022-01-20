<?php

namespace App\Models\Pof;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PofCours extends Model {
    protected $table = 'pof_cours';
    public $primaryKey = 'id_cours';

    public function pofcoursclient() {
        return $this->hasMany('App\Models\Pof\PofCoursClient', 'id_cours', 'id_cours');
    }

    public function pofmoniteur() {
        return $this->hasOne('App\Models\Pof\PofMoniteurs', 'id_moniteur', 'id_moniteur');
    }

    public function pofcoursemplacement() {
        return $this->hasOne('App\Models\Pof\PofCoursEmplacement', 'id_cours_emplacement', 'id_cours_emplacement');
    }
    
    public function pofcourstype() {
        return $this->hasOne('App\Models\Pof\PofCoursType', 'id_cours_type', 'id_cours_type');
    }
    
    public function pofcoursclientniveaux() {
        return $this->hasMany('App\Models\Pof\PofCoursClientNiveau', 'id_cours', 'id_cours');
    }
}