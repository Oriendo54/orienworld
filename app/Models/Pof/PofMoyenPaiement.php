<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofMoyenPaiement extends Model {
    protected $table = 'pof_moyen_paiement';
    public $primaryKey = 'id_moyen_paiement';
    public $timestamps = false;
}