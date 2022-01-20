<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Romans extends Model
{
    use HasFactory;
    protected $table = 'romans';
    protected $primaryKey = 'id_roman';
}
