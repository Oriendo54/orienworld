<?php

namespace App\Http\Controllers\Pof;

use Carbon\Carbon;
use App\Models\Pof\PofTarif;
use Illuminate\Http\Request;
use App\Models\Pof\PofCheval;
use App\Models\Pof\PofClient;
use App\Traits\Pof\ClientTrait;
use App\Traits\Pof\FactureTrait;
use App\Models\Pof\PofAbonnement;
use App\Models\Pof\PofPrestation;
use Illuminate\Support\Facades\DB;
use App\Traits\Pof\PrestationTrait;
use App\Http\Controllers\Controller;
use App\Models\Pof\PofAbonnementClient;
use App\Models\Pof\PofPrestationgroupe;
use App\Models\Pof\PofAbonnementPrestation;

class AbonnementController extends Controller
{
    use FactureTrait;
    use ClientTrait;
    use PrestationTrait;

    public function abonnementCreerModal(Request $request) {
        $client = PofClient::find($request->id_client);

        $prestations = $this->clientPrestationCompatibles($client);
        $groupes = $this->clientPrestationgroupeCompatibles($client);

        return response()->json([
            'view' => view('pony.abonnements.abonnement_creer_modal', compact('client', 'prestations', 'groupes'))
                ->render()
        ]);
    }


    public function abonnementChoixTarifModal(Request $request)
    {
        $client = PofClient::find($request->id_client);

        if($request->id_prestation && $request->id_prestation_groupe) {
            $erreur = 'Vous ne pouvez pas sélectionner une prestation et un groupe de prestations simultanément.';
            return response()->json([
                'view' => view('pony.erreur_modal', compact('erreur'))
                    ->render(),
                'erreur' => $erreur
            ]);
        }
        
        if(!$request->id_prestation && !$request->id_prestation_groupe) {
            $erreur = 'Sélectionnez une prestation ou un groupe pour pouvoir continuer.';
            return response()->json([
                'view' => view('pony.erreur_modal', compact('erreur'))
                    ->render(),
                'erreur' => $erreur
            ]);
        }


        if($request->id_prestation_groupe) {
            $groupe = PofPrestationgroupe::find($request->id_prestation_groupe);
            $prestation = null;
        }
        else {
            $groupe = null;
            $prestation = PofPrestation::find($request->id_prestation);
        }

        /*
        // -- Vérification que chaque prestation a un tarif --
        foreach($prestations as $prestation) {
            if(count($prestation->poftarifs) < 1) {
                $erreur = 'Impossible de créer un abonnement. La prestation '.$prestation->libelle.' n\'a pas de tarif.';
                return response()->json([
                    'view' => view('erreur_modal', compact('erreur'))
                        ->render(),
                    'erreur' => $erreur
                ]);
            }
        }
        */

        $date_expiration = $request->date_expiration;       
        $libelle = $request->libelle;

        return response()->json([
            'view' => view('pony.abonnements.abonnement_choix_tarif_modal', compact('client', 'groupe', 'prestation', 'date_expiration', 'libelle'))
                ->render()
        ]);
    }


