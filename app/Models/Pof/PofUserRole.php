<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofUserRole extends Model {
    protected $table = 'pof_user_roles';
    public $primaryKey = 'id_user_role';
    public $timestamps = false;

    public function pofrole() {
        return $this->hasOne('App\Models\Pof\PofRole', 'id_role', 'id_role');
    }

    public function pofuser() {
        return $this->hasOne('App\Models\User', 'id', 'id_user');
    }
}