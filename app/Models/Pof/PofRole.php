<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofRole extends Model {
    protected $table = 'pof_roles';
    public $primaryKey = 'id_role';
    public $timestamps = false;
}