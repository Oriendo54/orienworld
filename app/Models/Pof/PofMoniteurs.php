<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofMoniteurs extends Model {
    protected $table = 'pof_moniteurs';
    public $primaryKey = 'id_moniteur';
    public $timestamps = false;

    public function cours() {
        return $this->hasOne('App\Models\Pof\PofCours', 'id_moniteur', 'id_moniteur');
    }

    public function pofuser() {
        return $this->hasOne('App\Models\Pof\User', 'id', 'id_user');
    }

    public function pofuserrole() {
        return $this->hasOne('App\Models\Pof\PofUserRole', 'id_user', 'id_user');
    }
}