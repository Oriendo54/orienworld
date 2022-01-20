<?php

namespace app\Http\Controllers\Pof;

use Carbon\Carbon;

use App\Models\User;
use App\Models\Pof\PofTva;
use App\Models\Pof\PofRole;
use App\Models\Pof\PofUser;
use App\Models\Pof\PofTarif;
use Illuminate\Http\Request;
use App\Models\Pof\PofCharge;
use App\Models\Pof\PofFacture;
use App\Models\Pof\PofUserRole;
use Illuminate\Validation\Rule;
use App\Models\Pof\PofCoursType;
use App\Models\Pof\PofMoniteurs;
use App\Traits\Pof\FactureTrait;

use App\Mail\UserInscriptionMail;
use App\Models\Pof\PofPrestation;
use Illuminate\Support\Facades\DB;
use App\Models\Pof\PofChevalCharge;
use App\Models\Pof\PofClientStatut;
use App\Http\Controllers\Controller;

use App\Models\Pof\PofFactureDetail;
use App\Models\Pof\PofMoyenPaiement;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Pof\PofPrestationType;
use App\Models\Pof\PofPrestationgroupe;
use Illuminate\Support\Facades\Validator;
use App\Models\Pof\PofPrestationgroupeLien;
use App\Models\Pof\PofPrestationassociation;
use App\Models\Pof\PofPrestationassociationLien;

class ParamController extends Controller {

    use FactureTrait;

    // PARAMETRES UTILISATEUR

    public function param() {
        $prestations = PofPrestation::orderBy('id_prestation_type')
                ->orderBy('id_cours_type')
                ->orderBy('id_client_statut')
                ->orderBy('duree')
                ->orderBy('age_min_client')
                ->orderBy('id_tva')
                ->orderBy('libelle')
                ->get()
                ;
        
        $groupes = PofPrestationgroupe::orderBy('id_prestation_groupe', 'desc')->get();

        $charges = PofCharge::all();
        
        return view('pony.param.param', compact('prestations', 'groupes', 'charges'));
    }
    
    
    public function paramPrestationAjoutModal(Request $request) {
        
        if($request->id_prestation) {
            $prestation = PofPrestation::find($request->id_prestation);
        } else {
            $prestation = null;
        }
        
        $prestationtypes = PofPrestationType::all();
        $courstypes = PofCoursType::all();
        $clientstatuts = PofClientStatut::all();
        $tvas = PofTva::all();
        
        return response()->json([
            'view' => view('pony.param.param_prestation_ajout_modal', compact('prestationtypes','prestation','clientstatuts','tvas','courstypes'))
                ->render()
        ]);
    }
    
    
    public function paramPrestationAjout(Request $request) {
        
        $prestation_modif = PofPrestation::find($request->id_prestation);
                
        $validator = Validator::make($request->all(), [
            'prestation_libelle'=> 'required|min:3',
            'prestation_id_tva'=> 'required|numeric',
            'prestation_id_prestation_type'=> 'required|numeric',
            'prestation_id_cours_type'=> 'required|numeric',
            'prestation_id_client_statut'=> 'required|numeric',
            'prestation_age_min_client'=> 'nullable|numeric',
            'prestation_age_max_client'=> 'nullable|numeric',
            'prestation_duree'=> 'required|min:8'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['return'=>0,'error'=>$validator->errors()]);
        }
        
        if(!$this->paramPrestationMAJ($prestation_modif, $request)) {
             
            $alerte = "Prestation avec un paramétrage identique déjà existante";
            $error = $this->getErrorModal($alerte);
            return $error;
        }
        
        $prestations = PofPrestation::orderBy('id_prestation_type')
                ->orderBy('id_tva')
                ->orderBy('id_cours_type')
                ->orderBy('id_client_statut')
                ->orderBy('duree')
                ->orderBy('age_min_client')
                ->orderBy('libelle')
                ->get()
                ;

        return view('pony.param.param_prestation', compact('prestations'));
    }
    
    
    public function paramPrestationMAJ(PofPrestation $prestation = null, Request $request) {
        
        if($prestation == null) {
            
            $prestation = new PofPrestation;
        }
        
        // prestation identique impossible pour un type de prestation carte
        if($prestationindentique = PofPrestation::where([
            ['id_prestation','!=',$request->id_prestation],
            ['pof_prestation.id_prestation_type',$request->prestation_id_prestation_type],
            ['id_cours_type',$request->prestation_id_cours_type],
            ['id_client_statut',$request->prestation_id_client_statut],
            ['age_min_client',$request->prestation_age_min_client],
            ['age_max_client',$request->prestation_age_max_client],
            ['duree',$request->prestation_duree]
                ])
                ->join('pof_prestation_type','pof_prestation_type.id_prestation_type','=','pof_prestation.id_prestation_type')
                ->where('pof_prestation_type.code','CAR')
                ->first()) {
            return false;
        }

        if($request->prestation_libelle) {
            $prestation->libelle = $request->prestation_libelle;
        }
        
        if($request->prestation_id_tva) {
            $prestation->id_tva = $request->prestation_id_tva;
        }
        
        if($request->prestation_id_prestation_type) {
            $prestation->id_prestation_type = $request->prestation_id_prestation_type;
        }
        
        if($request->prestation_id_cours_type or $request->prestation_id_cours_type == 0) {
            $prestation->id_cours_type = $request->prestation_id_cours_type;
        }
        
        if($request->prestation_id_client_statut or $request->prestation_id_client_statut == 0) {
            $prestation->id_client_statut = $request->prestation_id_client_statut;
        }
        
        if($request->prestation_age_min_client) {
            $prestation->age_min_client = $request->prestation_age_min_client;
        } else {
            $prestation->age_min_client = 0;
        }
        
        if($request->prestation_age_max_client) {
            $prestation->age_max_client = $request->prestation_age_max_client;
        } else {
            $prestation->age_max_client = 99;
        }
        
        if($request->prestation_duree) {
            $prestation->duree = $request->prestation_duree;
        }
        
        $prestation->save();

        return true;
    }


