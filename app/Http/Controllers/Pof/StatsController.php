<?php

namespace App\Http\Controllers\Pof;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Pof\PofCheval;
use App\Traits\Pof\ChevalTrait;
use App\Http\Controllers\Controller;
use Illuminate\Translation\Translator;

class StatsController extends Controller
{
    use ChevalTrait;
    
    public function stats() {

        $chevaux = PofCheval::where('actif', 1)->get();
        
        return view('pony.stats.statistiques', compact('chevaux'));
    }


    public function chevalChargesBenefices(Request $request) {
        $date_debut = $request->date_debut;
        $date_fin = $request->date_fin;

        $charges_benefices = [];
        if($request->inactifs == true) {
            $chevaux = PofCheval::all();
        } 
        else {
            $chevaux = PofCheval::where('actif', 1)->get();
        }

        foreach($chevaux as $cheval) {

            $charges_benefices[] = ['id_cheval' => $cheval->id_cheval,
                                    'nom' => $cheval->nom,
                                    'charges' => $this->chevalCalculerCharges($cheval, $date_debut, $date_fin),
                                    'cours' => $this->chevalCalculerBeneficesCours($cheval, $date_debut, $date_fin),
                                    'travail' => $this->chevalCalculerBeneficesTravail($cheval, $date_debut, $date_fin),
                                    'pension' => $this->chevalCalculerBeneficesPension($cheval, $date_debut, $date_fin),
                                    'benefices' => $this->chevalCalculerBeneficesCours($cheval, $date_debut, $date_fin) 
                                        + $this->chevalCalculerBeneficesTravail($cheval, $date_debut, $date_fin) 
                                        + $this->chevalCalculerBeneficesPension($cheval, $date_debut, $date_fin)];
        }

        return response()->json([
            'view' => view('pony.stats.benefices_chevaux', compact('charges_benefices'))
                ->render()
        ]);
    }
}
