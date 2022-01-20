<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofClientChevalStatut extends Model {
    protected $table = 'pof_client_cheval_statut';
    public $primaryKey = 'id_client_cheval_statut';
    public $timestamps = false;
    
}