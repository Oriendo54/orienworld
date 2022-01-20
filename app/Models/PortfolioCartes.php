<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioCartes extends Model
{
    use HasFactory;
    protected $table = "portfolio_cartes";
    protected $primaryKey = "id_carte";
}