    public function paramPrestationSupprModal(Request $request) {
        $prestation = PofPrestation::find($request->id_prestation);
        $element = 'cette prestation';
        $message = 'Attention, l\'ensemble des tarifs associés seront également supprimés.';
        $function = 'paramPrestationSupprimer('.$prestation->id_prestation.')';

        return response()->json([
            'view' => view('pony.delete_warning_modal', compact('function', 'element', 'message'))
                ->render()
        ]);
    }


    public function paramPrestationSupprimer(Request $request) {
        $prestation = PofPrestation::find($request->id_prestation);
        $tarifs = $prestation->poftarifs;

        $facture_details = PofFactureDetail::all();

        foreach($facture_details as $facturedetail) {
            if($facturedetail->id_prestation == $prestation->id_prestation) {
                $erreur = 'Impossible de supprimer cette prestation, une facture au moins l\'utilise.';
                return $this->getErrorModal($erreur);
            }
        }

        foreach($tarifs as $tarif) {
            $tarif->delete();
        }
        $prestation->delete();

        return;
    }


    public function paramTarifSupprModal(Request $request) {
        $tarif = PofTarif::find($request->id_tarif);
        $element = 'ce tarif';
        $function = 'paramTarifSupprimer('.$tarif->id_tarif.')';
        
        return response()->json([
            'view' => view('pony.delete_warning_modal', compact('element', 'function'))
                ->render()
        ]);
    }


