<?php

namespace app\Http\Controllers\Pof;

use Carbon\Carbon;
use App\Models\Pof\PofCarte;
use App\Models\Pof\PofTarif;
use Illuminate\Http\Request;

use App\Traits\Pof\FactureTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CarteController extends Controller {
    
    use FactureTrait;

    public function carteAjoutQuantiteModal(Request $request) {
        
        $carte = PofCarte::find($request->id_carte);
        
        return response()->json([
            'view' => view('pony.carte.carte_ajout_quantite_modal', compact('carte'))->render()
        ]);
    }

    public function carteAjoutQuantite(Request $request) {
        
        $carte = PofCarte::find($request->id_carte);
        
        $quantite = $request->quantite;
        
        if($tarif = PofTarif::find($request->id_tarif)) {
            $quantite = $tarif->quantite;
        }
        
        if($quantite == 0) {
            
            $erreur = 'La quantité ne peut pas être 0.';
            return $this->getErrorModal($erreur);
            
        }
        
        $message = $this->factureCreer(null,$carte,$quantite,null,$tarif, null);
        
        if(!$message[1]) {
            
            return $this->getErrorModal($message[2]);
        }
        
        return redirect()->route('afficherClientDetails', ['id_client' => $carte->id_client]);
    }

    public function carteSupprimerModal(Request $request) {
        
        $carte = PofCarte::find($request->id_carte);
        
        return response()->json([
            'view' => view('pony.carte.carte_supprimer_modal', compact('carte'))
                ->render()
        ]);
    }

    public function carteSupprimer(Request $request) {
        
        $carte = PofCarte::find($request->id_carte);
        $id_client = $carte->id_client;
        
        $carte->delete();
        
        return redirect()->route('afficherClientDetails', ['id_client' => $id_client]);
    }
}