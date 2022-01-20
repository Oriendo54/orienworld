<?php

namespace app\Http\Controllers\Pof;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Pof\PofCharge;
use App\Models\Pof\PofCheval;

use Illuminate\Validation\Rule;
use App\Models\Pof\PofChevalType;
use Illuminate\Support\Facades\DB;
use App\Models\Pof\PofChevalCharge;
use App\Http\Controllers\Controller;
use App\Models\Pof\PofClientChevalStatut;
use Illuminate\Support\Facades\Validator;

class EcurieController extends Controller {

    public function ecurie() {
        $chevaux = PofCheval::orderby('nom')
                ->get()
                ;
        $client_cheval_statuts = PofClientChevalStatut::all();

        return view('pony.ecurie.ecurie', compact('chevaux','client_cheval_statuts'));
    }
    
    
    public function ecurieChevalAjoutModal(Request $request) {
        
        if($request->id_cheval) {
            $cheval = PofCheval::find($request->id_cheval);
        } else {
            $cheval = null;
        }
        
        $chevaltypes = PofChevalType::all();
        
        return response()->json([
            'view' => view('pony.ecurie.ecurie_cheval_ajout_modal', compact('chevaltypes', 'cheval'))
                ->render()
        ]);
    }
    
    
    public function ecurieChevalAjout(Request $request) {
        
        $cheval_modif = PofCheval::find($request->id_cheval);
                
        $validator = Validator::make($request->all(), [
            'cheval_nom'=> 'required|min:3',
            'cheval_date_naissance'=> 'required|min:3',
            'cheval_id_cheval_type'=> 'required|numeric',
            'cheval_actif'=> 'required|numeric'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['return'=>0,'error'=>$validator->errors()]);
        }
        
        $this->ecurieChevalMAJ($cheval_modif, $request);
        
        $chevaux = PofCheval::all();

        return view('pony.ecurie.ecurie_chevaux', compact('chevaux'));
    }
    
    
    public function ecurieChevalMAJ(PofCheval $cheval = null, Request $request) {
        
        if($cheval == null) {
            $cheval = new PofCheval;
        }

        if($request->cheval_nom) {
            $cheval->nom = $request->cheval_nom;
        }
        if($request->cheval_date_naissance) {
            $cheval->date_naissance = $request->cheval_date_naissance;
        }
        if($request->cheval_id_cheval_type) {
            $cheval->id_cheval_type = $request->cheval_id_cheval_type;
        }
        $cheval->actif = $request->cheval_actif;
        
        $cheval->save();

        return $cheval;
    }
    
    
    public function ecurieClientChevalStatutAjoutModal(Request $request) {
        
        if($request->id_client_cheval_statut) {
            $client_cheval_statut = PofClientChevalStatut::find($request->id_client_cheval_statut);
        } else {
            $client_cheval_statut = null;
        }
        
        return response()->json([
            'view' => view('pony.ecurie.ecurie_client_cheval_statut_ajout_modal', compact('client_cheval_statut'))
                ->render()
        ]);
    }
    

    public function ecurieClientChevalStatutAjout(Request $request) {
        
        $client_cheval_statut = PofClientChevalStatut::find($request->id_client_cheval_statut);
                
        $validator = Validator::make($request->all(), [
            'clientchevalstatut_libelle'=> 'required|min:3'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['return'=>0,'error'=>$validator->errors()]);
        }
        
        $client_cheval_statut = $this->ecurieClientChevalSatutMAJ($client_cheval_statut, $request);
        
        $client_cheval_statuts = PofClientChevalStatut::all();

        return view('pony.ecurie.ecurie_client_cheval_statut', compact('client_cheval_statuts'));
    }
    

    public function ecurieClientChevalSatutMAJ(PofClientChevalStatut $client_cheval_statut = null, Request $request) {
        
        if($client_cheval_statut == null) {
            $client_cheval_statut = new PofClientChevalStatut;
        }

        $client_cheval_statut->libelle = $request->clientchevalstatut_libelle;
        
        $client_cheval_statut->save();

        return $client_cheval_statut;
    }


    public function ecurieChevalAfficherCharges(Request $request) {
        $cheval = PofCheval::find($request->id_cheval);

        $cheval_charges = $cheval->pofchevalcharges;

        return response()->json([
            'view' => view('pony.ecurie.ecurie_cheval_charges', compact('cheval_charges', 'cheval'))
                ->render()
        ]);
    }

    public function ecurieChargeAttribuerChevauxModal(Request $request) {
        $cheval_charge = PofChevalCharge::find($request->id_cheval_charge);
        $charges = PofCharge::all();
        $chevaux = PofCheval::where('actif', 1)->get();

        return response()->json([
            'view' => view('pony.ecurie.ecurie_charge_attribuer_chevaux_modal', compact('charges', 'chevaux', 'cheval_charge'))
                ->render()
        ]);
    }