    public function paramTarifSupprimer(Request $request) {
        $tarif = PofTarif::find($request->id_tarif);
        $facture_details = PofFactureDetail::all();

        foreach($facture_details as $facturedetail) {
            if($facturedetail->id_tarif == $tarif->id_tarif) {
                $erreur = 'Impossible de supprimer ce tarif, une facture au moins l\'utilise.';
                return $this->getErrorModal($erreur);
            }
        }

        $tarif->delete();

        return;
    }
    
    
    public function paramPrestationTarif(Request $request) {
        
        $prestation = PofPrestation::find($request->id_prestation);
          
        return view('pony.param.param_prestation_tarif', compact('prestation'));
    }
    
    
    public function paramTarifAjoutModal(Request $request) {
        
        $prestation = PofPrestation::find($request->id_prestation);
        
        if($request->id_tarif) {
            $tarif = PofTarif::find($request->id_tarif);
        } else {
            $tarif = null;
        }
        
        return response()->json([
            'view' => view('pony.param.param_prestation_tarif_ajout_modal', compact('prestation','tarif'))
                ->render()
        ]);
    }
    
    
    public function paramTarifAjout(Request $request) {
        
        $prestation = PofPrestation::find($request->id_prestation);
        $tarif_modif = PofTarif::find($request->id_tarif);
                
        $validator = Validator::make($request->all(), [
            'tarif_prix_ttc'=> 'required|numeric',
            'tarif_pourcentage'=> 'nullable|numeric',
            'tarif_quantite'=> 'nullable|numeric',
            'tarif_date_debut'=> 'required|min:10',
            'tarif_date_fin'=> 'required|min:10'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['return'=>0,'error'=>$validator->errors()]);
        }
        
        if($request->tarif_date_fin < $request->tarif_date_debut) {
             
            $alerte = "La date de fin ne peut pas être inférieur à la date de début";
            $error = $this->getErrorModal($alerte);
            return $error;
        }

        
        if(!$this->paramTarifMAJ($prestation, $tarif_modif, $request)) {
             
            $alerte = "Tarif avec un paramétrage identique déjà existant";
            $error = $this->getErrorModal($alerte);
            return $error;
        }

        return view('pony.param.param_prestation_tarif', compact('prestation'));
    }
    
    
    public function paramTarifMAJ(PofPrestation $prestation, PofTarif $tarif = null, Request $request) {
        
        $tarif_date_fin = $request->tarif_date_fin;
        $tarif_date_debut = $request->tarif_date_debut;
        
        $tarifindentique = PofTarif::where([
            ['id_prestation',$request->id_prestation],
            ['pourcentage',$request->tarif_pourcentage],
            ['quantite',$request->tarif_quantite]
                ])
            ->where(function($query) use ($tarif_date_fin,$tarif_date_debut){
                $query->whereBetween('date_fin', [$tarif_date_debut, $tarif_date_fin])
                    ->orWhereBetween('date_debut', [$tarif_date_debut, $tarif_date_fin])
                    ->orWhere([['date_debut','<=',$tarif_date_debut],['date_fin','>=',$tarif_date_fin]])
                    ;
            });
        
        if($tarif) {
            $tarifindentique = $tarifindentique
                ->where('id_tarif','!=',$tarif->id_tarif);
        }
            
        $tarifindentique = $tarifindentique->first();
        
        if($prestation->pofprestationtype->id_prestation_type == 1 && $tarifindentique) {
                
            return false;
        }
            
        if($tarif == null) {
            
            $tarif = new PofTarif;
            $tarif->id_prestation = $prestation->id_prestation;
        }
        
        if($request->tarif_prix_ttc>=0) {
            $tarif->prix_ttc = $request->tarif_prix_ttc;
            $tarif->prix_ht = $tarif->prix_ttc / (1+$prestation->poftva->taux/100);
        }
        
        $tarif->pourcentage = $request->tarif_pourcentage;
        
        if($request->tarif_quantite) {
            $tarif->quantite = $request->tarif_quantite;
        } else {
            $tarif->quantite = 1;
        }
        
        if($request->tarif_date_debut) {
            $tarif->date_debut = $request->tarif_date_debut;
        }
        
        if($request->tarif_date_fin) {
            $tarif->date_fin = $request->tarif_date_fin;
        }
        
        if($request->tarif_libelle) {
            $tarif->libelle = $request->tarif_libelle;
        } else {
            $tarif->libelle = $prestation->libelle;
        }
        
        $tarif->save();

        return true;
    }
    
    
    public function paramPrestationAssociation(Request $request) {
        
        $prestation = PofPrestation::find($request->id_prestation);
          
        return view('pony.param.param_prestation_association', compact('prestation'));
    }
    
    
    public function paramPrestationAssociationAjoutModal(Request $request) {
        
        $prestation = PofPrestation::find($request->id_prestation);
        
        if($request->id_prestation_association) {
            $prestation_association = PofPrestationassociation::find($request->id_prestation_association);
        } else {
            $prestation_association = null;
        }
        
        $prestations = PofPrestation::where('id_prestation','!=',$prestation->id_prestation);
        
        if($prestation->pofprestationassociationlien) {
            
            $id_prestation_association = $prestation->pofprestationassociationlien->pofprestationassociation->id_prestation_association;
            
            $prestations = $prestations->whereNotIn('id_prestation', function($q) use($id_prestation_association){
                    $q->select('pof_prestation_association_lien.id_prestation')
                    ->from('pof_prestation_association_lien')
                    ->where('pof_prestation_association_lien.id_prestation_association',$id_prestation_association);
                });
        }
                
        $prestations = $prestations->get();
        
        return response()->json([
            'view' => view('pony.param.param_prestation_association_ajout_modal', compact('prestation','prestation_association','prestations'))
                ->render()
        ]);
    }
    
    
    public function paramPrestationAssociationAjout(Request $request) {
        
        $prestation = PofPrestation::find($request->id_prestation);
                
        $validator = Validator::make($request->all(), [
            'prestationassociation_id_prestation'=> 'required|numeric'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['return'=>0,'error'=>$validator->errors()]);
        }
        
        if(!$prestation->pofprestationassociationlien) {
            
            $prestation_association = new PofPrestationassociation;
            $prestation_association->save();
            
            $prestation_association_prestation_principale = new PofPrestationassociationLien;
            $prestation_association_prestation_principale->id_prestation_association = $prestation_association->id_prestation_association;
            $prestation_association_prestation_principale->id_prestation = $prestation->id_prestation;
            $prestation_association_prestation_principale->prestation_principale = 1;
            $prestation_association_prestation_principale->save();
            
        } else {
            $prestation_association = $prestation->pofprestationassociationlien->pofprestationassociation;
        }
        
        $prestation_association_lien = new PofPrestationassociationLien;
        $prestation_association_lien->id_prestation_association = $prestation_association->id_prestation_association;
        $prestation_association_lien->id_prestation = $request->prestationassociation_id_prestation;
        
        $prestation_association_lien->save();
        
        return true;
    }
    
    
    public function paramPrestationAssociationSupprModal(Request $request) {
        
        $prestation_association_lien = PofPrestationassociationLien::find($request->id_prestation_association_lien);
        
        $prestation_association_prestation_principale = PofPrestationassociationLien::where([
            ['id_prestation_association',$prestation_association_lien->id_prestation_association],
            ['prestation_principale',1]
            ])->first();
        
        $prestation_association_lien->delete();
        
        if(count(PofPrestationassociationLien::where([
            ['id_prestation_association',$prestation_association_lien->id_prestation_association]
            ])->get())==1) {
            
            $prestation_association = $prestation_association_prestation_principale->pofprestationassociation;
            $prestation_association->delete();
            
            $prestation_association_prestation_principale->delete();
        }
        
        return response()->json([
            'id_prestation' => $prestation_association_prestation_principale->id_prestation
        ]);
    }
    

