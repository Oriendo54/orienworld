<?php

namespace app\Http\Controllers\Pof;

use PDF;
use Carbon\Carbon;
use Dompdf\Options;

use App\Models\Pof\PofTva;
use App\Models\Pof\PofCarte;
use App\Models\Pof\PofTarif;
use App\Models\Pof\PofClient;
use App\Traits\Pof\TestTrait;
use App\Models\Pof\PofFacture;
use App\Models\Pof\PofBonachat;
use App\Traits\Pof\ClientTrait;
use App\Traits\Pof\FactureTrait;
use Illuminate\Http\Request;
use App\Models\Pof\PofPrestation;

use App\Traits\Pof\BonachatTrait;
use App\Traits\Pof\PrestationTrait;
use App\Models\Pof\PofFactureDetail;
use App\Models\Pof\PofMoyenPaiement;

use App\Models\Pof\PofFactureBonachat;
use Illuminate\Support\Facades\DB;
use App\Models\Pof\PofPrestationgroupe;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\Pof\PofFactureMoyenPaiement;

class FactureController extends Controller {

    use FactureTrait;
    use ClientTrait;
    use PrestationTrait;
    use BonachatTrait;
    use TestTrait;

    public function factureAfficher(Request $request) {

        $client = PofClient::find($request->id_client);
        $factures = PofFacture::where('id_client',$client->id_client)->orderby('id_facture','desc')->get();

        return response()->json([
            'view' => view('pony.facture.facture', compact('factures','client'))
                ->render()
        ]);
    }

    public function factureSupprimerModal(Request $request) {

        $facture = PofFacture::find($request->id_facture);

        return response()->json([
            'view' => view('pony.facture.facture_supprimer_modal', compact('facture'))
                ->render()
        ]);
    }

    public function factureSupprimer(Request $request) {

        $facture = PofFacture::find($request->id_facture);

        $facturedetails =  $facture->poffacturedetails;
        foreach($facturedetails as $facturedetail) {
            $facturedetail->delete();
        }
        $facture->delete();

        return 1;
    }

    public function factureBonachatModal(Request $request) {
        $facture = PofFacture::find($request->id_facture);
        $bonachats = PofBonachat::where('id_client', $facture->id_client)
                ->whereDate('date_expiration', '>', Carbon::now())
                ->where('actif', 1)
                ->where('minimum', '<=', $facture->total_ttc)
                ->orderBy('date_expiration')
                ->get();

        if(count($bonachats) < 1) {
            return $this->facturePayerModal($request);
        }

        return response()->json([
            'view' => view('pony.facture.facture_choix_bonachat_modal', compact('facture', 'bonachats'))
                ->render()
        ]);
    }

    public function factureBonachatUtiliser(Request $request) {
        $facture = PofFacture::find($request->id_facture);
        $bonachat = PofBonachat::find($request->id_bonachat);

        if($request->montant < 0 || is_nan($request->montant)) {
            $erreur = 'Saisissez un montant compris entre 0 et le montant de la facture.';
            return $this->getErrorModal($erreur);
        }

        $facturebonachat = PofFactureBonachat::where('id_facture', $facture->id_facture)
            ->where('id_bonachat', $bonachat->id_bonachat)
            ->first();

        // Si le bon d'achat n'a jamais été utilisé pour payer cette facture
        if(!$facturebonachat) {
            $facturebonachat = new PofFactureBonachat;
            $facturebonachat->id_bonachat = $bonachat->id_bonachat;
            $facturebonachat->id_facture = $facture->id_facture;
        }
        else {
            // On annule l'utilisation précédente du bon d'achat pour cette facture
            $bonachat->restant += $facturebonachat->montant;
            $bonachat->save();
        }

        if($request->montant > $bonachat->restant) {
            $erreur = 'Saisissez un montant compris entre 0 et le montant de la facture.';
            return $this->getErrorModal($erreur);
        }

        // Si le restant à payer de la facture est supérieur au restant du bon d'achat
        if($facture->total_bonachat_deduis > $bonachat->restant) {
            $facturebonachat->montant = $request->montant;
            $bonachat->restant -= $facturebonachat->montant;
        } else {
            // Si le montant que l'utilisateur souhaite utiliser est supérieur ou égal à la somme à payer
            if($request->montant >= $facture->total_bonachat_deduis) {
                $facturebonachat->montant = $facture->total_bonachat_deduis;
                $bonachat->restant -= $facture->total_bonachat_deduis;
            }
            else {
                $facturebonachat->montant = $request->montant;
                $bonachat->restant -= $facturebonachat->montant;
            }
        }
    
        $facturebonachat->save();
        $bonachat->save();
        
        $facture = $this->factureMAJ($facture);
        
        return $this->factureBonachatModal($request);
    }

