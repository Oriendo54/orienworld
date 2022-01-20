<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PofChevalCharge extends Model
{
    use HasFactory;
    protected $table = 'pof_cheval_charge';
    protected $primaryKey = 'id_cheval_charge';
    public $timestamps = false;

    public function pofcheval() {
        return $this->hasOne('App\Models\Pof\PofCheval', 'id_cheval', 'id_cheval');
    }

    public function pofcharge() {
        return $this->hasOne('App\Models\Pof\PofCharge', 'id_charge', 'id_charge');
    }
}