    public function paramPrestationGroupe(Request $request) {
        $groupe = PofPrestationgroupe::find($request->id_prestation_groupe);
              
        return view('pony.param.param_prestation_groupe_prestations', compact('groupe'));
    }

    
    public function paramPrestationGroupeAjoutModal(Request $request) {
        $prestations = PofPrestation::get();
        
        if($request->id_prestation_groupe) {
            $creer_groupe = null;
            $groupe = PofPrestationgroupe::find($request->id_prestation_groupe);
        }
        else {
            $creer_groupe = true;
            $groupe = null;
        }

        return response()->json([
            'view' => view('pony.param.param_prestation_groupe_ajout_modal', compact('prestations', 'creer_groupe', 'groupe'))
                ->render()
        ]);
    }

    
    public function paramPrestationGroupeAjout(Request $request) {
        $validator = Validator::make($request->all(), [
            'groupe_id_prestation1'=> 'required|numeric',
            'groupe_id_prestation2'=> 'nullable|numeric',
            'groupe_libelle'=> 'nullable|string',
            'action'=> 'required|string',
            'id_prestation_groupe'=> 'nullable|numeric'
        ]);
        
        if($request->action == 'new') {
            $groupe = $this->paramPrestationCreerGroupe($request);
        }
        else {
            $groupe = $this->paramPrestationGroupeUpdate($request);
        }
        return $groupe;
    }


