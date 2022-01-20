<?php
 
namespace App\Traits\Pof;

use Carbon\Carbon;

use App\Models\Pof\PofCours;

use App\Models\Pof\PofCheval;
use App\Models\Pof\PofPrestation;
use App\Models\Pof\PofCoursClient;
use Illuminate\Support\Facades\DB;
use App\Models\Pof\PofChevalStatut;
use App\Models\Pof\PofClientCheval;
use App\Models\Pof\PofFactureDetail;

trait ChevalTrait {
 
    public function chevalStatutMAJ(PofCheval $cheval) {
        
        /*
         * Par défaut le cheval est en club
         */
        $cheval_statut = PofChevalStatut::where('code','C')->first();
        $cheval->id_cheval_statut = $cheval_statut->id_cheval_statut;
        
        $this->PofLog('début : '.$cheval->id_cheval_statut);
               
        /*
         * Si le cheval a au moins un propriétaire, alors son statut est de type propriétaire
         */
        
        $clientchevaux = PofClientCheval::where('id_cheval',$cheval->id_cheval)
                ->join('pof_client_cheval_statut','pof_client_cheval_statut.id_client_cheval_statut','=','pof_client_cheval.id_client_cheval_statut')
                ->orderBy('pof_client_cheval_statut.ordre','desc')
                ->get()
                ;
        
        foreach($clientchevaux as $clientcheval) {
            
            if($clientcheval->pofclientchevalstatut->code == 'P') {
                $cheval_statut = PofChevalStatut::where('code','P')->first();
                $cheval->id_cheval_statut = $cheval_statut->id_cheval_statut;
            }
            
            if($clientcheval->pofclientchevalstatut->code == 'DP') {
                $cheval_statut = PofChevalStatut::where('code','DP')->first();
                $cheval->id_cheval_statut = $cheval_statut->id_cheval_statut;
            }
            
        }
        
        $this->PofLog('fin : '.$cheval->id_cheval_statut);
        
        $cheval->save();
        
        return $cheval;
    }

    public function chevalCalculerUtilisations(PofCheval $cheval, $date_debut, $date_fin) {
        $cours_periode = PofCours::where('id_cheval', $cheval->id_cheval)
                ->whereBetween('date_cours', [$date_debut, $date_fin])
                ->join('pof_cours_client', 'pof_cours_client.id_cours', 'pof_cours.id_cours')
                ->get();

        $duree = 0;
        foreach($cours_periode as $cours) {

            $params = explode(':', $cours->duree);
            // On ajoute le nombre de minutes
            $nbminutes += intval($params[0])*60;
            $nbminutes += intval($params[1]);
        }
        $nbheures = $nbminutes/60;

        return $nbheures;
    }

    /*
    * chevalCalculerCharges :
    *   - Calcule et renvoie le coût d'un cheval sur la période donnée en fonction de ses charges
    */
    public function chevalCalculerCharges(PofCheval $cheval, $date_debut, $date_fin) {

        // On récupère la somme de toutes les charges facturées pendant le mois ou dont la date de début et la date de fin recouvrent le mois
        $sql = 'select SUM(montant) as total FROM pof_cheval_charge WHERE id_cheval = '.$cheval->id_cheval.' and (date_facturation BETWEEN "'.Carbon::createFromFormat('Y-m-d', $date_debut).'" and "'.Carbon::createFromFormat('Y-m-d', $date_fin).'" OR (date_debut = "'.Carbon::createFromFormat('Y-m-d', $date_debut).'" and date_fin = "'.Carbon::createFromFormat('Y-m-d', $date_fin).'"))';
        
        $total_charges = DB::select($sql);

        return $total_charges[0]->total;
    }


    /*
    * chevalCalculerBeneficesCours :
    *   - Calcule et renvoie le bénéfice généré par un cheval sur la période donnée
    *   - Prend en compte les heures de cours effectuées
    */
    public function chevalCalculerBeneficesCours(PofCheval $cheval, $date_debut, $date_fin) {
        $benefice_cours = 0;

        $coursclients = PofCoursClient::where('id_cheval', $cheval->id_cheval)
            ->whereBetween('pof_cours.date_cours', [$date_debut, $date_fin])
            ->join('pof_cours', 'pof_cours.id_cours', 'pof_cours_client.id_cours')
            ->get();
            
        foreach($coursclients as $coursclient) {
            // Evite de générer des erreurs avec les anciens $coursclient dont id_carte vaut null
            if(!$coursclient->pofcarte) {
                continue;
            }
            $carte = $coursclient->pofcarte;

            $facturedetail = PofFactureDetail::where('id_carte', $carte->id_carte)
                ->where('pof_facture.id_client', $coursclient->pofclient->id_client)
                ->whereBetween('pof_facture.date_facture', [$date_debut, $date_fin])
                ->join('pof_facture', 'pof_facture.id_facture', 'pof_facture_detail.id_facture')
                ->first();
            if($facturedetail) {
                $benefice_cours += $facturedetail->poftarif->prix_ht;
            }
        }

        return $benefice_cours;
    }
    

    /*
    * chevalCalculerBeneficesTravail :
    *   - Calcule et renvoie le bénéfice généré par un cheval sur la période donnée
    *   - Prend en compte les heures de travail facturées
    */
    public function chevalCalculerBeneficesTravail(PofCheval $cheval, $date_debut, $date_fin) {
        $benefice_travail = 0;

        // Sélection des id_prestation correspondant au travail des chevaux
        $prestations = PofPrestation::select('id_prestation')->where('id_prestation_type', 3)->get();

        if($cheval->pofclientcheval) {
            $client = $cheval->pofclientcheval->pofclient;
            // On récupère les détails de facture correspondant aux heures de travail facturées
            $facturedetails = PofFactureDetail::whereIn('id_prestation', $prestations)
                ->where('pof_facture.id_client', $client->id_client)
                ->whereBetween('pof_facture.date_facture', [$date_debut, $date_fin])
                ->join('pof_facture', 'pof_facture.id_facture', 'pof_facture_detail.id_facture')
                ->get();
            
            foreach($facturedetails as $facturedetail) {
                // On calcule le total facturé pour les heures de travail, et on divise par le nombre de chevaux du client
                $benefice_travail += $facturedetail->poftarif->prix_ht / count($client->pofclientchevaux);
            }
        }

        return $benefice_travail;
    }


    /*
    * chevalCalculerBeneficesPension :
    *   - Calcule et renvoie le bénéfice généré par la pension d'un cheval sur la période donnée
    */
    public function chevalCalculerBeneficesPension(PofCheval $cheval, $date_debut, $date_fin) {
        $benefice_pension = 0;

        // Sélection des id_prestation correspondant aux pensions
        $prestations = PofPrestation::select('id_prestation')->where('id_prestation_type', 2)->get();

        if($cheval->pofclientcheval) {
            $client = $cheval->pofclientcheval->pofclient;
            $facturedetails = PofFactureDetail::whereIn('id_prestation', $prestations)
                ->where('pof_facture.id_client', $client->id_client)
                ->whereBetween('pof_facture.date_facture', [$date_debut, $date_fin])
                ->join('pof_facture', 'pof_facture.id_facture', 'pof_facture_detail.id_facture')
                ->get();
            
            foreach($facturedetails as $facturedetail) {
                // On calcule le total facturé pour les pensions, et on divise par le nombre de chevaux du client
                $benefice_pension += $facturedetail->poftarif->prix_ht / count($client->pofclientchevaux);
            }
        }

        return $benefice_pension;
    }
}