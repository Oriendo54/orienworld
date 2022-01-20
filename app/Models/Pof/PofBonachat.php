<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofBonachat extends Model {
    protected $table = 'pof_bonachat';
    public $primaryKey = 'id_bonachat';

    public function pofclient() {
        return $this->hasOne('App\Models\Pof\PofClient', 'id_client', 'id_client');
    }
    
    public function poffacturebonachats() {
        return $this->hasMany('App\Models\Pof\PofFactureBonachat', 'id_bonachat', 'id_bonachat');
    }
}