    public function paramPrestationCreerGroupe(Request $request) {
        if($request->id_prestation1 == $request->id_prestation2) {
            $erreur = 'Erreur : impossible de sélectionner deux fois la même prestation';
            return response()->json([
                'view' => view('pony.erreur_modal', compact('erreur'))
                    ->render(),
                'erreur'=> true
            ]);
        }

        $groupe = new PofPrestationgroupe;
        $groupe->libelle = $request->groupe_libelle;
        $groupe->save();

        $prestations = [$request->id_prestation1, $request->id_prestation2];
        for($i=0; $i<count($prestations); $i++) {
            $groupe_lien = new PofPrestationgroupeLien;
            $groupe_lien->id_prestation_groupe = $groupe->id_prestation_groupe;
            $groupe_lien->id_prestation = $prestations[$i];
            $groupe_lien->save();
        }

        $prestations = PofPrestation::get();
        $groupes = PofPrestationgroupe::get();

        return response()->json([
            'creer' => true,
            'view' => view('pony.param.param_prestation_groupe', compact('prestations', 'groupes'))
                ->render()
        ]);
    }

    
    public function paramPrestationGroupeUpdate(Request $request) {
        $groupe = PofPrestationgroupe::find($request->id_prestation_groupe);

        $groupe_lien = new PofPrestationgroupeLien;
        $groupe_lien->id_prestation_groupe = $groupe->id_prestation_groupe;
        $groupe_lien->id_prestation = $request->id_prestation1;
        $groupe_lien->save();

        $groupe->libelle = $request->groupe_libelle;
        $groupe->save();

        return response()->json([
            'update' => true
        ]);
    }


    public function paramPrestationGroupeSupprPrestation(Request $request) {
        $prestation_lien = PofPrestationgroupeLien::where('id_prestation_groupe', $request->id_prestation_groupe)
            ->where('id_prestation', $request->id_prestation)
            ->first()
            ->delete();

        return true;
    }


    public function paramPrestationSupprGroupeModal(Request $request) {
        $groupe = PofPrestationgroupe::find($request->id_prestation_groupe);

        $element = 'ce groupe de prestations';
        $function = 'paramPrestationSupprGroupe('.$groupe->id_prestation_groupe.')';

        return response()->json([
            'view' => view('pony.delete_warning_modal', compact('element', 'function'))
                ->render()
        ]);
    }

    
    public function paramPrestationSupprGroupe(Request $request) {
        $groupe = PofPrestationgroupe::find($request->id_prestation_groupe);
        $liens = $groupe->pofprestationgroupeliens;

        foreach($liens as $lien) {
            $lien->delete();
        }
        $groupe->delete();

        $groupes = PofPrestationgroupe::get();
        $prestations = PofPrestation::get();

        return response()->json([
            'view'=> view('pony.param.param_prestation_groupe', compact('prestations', 'groupes'))
                ->render()
        ]);
    }


