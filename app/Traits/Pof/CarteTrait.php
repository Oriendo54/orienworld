<?php
 
namespace App\Traits\Pof;

use Illuminate\Support\Facades\DB;

use App\Models\Pof\PofCarte;
use App\Models\Pof\PofClient;
use App\Models\Pof\PofPrestation;

trait CarteTrait {
 
    public function carteMAJ(PofCarte $carte = null, PofClient $client = null, PofPrestation $prestation = null, $solde = null) {
        
        if(!$carte) {
            $carte = new PofCarte;
        }
        
        if($client) { 
            $carte->id_client = $client->id_client;
        }
        
        if($prestation) {
            $carte->id_prestation = $prestation->id_prestation;
        }
        
        if($solde || $solde === 0) {
            $carte->solde = $solde;
        }
        
        $carte->save();
        
        return $carte;
    }
}