    public function factureBonachatAnnuler(Request $request) {
        $facture = PofFacture::find($request->id_facture);
        $bonachat = PofBonachat::find($request->id_bonachat);

        $facturebonachat = PofFactureBonachat::where('id_facture', $facture->id_facture)
                ->where('id_bonachat', $bonachat->id_bonachat)
                ->first();

        $bonachat->restant += $facturebonachat->montant;
        $bonachat->save();

        $facturebonachat->delete();

        $facture = $this->factureMAJ($facture);

        return $this->factureBonachatModal($request);
    }

    public function facturePayerModal(Request $request) {

        $facture = PofFacture::find($request->id_facture);
        $moyens_paiement = PofMoyenPaiement::where('actif', 1)->get();

        return response()->json([
            'view' => view('pony.facture.facture_payer_modal', compact('facture', 'moyens_paiement'))
                ->render()
        ]);
    }

    public function factureSetPaiementMode(Request $request) {
        $facture = PofFacture::find($request->id_facture);

        $facture_moyen_paiement = PofFactureMoyenPaiement::where('id_facture', $facture->id_facture)
                ->where('id_moyen_paiement', $request->id_moyen_paiement)
                ->first();

        if(!$facture_moyen_paiement) {
            $facture_moyen_paiement = new PofFactureMoyenPaiement;
            $facture_moyen_paiement->id_facture = $facture->id_facture;
            $facture_moyen_paiement->id_moyen_paiement = $request->id_moyen_paiement;
        }

        if($request->action === "totally") {
            $facture_moyen_paiement->montant = $facture->total_bonachat_deduis;
            $facture_moyen_paiement->save();

            $autres_fmp = PofFactureMoyenPaiement::where('id_facture', $facture->id_facture)
                ->where('id_moyen_paiement', '!=', $request->id_moyen_paiement)
                ->get();
            // Mise à zéro du montant renseigné pour les autres moyens de paiement
            foreach($autres_fmp as $autre_fmp) {
                $autre_fmp->montant = 0;
                $autre_fmp->save();
            }
        }
        
        if($request->action === "leftover") {
            // Mise à jour des montants renseignés pour les autres moyens de paiement
            $total_autres_fmp = 0;
            foreach($request->autres_montants as $autre_montant) {
                $fmp = PofFactureMoyenPaiement::where('id_facture', $facture->id_facture)
                        ->where('id_moyen_paiement', $autre_montant[0])
                        ->first();
                $fmp->montant = $autre_montant[1];
                $fmp->save();

                $total_autres_fmp += $fmp->montant;
            }

            $facture_moyen_paiement->montant = $facture->total_bonachat_deduis - $total_autres_fmp;
            $facture_moyen_paiement->save();
        }

        $moyens_paiement = PofMoyenPaiement::where('actif', 1)->get();

        return response()->json([
            'view' => view('pony.facture.facture_payer_modal', compact('facture', 'moyens_paiement'))
                ->render()
        ]);
    }

    public function facturePayer(Request $request) {

        $facture = PofFacture::find($request->id_facture);
        $total_montants = 0;

        $nb_montants = 0;

        // Enregistrement des moyens de paiement utilisés pour régler la facture
        foreach($request->montants as $montant) {

            $fmp = PofFactureMoyenPaiement::where('id_moyen_paiement', $montant[0])
                ->where('id_facture', $facture->id_facture)
                ->first();

            if(!$fmp) {
                $fmp = new PofFactureMoyenPaiement;
                $fmp->id_facture = $facture->id_facture;
                $fmp->id_moyen_paiement = $montant[0];
                $fmp->montant = $montant[1];
                $fmp->save();
            }
            else {
                $fmp->montant = $montant[1];
                $fmp->save();
            }

            $total_montants += $montant[1];
        }

        // Vérifier que le total renseigné pour les différents moyens de paiement correspond bien au total à régler
        $reste = $facture->total_bonachat_deduis - $total_montants;
        if(abs($reste)>0.01) {
            // Sinon, on renvoie une erreur
            $moyens_paiement = PofMoyenPaiement::all();
            return response()->json([
                'valid' => 0,
                'view' => view('pony.facture.facture_payer_modal', compact('facture', 'moyens_paiement'))
                    ->render()
            ]);
        }

        foreach($facture->poffacturedetails as $facturedetail) {
            // si le détail de facture a une carte, on incrémente la carte
            if($facturedetail->id_carte) {

                if($carte = PofCarte::find($facturedetail->id_carte)) {

                    $carte->solde += $facturedetail->quantite;
                    $carte->save();
                }
            }
        }

        $facture->id_facture_statut = 2;
        $facture->save();

        // On désactive les bons d'achats dont le solde est à 0
        $facture = $this->factureDesactiverBonachats($facture);

        return $facture->id_facture;
    }


