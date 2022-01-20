<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaires extends Model
{
    use HasFactory;
    protected $table = "commentaires";
    protected $primaryKey = "id_commentaire";

    public function roman() {
        return $this->hasOne('App\Models\Romans', 'id_roman', 'id_roman');
    }

    public function user() {
        return $this->hasOne('App\Models\User', 'user_id', 'user_id');
    }
}
