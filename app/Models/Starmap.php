<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Starmap extends Model
{
    use HasFactory;
    protected $table = 'starmap';
    protected $primaryKey = 'id_planete';
    public $timestamps = false;
}