    public function factureGenererTickets(Request $request) {
        $facture = PofFacture::find($request->id_facture);

        $date_explode = explode(' ', Carbon::now());
        $params = explode('-', $date_explode[0]);
        $date = Carbon::createFromDate($params[0], $params[1], $params[2])->format('Y-m-d');

        // Longueur de base du document PDF, 226.8 points = 8cm
        $pdf_longueur = 226.8;
        $nombre_facturedetails = 0;

        $tvas_id = [];
        foreach($facture->poffacturedetails as $facturedetail) {
            array_push($tvas_id, $facturedetail->pofprestation->id_tva);

            // On compte le nombre de lignes sur lesquelles on a déjà bouclé
            $nombre_facturedetails += 1;

            // Pour chaque ligne après la 6ème, on ajoute 14.2 points à la longueur, soit environ 1cm
            if($nombre_facturedetails >= 6) {
                $pdf_longueur += 14.2;
            }
        }

        foreach($facture->poffacturemoyenspaiement as $moyen_paiement) {
            $pdf_longueur += 14.2;
        }

        $tvas = PofTva::whereIn('id_tva', $tvas_id)->get();

        $domPdfOptions = new Options();
        $domPdfOptions->set("isPhpEnabled", true);

        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper(array(0, 0, 226.8, $pdf_longueur))
            ->loadView("pony.pdf.pdf_facture_ticket", compact("facture", "tvas", "pdf"));

        return $pdf->download($date."-ticket-facture-".$facture->id_facture.".pdf");
    }


    public function factureDesactiverBonachats(PofFacture $facture) {

        $bonachats = $this->desactiverBonachatsExpires($facture, null);
        return $facture;
    }

    public function factureModifierModal(Request $request) {

        $facture = PofFacture::find($request->id_facture);

        return response()->json([
            'view' => view('pony.facture.facture_modifier_modal', compact('facture'))
                ->render()
        ]);
    }

    /*
     * on ne permet pas la modification d'un détail de facture qui a un père
     * car le prix a été calculé en fonction du père, donc il n'y a rien a modifier sur le fils
     */
    public function factureModifier(Request $request) {

        $facture = PofFacture::find($request->id_facture);

        foreach($request->facturedetail as $request_facturedetail) {

            $facturedetail = PofFactureDetail::find($request_facturedetail['id_facture_detail']);

            // on ne met pas à jours les informations d'un détail de facture fils, ce sera fait par facturedetailMAJ
            if(!$facturedetail->id_facture_detail_pere) {

                $facturedetail->total_ttc = $request_facturedetail['facturedetail_total_ttc'];
                $facturedetail->libelle = $request_facturedetail['facturedetail_libelle'];

                // si le détail de facture a un fils, alors le montant transmis est le total père et fils
                // il faut donc calculer la part du père
                if($facturedetail->poffacturedetailenfant) {

                    $facturedetail_fils = PofFactureDetail::where('id_facture_detail_pere',$facturedetail->id_facture_detail)->first();
                    $pourcentage = $facturedetail_fils->pofprestation->poftarifprincipal->pourcentage;
                    $facturedetail->total_ttc = $facturedetail->total_ttc * (1-$pourcentage/100);

                }

                $facturedetail->save();

                $this->facturedetailMAJ($facturedetail);
            }
        }

        $facture = $this->factureMAJ($facture);

        return $facture->id_facture;
    }

    public function factureImpayerModal(Request $request) {

        $facture = PofFacture::find($request->id_facture);

        return response()->json([
            'view' => view('pony.facture.facture_impayer_modal', compact('facture'))
                ->render()
        ]);
    }

    public function factureImpayer(Request $request) {

        $facture = PofFacture::find($request->id_facture);

        foreach($facture->poffacturedetails as $facturedetail) {

            // si le détail de facture a une carte, on décrémente la carte
            if($facturedetail->id_carte) {

                if($carte = PofCarte::find($facturedetail->id_carte)) {

                    $carte->solde -= $facturedetail->quantite;
                    $carte->save();
                }
            }
        }

        $facture->id_facture_statut = 1;
        $facture->save();

        $bonachats = $this->factureImpayerReactiverBonachats($facture);
        $facture_moyens_paiement = $this->factureImpayerResetMoyensPaiement($facture);

        $facture = $this->factureMAJ($facture);

        return $facture->id_facture;
    }