    public function ecurieChargeAttribuerChevaux(Request $request) {
        if($cheval_charge = PofChevalCharge::find($request->id_cheval_charge)) {
            $cheval_charge->id_charge = $request->id_charge;
            $cheval_charge->precision = $request->precision;
            $cheval_charge->montant = $request->montant;
            $cheval_charge->date_facturation = $request->date_facturation;
            if(!$request->date_debut) {
                $cheval_charge->date_debut = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
            }
            else {
                $cheval_charge->date_debut = $request->date_debut;
            }
            if(!$request->date_fin) {
                $cheval_charge->date_fin = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');
            }
            else {
                $cheval_charge->date_fin = $request->date_fin;
            }
            $cheval_charge->save();

            $cheval = $cheval_charge->pofcheval;
            $cheval_charges = $cheval->pofchevalcharges;

            return response()->json([
                'view' => view('pony.ecurie.ecurie_cheval_charges', compact('cheval_charges', 'cheval'))
                    ->render(),
                'id_cheval' => $cheval->id_cheval,
                'edit' => true
            ]);
        }

        $charge = PofCharge::find($request->id_charge);
        $chevaux = PofCheval::whereIn('id_cheval', $request->id_chevaux)->get();

        if(count($chevaux) == 0) {
            return $this->getErrorModal('sélectionnez au moins un cheval pour continuer !');
        }

        $message = 'La charge '.$charge->libelle.' a été attribuée pour ';

        foreach($chevaux as $cheval) {
            $cheval_charge = new PofChevalCharge;
            $cheval_charge->id_cheval = $cheval->id_cheval;
            $cheval_charge->id_charge = $charge->id_charge;
            $cheval_charge->date_facturation = $request->date_facturation;
            if(!$request->date_debut) {
                $cheval_charge->date_debut = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
            }
            else {
                $cheval_charge->date_debut = $request->date_debut;
            }
            if(!$request->date_fin) {
                $cheval_charge->date_fin = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');
            }
            else {
                $cheval_charge->date_fin = $request->date_fin;
            }
            $cheval_charge->precision = $request->precision;
            $cheval_charge->montant = $request->montant;
            $cheval_charge->save();

            $message .= $cheval->nom.', ';
        }

        return response()->json([
            'view' => view('pony.message_modal', compact('message'))
                ->render()
        ]);
    }


    public function ecurieSupprChevalChargeModal(Request $request) {
        $cheval_charge = PofChevalCharge::find($request->id_cheval_charge);

        $element = 'cette charge';
        $function = 'ecurieSupprimerChevalCharge('.$cheval_charge->id_cheval_charge.', '.$cheval_charge->id_cheval.')';

        return response()->json([
            'view' => view('pony.delete_warning_modal', compact('element', 'function'))
                ->render()
        ]);
    }


    public function ecurieSupprimerChevalCharge(Request $request) {
        $cheval_charge = PofChevalCharge::find($request->id_cheval_charge);
        $cheval = PofCheval::find($cheval_charge->id_cheval);

        $cheval_charge->delete();
        $cheval_charges = $cheval->pofchevalcharges;

        return response()->json([
            'view' => view('pony.ecurie.ecurie_cheval_charges', compact('cheval_charges', 'cheval'))
                ->render()
        ]);
    }


    public function ecurieAppliquerChargesMensuelles() {
        $charges = PofCharge::where('periodicite', 'mensuel')
            ->whereDate('date_expiration', '>', Carbon::now())
            ->get();

        $this->pofLog($charges);
        
        $chevaux = PofCheval::all();

        foreach($chevaux as $cheval) {
            foreach($charges as $charge) {
                // On vérifie que la charge correspond bien au type de cheval
                if($charge->id_cheval_type === $cheval->id_cheval_type || ($cheval->id_cheval_type == 1 && $charge->id_cheval_type == 2)) {
                    // On vérifie si la charge a déjà été appliquée ce mois-ci
                    if(!$cheval_charge = PofChevalCharge::where('id_cheval', $cheval->id_cheval)
                    ->where('id_charge', $charge->id_charge)
                    ->whereBetween('date_facturation', [Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->endOfMonth()->format('Y-m-d')])
                    ->first()) {
                        $cheval_charge = new PofChevalCharge;
                        $cheval_charge->id_cheval = $cheval->id_cheval;
                        $cheval_charge->id_charge = $charge->id_charge;
                        $cheval_charge->date_debut = Carbon::now()->startOfMonth();
                        $cheval_charge->date_fin = Carbon::now()->endOfMonth();
                        $cheval_charge->montant = $charge->montant;
                        $cheval_charge->save();
                    }
                }
            }
        }
        
        return;
    }
}