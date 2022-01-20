<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofLog extends Model {
    protected $table = 'pof_log';
    public $primaryKey = 'id_log';
    public $timestamps = false;
}