    // Réactive et recrédite les bons d'achats utilisés pour régler la facture dont on annule le paiement
    public function factureImpayerReactiverBonachats(PofFacture $facture) {
        $facture_bonachats = $facture->poffacturebonachats;
        $bonachats = [];

        foreach($facture_bonachats as $facture_bonachat) {
            $bonachat = $facture_bonachat->pofbonachat;

            $bonachat->actif = 1;
            $bonachat->restant += $facture_bonachat->montant;
            $bonachat->save();
            $bonachats[] = $bonachat;

            $facture_bonachat->delete();
        }

        return $bonachats;
    }

    // Remet à zéro l'enregistrement des moyens de paiement utilisés pour régler la facture dont on annule le paiement
    public function factureImpayerResetMoyensPaiement(PofFacture $facture) {
        $facture_moyens_paiement = $facture->poffacturemoyenspaiement;
        foreach($facture_moyens_paiement as $facture_moyen_paiement) {
            $facture_moyen_paiement->montant = 0;
            $facture_moyen_paiement->save();
        }

        return $facture_moyens_paiement;
    }

    public function factureLierModal(Request $request) {

        $client = PofClient::find($request->id_client);
        $id_client = $client->id_client;

        $factures = PofFacture::where('id_client',$client->id_client)
                ->where('id_facture_statut',1)
                ->whereIn('id_facture', function($q) {
                    $q->select('pof_facture_detail.id_facture')
                    ->from('pof_facture_detail')
                    ->where('pof_facture_detail.id_prestation','>',0);
                })
                ->orderby('pof_facture.id_facture','desc')->get();

        return response()->json([
            'view' => view('pony.facture.facture_lier_modal', compact('factures','client'))
                ->render()
        ]);
    }

    public function factureLier(Request $request) {

        $factures = PofFacture::wherein('id_facture',$request->ids_facture)
                ->orderby('id_facture','asc')
                ->get();

        $facture = 0;

        foreach($factures as $facture_a_lier) {

            if(!$facture) {
                $facture = $facture_a_lier;
            } else {
                $facturedetails = $facture_a_lier->poffacturedetails;
                foreach($facturedetails as $facturedetail) {
                    $facturedetail->id_facture = $facture->id_facture;
                    $facturedetail->save();
                }

                $facture_a_lier->delete();
            }
        }

        $facture = $this->factureMAJ($facture);

        return $facture;
    }

    public function factureDelierModal(Request $request) {

        $facture = PofFacture::find($request->id_facture);

        return response()->json([
            'view' => view('pony.facture.facture_delier_modal', compact('facture'))
                ->render()
        ]);
    }

    public function factureDelier(Request $request) {

        $facture = PofFacture::find($request->id_facture);
        $id_facture = $facture->id_facture;

        $facturedetails = PofFactureDetail::where('pof_facture_detail.id_facture',$id_facture)
            ->join ('pof_facture_detail_lien', function($join) use ($id_facture) {
                $join->on('pof_facture_detail_lien.id_facture_detail', '=', 'pof_facture_detail.id_facture_detail')
                     ->where('pof_facture_detail_lien.id_facture', $id_facture);
            })
            ->orderby('pof_facture_detail.id_facture_detail','asc')
            ->get();

        $first = 0;
        foreach($facturedetails as $facturedetail) {

            if(!$first) {
                $first = 1;

            } else {
                $facture_new = new PofFacture;
                $facture_new->id_client = $facture->id_client;
                $facture_new->id_facture_statut = 1;
                $facture_new->save();

                $facturedetail->id_facture = $facture_new->id_facture;
                $facturedetail->save();

                if($facturedetail->poffacturedetailenfant) {
                    $facturedetail_enfant = $facturedetail->poffacturedetailenfant;
                    $facturedetail_enfant->id_facture = $facture_new->id_facture;
                    $facturedetail_enfant->save();
                }

                $facture_new = $this->factureMAJ($facture_new);
            }

        }
        return $this->factureMAJ($facture);
    }


    // Renvoie la modale permettant de choisir entre facturer une prestation unique ou un groupe de prestations
    public function factureAjouterSelectionTypeAjoutModal(Request $request) {
        $client = PofClient::find($request->id_client);

        return response()->json([
            'view' => view('pony.facture.facture_ajouter_modal_selection_type_ajout', compact('client'))->render()
        ]);
    }


