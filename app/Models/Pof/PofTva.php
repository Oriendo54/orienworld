<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofTva extends Model {
    protected $table = 'pof_tva';
    public $primaryKey = 'id_tva';
    public $timestamps = false;
}