    public function abonnementCreer(Request $request) {
        $client = PofClient::find($request->id_client);

        $prestation = PofPrestation::find($request->id_prestation);
        $groupe = PofPrestationgroupe::find($request->id_prestation_groupe);

        // Création de l'abonnement
        $abonnement = new PofAbonnement;
        $abonnement->date_debut = Carbon::now();
        if($request->date_expiration) {
            $params = explode('-', $request->date_expiration);
            $abonnement->date_expiration = Carbon::createFromDate($params[0], $params[1], $params[2])->format('Y-m-d');
        }
        if($prestation) {
            // Si c'est une pension, la périodicité est mensuelle
            if($prestation->id_prestation_type == 2) {
                $abonnement->periodicite = 'mensuel';
            }
            // Si c'est une cotisation, la périodicité est annuelle
            else if($prestation->id_prestation_type == 5) {
                $abonnement->periodicite = 'annuel';
            }
            else {
                $abonnement->periodicite = $request->periodicite;
            }
        }
        else {
            $abonnement->periodicite = $request->periodicite;
        }
        
        $abonnement->total_ttc = 0;
        $abonnement->libelle = $request->libelle;
        $abonnement->save();


        // Création des abonnement_prestations
        $tarifs = PofTarif::whereIn('id_tarif', $request->id_tarifs)->get();
        foreach($tarifs as $tarif) {
            $prestation = $tarif->pofprestation;
            $abonnement_prestation = $this->creerAbonnementPrestation($abonnement, $prestation, $tarif);
        }


        // Calcul du coût total de l'abonnement
        $total = 0;
        foreach($abonnement->pofabonnementprestations as $abonnement_prestation) {
            $total += $abonnement_prestation->poftarif->prix_ttc;
        }
        $abonnement->total_ttc = $total;
        $abonnement->save(); 


        // Création de l'abonnement_client
        $abonnement_client = new PofAbonnementClient;
        $abonnement_client->id_abonnement = $abonnement->id_abonnement;
        $abonnement_client->id_client = $client->id_client;
        $abonnement_client->echeance = Carbon::now();
        $abonnement_client->save();

        $echeance = $this->abonnementSetEcheance($abonnement);

        // Création de la première facture
        $facture = $this->abonnementFacturer($abonnement, $client);
        if(!$facture[1]) {
            
            return $this->getErrorModal($facture[2]);
        }

        return response()->json([
            'view' => view('pony.abonnements.abonnements', compact('client'))
                ->render()
        ]);
    }


    /*
    * abonnementFacturer :
    *   - Crée une facture à partir de l'abonnement et du client fournis
    */
    public function abonnementFacturer(PofAbonnement $abonnement, PofClient $client) 
    {
        $abonnement_prestations = $abonnement->pofabonnementprestations;
        $id_tarifs = [];

        foreach($abonnement_prestations as $abonnement_prestation) {
            array_push($id_tarifs, $abonnement_prestation->poftarif->id_tarif);
        }

        $facture = $this->factureCreer(null, null, 1, $client, null, $id_tarifs);

        return $facture;
    }


    public function creerAbonnementPrestation(PofAbonnement $abonnement, PofPrestation $prestation, PofTarif $tarif) {
        $abonnement_prestation = new PofAbonnementPrestation;
        $abonnement_prestation->id_prestation = $prestation->id_prestation;
        $abonnement_prestation->id_abonnement = $abonnement->id_abonnement;
        $abonnement_prestation->id_tarif = $tarif->id_tarif;
        $abonnement_prestation->save();

        return $abonnement_prestation;
    }


    public function abonnementGetDetails(Request $request) {
        $abonnement = PofAbonnement::find($request->id_abonnement);

        if($request->expiration == true) {
            $expiration = true;
        }
        else {
            $expiration = null;
        }

        return response()->json([
            'view' => view('pony.abonnements.abonnement_detail_modal', compact('abonnement', 'expiration'))
                ->render(),
            'expiration' => $expiration
        ]);
    }


    public function abonnementSupprimerModal(Request $request) {
        $abonnement = PofAbonnement::find($request->id_abonnement);
        $action = 'supprimer cet abonnement';
        $fonction = 'abonnementSupprimer('.$abonnement->id_abonnement.')';

        return response()->json([
            'view' => view('pony.warning_modal', compact('action', 'fonction'))
                ->render()
        ]);
    }


    public function abonnementSupprimer(Request $request) {
        $abonnement = PofAbonnement::find($request->id_abonnement);
        
        $abonnement_client = $abonnement->pofabonnementclient;
        $abonnement_client->delete();

        foreach($abonnement->pofabonnementprestations as $abonnement_prestation) {
            $abonnement_prestation->delete();
        }

        $abonnement->delete();

        return;
    }