    public function paramPrestationGroupeTarif(Request $request) {
        $groupe_liens = PofPrestationgroupeLien::where('id_prestation_groupe', $request->id_prestation_groupe)->get();
        
        $prestations_id = [];
        foreach($groupe_liens as $groupe_lien) {
            array_push($prestations_id, $groupe_lien->id_prestation);
        }
        $tarifs = PofTarif::whereIn('id_prestation', $prestations_id)
                    ->where('quantite', 1)
                    ->get();

        $groupe = PofPrestationgroupe::find($request->id_prestation_groupe);
        
        return view('pony.param.param_prestation_groupe_tarifs', compact('tarifs', 'groupe'));
    }


    public function paramPrestationGroupeTarifDefautModal(Request $request) {
        $groupe_lien = PofPrestationgroupeLien::find($request->id_prestation_groupe_lien);
        $prestation = $groupe_lien->pofprestation;
        $tarifs = PofTarif::where('id_prestation', $prestation->id_prestation)->get();

        if(count($tarifs) < 1) {
            $erreur = 'Erreur : aucun tarif disponible pour cette prestation. Veuillez créer un tarif.';
            return response()->json([
                'view' => view('pony.erreur_modal', compact('erreur'))
                    ->render(),
                'erreur'=> true
            ]);
        }

        return response()->json([
            'view' => view('pony.param.param_prestation_choix_tarif_defaut_modal', compact('groupe_lien', 'tarifs', 'prestation'))
                ->render()
        ]);
    }


    public function paramPrestationGroupeTarifDefaut(Request $request) {
        $groupe_lien = PofPrestationgroupeLien::find($request->id_prestation_groupe_lien);
        $groupe_lien->id_tarif_defaut = $request->id_tarif;
        $groupe_lien->save();

        $groupe = $groupe_lien->pofprestationgroupe;

        return response()->json([
            'view' => view('pony.param.param_prestation_groupe_tarifs', compact('groupe'))
                ->render()
        ]);
    }

    public function paramAfficherCharges() {
        $charges = PofCharge::all();

        return response()->json([
            'view' => view('pony.param.param_charge_chevaux', compact('charges'))
                ->render()
        ]);
    }

    public function paramCreerChargeModal(Request $request) {
        $charge = PofCharge::find($request->id_charge);

        return response()->json([
            'view' => view('pony.param.param_creer_charge_modal', compact('charge'))
                ->render()
        ]);
    }

    public function paramCreerCharge(Request $request) {
        if(!$charge = PofCharge::find($request->id_charge)) {
            $charge = new PofCharge;
        }
        $charge->libelle = $request->libelle;
        $charge->periodicite = $request->periodicite;
        $charge->montant = $request->montant;
        $charge->save();

        return $this->paramAfficherCharges();
    }

    public function paramSupprChargeModal(Request $request) {
        $charge = PofCharge::find($request->id_charge);
        $element = 'cette charge';
        $function = 'paramSupprimerCharge('.$charge->id_charge.')';

        return response()->json([
            'view' => view('pony.delete_warning_modal', compact('element', 'function'))
                ->render()
        ]);
    }

    public function paramSupprimerCharge(Request $request) {
        $charge = PofCharge::find($request->id_charge);

        if(count($charge_chevaux = PofChevalCharge::where('id_charge', $charge->id_charge)->get()) > 0) {
            $erreur = 'impossible de supprimer cette charge, elle est utilisée dans le calcul des statistiques des chevaux';
            return $this->getErrorModal($erreur);
        }
        else {
            $charge->delete();
        }

        return $this->paramAfficherCharges();
    }
}