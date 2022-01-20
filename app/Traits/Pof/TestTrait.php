<?php
 
namespace App\Traits\Pof;

use Illuminate\Support\Facades\DB;

trait TestTrait {

    // Fonction permettant d'afficher dans la console du navigateur une variable depuis php
    public function console_log( $data )
    {
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }
}