    public function factureAjouterChoixPrestationModal(Request $request) {

        $client = PofClient::find($request->id_client);

        $prestations = $this->clientPrestationCompatibles($client);

        return response()->json([
            'view' => view('pony.facture.facture_ajouter_modal_choix_prestation', compact('client','prestations'))
                ->render(),
            'prestations' => $prestations
        ]);
    }



    public function factureAjouterChoixTarifModal(Request $request) {

        $client = PofClient::find($request->id_client);

        if($request->id_prestation_groupe) {
            $groupe = PofPrestationgroupe::find($request->id_prestation_groupe);
            $groupe_liens = $groupe->pofprestationgroupeliens;

            $prestations = [];
            // On récupère toutes les prestations du groupe dans un tableau $prestations
            foreach($groupe->pofprestationgroupeliens as $groupe_lien) {
                $prestations[] = $groupe_lien->pofprestation;
            }

            return response()->json([
                'view' => view('pony.facture.facture_ajouter_modal_choix_tarif', compact('client','prestations', 'groupe', 'groupe_liens'))
                    ->render()
            ]);
        }
        else {
            $prestation = PofPrestation::find($request->id_prestation);
            return response()->json([
                'view' => view('pony.facture.facture_ajouter_modal_choix_tarif', compact('client','prestation'))
                    ->render()
            ]);
        }
    }


    public function factureAjouterChoixPrestationgroupeModal(Request $request) {
        $client = PofClient::find($request->id_client);

        $groupes = $this->clientPrestationgroupeCompatibles($client);

        if(count($groupes) < 1) {
            $erreur = 'Aucun groupe de prestations ne correspond avec ce client !';
            return response()->json([
                'view' => view('pony.erreur_modal', compact('erreur'))->render()
            ]);
        }

        return response()->json([
            'view' => view('pony.facture.facture_ajouter_modal_choix_groupe_prestations', compact('client', 'groupes'))->render()
        ]);
    }


    public function factureAjouter(Request $request) {

        $client = PofClient::find($request->id_client);

        if($request->id_prestation_groupe) {
            $groupe = PofPrestationgroupe::find($request->id_prestation_groupe);

            // Si l'utilisateur a choisi des tarifs personnalisés, on récupère en requête un tableau d'identifiants de tarifs.
            $tarif_ids = $request->tarifs;

            $message = $this->factureCreer($request->id_prestation_groupe, null, 1, $client, null, $tarif_ids);
        }
        else {

            $tarif = PofTarif::find($request->id_tarif);
            $message = $this->factureCreer(null, null, $tarif->quantite, $client, $tarif, null);
        }

        if(!$message[1]) {

            return $this->getErrorModal($message[2]);
        }

        return redirect()->route('afficherClientDetails', ['id_client' => $client->id_client]);
    }


    /*
     * Facture ancienne prestation
     */

    public function factureAnciennePrestationPayerModal(Request $request) {

        $facture = PofFacture::find($request->id_facture);

        return response()->json([
            'view' => view('pony.facture.facture_ancienne_prestation_payer_modal', compact('facture'))
                ->render()
        ]);
    }

    public function factureAnciennePrestationPayer(Request $request) {

        $facture = PofFacture::find($request->id_facture);
        $facture->id_facture_statut = 2;
        $facture->save();

        return true;
    }

    public function factureAnciennePrestationModifierModal(Request $request) {

        $facture = PofFacture::find($request->id_facture);

        return response()->json([
            'view' => view('pony.facture.facture_ancienne_prestation_modifier_modal', compact('facture'))
                ->render()
        ]);
    }

    public function factureAnciennePrestationModifier(Request $request) {

        $facture = PofFacture::find($request->id_facture);
        $facturedetails = PofFactureDetail::where('id_facture',$facture->id_facture)->get();
        $difference_ttc = 1/count($facturedetails);

        $total_ttc = 0;
        $total_ht = 0;
        
        foreach($facturedetails as $facturedetail) {
            $facturedetail->total_ttc = $difference_ttc * $request->facture_total_ttc;
            $total_ttc += $facturedetail->total_ttc;
            
            $facturedetail->total_ht = $difference_ttc * $request->facture_total_ttc/1.2;
            $total_ht += $facturedetail->total_ht;
            
            $facturedetail->save();
        }

        $facture->total_ttc = $total_ttc;
        $facture->total_ht = $total_ht;
        $facture->save();

        return true;
    }

}