    public function abonnementVerifierEcheance() {
        $abonnements = PofAbonnement::all();
        $nb_factures = 0;
        $clients = [];

        foreach($abonnements as $abonnement) {
            $echeance = substr($abonnement->pofabonnementclient->echeance, 0, 10);
            /*
            $params = explode('-', $date_echeance);
            $echeance = Carbon::createFromDate($params[0], $params[1], $params[2])->format('Y-m-d');
            */
            
            $date_du_jour = Carbon::now()->format('Y-m-d');
            $date_expiration = substr($abonnement->date_expiration, 0, 10);
            
            if($date_du_jour == $date_expiration) {
                return response()->json([
                    'view' => view('pony.abonnements.abonnement_expiration_warning_modal', compact('abonnement'))
                        ->render(),
                    'erreur' => true
                ]);
            }

            if($echeance == $date_du_jour) {
                $facture = $this->abonnementFacturer($abonnement, $abonnement->pofabonnementclient->pofclient);
                $nouvelle_echeance = $this->abonnementUpdateEcheance($abonnement);
                $nb_factures += 1;
                $clients[] = $abonnement->pofabonnementclient->pofclient;
            }
        }

        return;

        // Si une facture est générée et un abonnement mis à jour, on l'indique à l'utilisateur dans une modale.
        /*
        if($nb_factures > 0) {
            $message = 'Abonnements vérifiés. '.$nb_factures.' facture(s) générée(s) pour '.$clients[0]->nom.' '.$clients[0]->prenom;

            if($nb_factures > 1) {
                for($i = 1; $i <= (count($clients)-1); $i++) {
                    $message = $message.', '.$clients[$i]->nom.' '.$clients[$i]->prenom;
                }
            }
            $message = $message.'.';
    
            return response()->json([
                'view' => view('message_modal', compact('message'))
                    ->render(),
                'message' => true
            ]);
        }
        else {
            return;
        }
        */
    }


    public function abonnementSetEcheance(PofAbonnement $abonnement)
    {
        if($abonnement->periodicite == 'hebdomadaire') {
            $nouvelle_echeance = Carbon::now()->addWeek();
        }
        else if($abonnement->periodicite == 'mensuel') {
            $nouvelle_echeance = Carbon::createFromDate(Carbon::now()->year, Carbon::now()->month, Carbon::now()->daysInMonth);
        }
        else if($abonnement->periodicite == 'annuel') {
            $nouvelle_echeance = Carbon::now()->addYear();
        }
        $abonnement->pofabonnementclient->echeance = $nouvelle_echeance;
        $abonnement->pofabonnementclient->save();

        return $nouvelle_echeance;
    }


    public function abonnementUpdateEcheance(PofAbonnement $abonnement) 
    {
        $ancienne_echeance = substr($abonnement->pofabonnementclient->echeance, 0, 10);
        $params = explode('-', $ancienne_echeance);

        if($abonnement->periodicite == 'hebdomadaire') {
            $nouvelle_echeance = Carbon::createFromDate($params[0], $params[1], $params[2])->addWeek();
        }
        else if($abonnement->periodicite == 'mensuel') {
            $nouvelle_echeance = Carbon::createFromDate($params[0], $params[1], $params[2])->addMonth();
        }
        else if($abonnement->periodicite == 'annuel') {
            $nouvelle_echeance = Carbon::createFromDate($params[0], $params[1], $params[2])->addYear();
        }
        $abonnement->pofabonnementclient->echeance = $nouvelle_echeance;
        $abonnement->pofabonnementclient->save();

        return $nouvelle_echeance;
    }


    public function abonnementProlongerModal(Request $request) {
        $abonnement = PofAbonnement::find($request->id_abonnement);
        if($request->expiration) {
            $expiration = true;

            return response()->json([
                'view' => view('pony.abonnements.abonnement_prolonger_modal', compact('abonnement', 'expiration'))
                    ->render()
            ]);
        }
        else {
            return response()->json([
                'view' => view('pony.abonnements.abonnement_prolonger_modal', compact('abonnement'))
                    ->render()
            ]);
        }  
    }

    
    public function abonnementProlonger(Request $request) {
        $abonnement = PofAbonnement::find($request->id_abonnement);

        if($request->expiration) {
            $nouvelle_echeance = $this->abonnementSetEcheance($abonnement);
            $facture = $this->abonnementFacturer($abonnement, $abonnement->pofabonnementclient->pofclient);
        }

        if($request->date_expiration) {
            $params = explode('-', $request->date_expiration);
            $date_expiration = Carbon::createFromDate($params[0], $params[1], $params[2]);
            $abonnement->date_expiration = $date_expiration;
        }
        else {
            $abonnement->date_expiration = Carbon::now()->addYear(90);
        }

        $abonnement->save();

        return $abonnement;
    }      
}
