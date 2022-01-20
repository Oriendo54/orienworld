<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PofCharge extends Model
{
    use HasFactory;
    protected $table = 'pof_charge';
    protected $primaryKey = 'id_charge';
    public $timestamps = false;
}