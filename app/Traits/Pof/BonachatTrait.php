<?php
 
namespace App\Traits\Pof;

use Carbon\Carbon;

use App\Models\Pof\PofBonachat;
use App\Models\Pof\PofClient;
use App\Models\Pof\PofFacture;

use Illuminate\Support\Facades\DB;

trait BonachatTrait {

    public function desactiverBonachatsExpires(PofFacture $facture = null, Pofclient $client = null) {
        if($facture) {
            $client = $facture->pofclient;
        }
        
        if($client) {
            $bonachats = $client->pofbonachats;
        } else {
            $bonachats = PofBonachat::all();
        }

        foreach($bonachats as $bonachat) {
            // Si le bon d'achat a été intégralement utilisé, on le désactive
            if($bonachat->restant == 0 && $bonachat->actif == 1) {
                $bonachat->actif = 0;
                $bonachat->save();
            }

            $date_expiration = explode(' ', $bonachat->date_expiration);
            // Si la date d'expiration du bon d'achat est dépassée, on le désactive
            if(Carbon::createFromFormat('Y-m-d', $date_expiration[0]) < Carbon::now()) {
                $bonachat->actif = 0;
                $bonachat->save();
            }
        }

        return $bonachats;
    }
}