<?php

namespace App\Traits\Pof;

use Carbon\Carbon;

use App\Models\Pof\PofCarte;
use App\Models\Pof\PofTarif;
use App\Models\Pof\PofClient;
use App\Models\Pof\PofFacture;
use App\Traits\Pof\CarteTrait;

use App\Models\Pof\PofBonachat;

use App\Models\Pof\PofPrestation;
use App\Models\Pof\PofFactureDetail;
use App\Models\Pof\PofMoyenPaiement;
use App\Models\Pof\PofFactureBonachat;
use Illuminate\Support\Facades\DB;
use App\Models\Pof\PofPrestationgroupe;
use App\Models\Pof\PofFactureMoyenPaiement;

trait FactureTrait {

    use CarteTrait;

    /*
     * Facturer une prestation
     *
     * Trouver le tarif : une prestation peut avoir plusieurs tarifs, chacun étant pour une quantité différente de prestation
     * Si le tarif pour la quantité demandé n'existe pas, il y en a au moins un qui a une quantité de 1 (à multiplié par la quantité ensuite)
     *
     * Prestations associées : une prestation peut être seule ou constituée de deux prestations associées
     * Une association de prestations est composée de deux prestations, dont une a un prix (la principale) et l'autre un pourcentage
     * Si une prestation a une association dont elle est la prestation principale, alors il faut facturer l'association
     * Il y a alors deux détails de facture avec :
     * - facture detail 1 (prestation principale) : total_ttc = prix_ttc_prestation_principale * (1 - pourcentage_prestation_secondaire / 100)
     * - facture detail 2 (prestation secondaire) : total_ttc = prix_ttc_prestation_principale * pourcentage_prestation_secondaire / 100
     */

    /*
     * Facturer un groupe de prestations
     *
     * Une prestation peut faire partie d'un groupe de prestations. Si la fonction reçoit un id_prestation_groupe en paramètre,
     * alors elle boucle sur chaque prestation du groupe et crée un facturedetail pour chacune d'elles en reprenant le fonctionnement ci-dessus.
     */

    public function factureCreer(Int $id_prestation_groupe = null, PofCarte $carte = null, $quantite, PofClient $client = null, PofTarif $tarif = null, Array $tarif_ids = null) {

        /*
         * vérification des paramètres de départ
         * si c'est un groupe, on le récupère à partir de son id, normalement il y a un client en param
         * si on a une carte, on prend la prestation de la carte et son client
         * si pas de carte, alors on prend la prestation du tarif, normalement il y a un client en param
         */

        $prestation_groupe = PofPrestationgroupe::find($id_prestation_groupe);

        if($prestation_groupe) {
            $prestations = [];
            // Récupérer toutes les prestations du groupe pour boucler dessus
            foreach($prestation_groupe->pofprestationgroupeliens as $groupe_lien) {
                array_push($prestations, $groupe_lien->pofprestation);
            }
        }
        else if($tarif_ids) {
            if(count($tarif_ids) < 0) {
                return [1 => false, 2 => 'Impossible de facturer le client, aucune prestation n\'a pu être trouvée à partir des paramètres fournis pour générer la facture'];
            }
            $tarifs = PofTarif::whereIn('id_tarif', $tarif_ids)->get();
            $prestations = [];
            // Récupérer toutes les prestations choisies par l'utilisateur pour boucler dessus
            foreach($tarifs as $tarif) {
                array_push($prestations, $tarif->pofprestation);
            }
        }
        else {
            if($carte) {

                $prestation = $carte->pofprestation;
                $client = $carte->pofclient;

            } elseif($tarif) {

                $prestation = $tarif->pofprestation;

                if(!$client) {
                    return [1 => false, 2 => 'Pas de client sélectionné'];
                }

                if($prestation->pofprestationtype->code == 'CAR') {
                    if(!$carte = PofCarte::where([['id_client',$client->id_client],['id_prestation',$prestation->id_prestation]])
                            ->first()) {

                        $carte = $this->carteMAJ(null,$client,$prestation,0);
                    }
                }
            } else {
                return [1 => false, 2 => 'Pas de prestation sélectionnée'];
            }
            $prestations = [$prestation];
        }

        /*
        * Création de la facture
        */
        $facture = new PofFacture;
        $facture->id_client = $client->id_client;
        $facture->id_facture_statut = 1;
        $facture->date_facture = Carbon::now();
        $facture->save();


        /*
        * Création des facturedetails en bouclant sur les prestations
        */
        foreach($prestations as $prestation_principale) {
            $tarif_principal = $tarif;
            if(!$tarif_principal) {
                // Si l'utilisateur a choisi des tarifs spécifiques, on les utilise
                if($tarif_ids) {
                    $tarif_principal = PofTarif::where('id_prestation', $prestation_principale->id_prestation)
                        ->whereIn('id_tarif', $tarif_ids)
                        ->first();
                }
                else {
                    // Sinon, prendre le tarif dont les dates de début et fin bornent date_facture avec la quantité demandée
                    // (on applique ici une vérification de la validité du tarif, car c'est le cas où l'on crée une facture pour une carte)
                    $tarif_principal = $prestation_principale->poftarifs->where('quantite', $quantite)
                        ->where('date_debut','<=',$facture->date_facture)
                        ->where('date_fin','>=',$facture->date_facture)
                        ->first();
                    // Si on ne le trouve pas, alors par défaut on prend celui avec une quantité de 1
                    if(!$tarif_principal) {
                        if(!$tarif_principal = $prestation_principale->poftarifs->where('quantite',1)
                            ->where('date_debut','<=',$facture->date_facture)
                            ->where('date_fin','>=',$facture->date_facture)
                            ->first()) {

                            // Et s'il n'existe toujours pas, on renvoie une erreur
                            $facture->delete();
                            return [1 => false, 2 => 'Pas de tarif pour la prestation "'.$prestation_principale->libelle.'", il faut en créer un.'];
                        }
                    }
                }
            }

            // si la quantité demandée est différente de celle du tarif,
            // alors le tarif qui a été choisi est celui avec une quantité de 1
            // et il faudra multiplier le prix par facteur égal à la quantité demandé
            // ex : il n'existe pas de tarif avec une quantité de 3, prix = prix_pour_1 x 3
            // ex : il existe un tarif avec une quantité de 3, prix = prix_pour_3 x 1
            $facteur_quantite = 1;
            if($tarif_principal->quantite != $quantite) {
                $facteur_quantite = $quantite;
            }

            // Si c'est une association
            if($prestation_principale->pofprestationassociationlien) {
                if($prestation_secondaire = $prestation_principale->pofprestationassociationlien->pofprestationassociation->pofprestationassociationliens
                        ->where('id_prestation','!=',$prestation_principale->id_prestation)
                        ->first()
                        ->pofprestation) {

                    if(!$tarif_secondaire = $prestation_secondaire->poftarifs->where('quantite',1)
                            ->where('date_debut','<=',$facture->date_facture)
                            ->where('date_fin','>=',$facture->date_facture)
                            ->first()) {

                        $facture->delete();
                        return [1 => false, 2 => 'Pas de tarif pour la prestation '.$prestation_secondaire->libelle.', il faut en créer un.'];
                    }
                    
                    $facturedetail_principal = $this->facturedetailCreer($carte,$quantite,$facteur_quantite,$prestation_principale,$prestation_secondaire,$tarif_principal,$tarif_secondaire,$facture,null,'principale');
                    $facturedetail_secondaire = $this->facturedetailCreer(null, 1, $facteur_quantite, $prestation_principale, $prestation_secondaire, $tarif_principal, $tarif_secondaire,$facture,$facturedetail_principal->id_facture_detail,'secondaire');
                }
                else {
                    return [1 => false, 2 => 'Pas de prestation secondaire'];
                }
                
            }
            // Si c'est une prestation seule
            else {
                $facturedetail = $this->facturedetailCreer($carte,$quantite,$facteur_quantite,$prestation_principale, null,$tarif_principal,null,$facture,null,'seule');
            }
        }

        // Si la facture concerne un groupe de prestation, on enregistre son ID
        if($prestation_groupe) {
            foreach($facture->poffacturedetails as $facturedetail) {
                $facturedetail->id_prestation_groupe = $prestation_groupe->id_prestation_groupe;
                $facturedetail->save();
            }
        }

        $facture = $this->factureMAJ($facture);
        $moyens_paiement = $this->factureMoyensPaiementMaj($facture);

        return [1 => true];
    }


    public function facturedetailCreer(PofCarte $carte = null, $quantite, $facteur_quantite,
                                       PofPrestation $prestation_principale, PofPrestation $prestation_secondaire = null,
                                       PofTarif $tarif_principal = null, PofTarif $tarif_secondaire = null,
                                       PofFacture $facture, int $id_facture_detail_pere = null, string $type)
    {
        $facturedetail = new PofFactureDetail;
        $facturedetail->id_facture = $facture->id_facture;
        $facturedetail->id_prestation = $prestation_principale->id_prestation;
        $facturedetail->id_tarif = $tarif_principal->id_tarif;
        if($carte) {
            $facturedetail->id_carte = $carte->id_carte;
        }
        else {
            $facturedetail->id_carte = null;
        }
        $facturedetail->quantite = $quantite;

        if($type == 'principale') {
            $facturedetail->total_ht = (1 - $tarif_secondaire->pourcentage/100) * $tarif_principal->prix_ht * $facteur_quantite;
            $facturedetail->total_ttc = (1 - $tarif_secondaire->pourcentage/100) * $tarif_principal->prix_ttc * $facteur_quantite;
        }
        else if($type == 'secondaire') {
            $facturedetail->id_prestation = $prestation_secondaire->id_prestation;
            $facturedetail->total_ttc = ($tarif_secondaire->pourcentage/100) * $tarif_principal->prix_ttc * $facteur_quantite;
            $facturedetail->total_ht = $facturedetail->total_ttc / (1+$prestation_secondaire->poftva->taux/100);
            $facturedetail->id_facture_detail_pere = $id_facture_detail_pere;
        }
        else if($type == 'seule') {
            $facturedetail->total_ht = $tarif_principal->prix_ht * $facteur_quantite;
            $facturedetail->total_ttc = $tarif_principal->prix_ttc * $facteur_quantite;
        }

        $facturedetail->save();
        return $facturedetail;
    }


    public function facturedetailMAJ(PofFactureDetail $facturedetail) {

        $tva = $facturedetail->pofprestation->poftva;

        $facturedetail->total_ht = $facturedetail->total_ttc / (1+$tva->taux/100);
        $facturedetail->save();

        if($facturedetail_fils = PofFactureDetail::where('id_facture_detail_pere',$facturedetail->id_facture_detail)->first()) {
            $pourcentage = $facturedetail_fils->pofprestation->poftarifprincipal->pourcentage;
            $facturedetail_fils->total_ttc = ($facturedetail->total_ttc * ($pourcentage/100)) / (1-$pourcentage/100);
            $facturedetail_fils->total_ht = $facturedetail_fils->total_ttc / (1+$facturedetail_fils->pofprestation->poftva->taux/100);
            $facturedetail_fils->save();
        }

        return $facturedetail;
    }


    public function factureMAJ(PofFacture $facture) {

        if($facture->id_facture_statut == 1) {

            $facture->total_ht = 0;
            $facture->total_ttc = 0;
            $facture->libelle = '';

            $first = 0;

            foreach($facture->poffacturedetails as $facturedetail) {

                $facture->total_ht += $facturedetail->total_ht;
                $facture->total_ttc += $facturedetail->total_ttc;
            }

            $facture->total_bonachat_deduis = $facture->total_ttc;
            $bonachats = PofFactureBonachat::where('id_facture', $facture->id_facture)->get();
            
            foreach($bonachats as $bonachat) {
                $facture->total_bonachat_deduis -= $bonachat->montant;
            }
            $facture->save();
        }

        $facture = $this->factureLibelleMAJ($facture);

        return $facture;
    }

    /*
     * Libellé de facture = concaténation des libellés des détails de facture dont la prestation n'est pas secondaire
     */
    public function factureLibelleMAJ(PofFacture $facture) {

        $libelle = '';
        $first = 0;

        foreach($facture->poffacturedetails as $facturedetail) {

            // si la prestation n'est pas secondaire
            if(!$facturedetail->pofprestation->pofprestationassociationliensecondaire) {

                if($first) {
                    $libelle .= ' | ';
                } else {
                    $first = 1;
                }

                $facturedetail = $this->facturedetailLibelleMAJ($facturedetail);

                $libelle .= $facturedetail->libelle;
            }
        }

        $facture->libelle = $libelle;
        $facture->save();

        return $facture;
    }


    /*
     * Libellé de détail de facture =
     * Si libellé de détail déjà renseigné, ne pas toucher
     * Si libellé de détail pas renseigné, si le tarif a un libellé le prendre
     * sinon prendre celui de la prestation
     */
    public function facturedetailLibelleMAJ(PofFactureDetail $facturedetail) {

        // si le détail de facture a déjà un libellé, on le prend
        if($facturedetail->libelle && strlen(trim($facturedetail->libelle))>0) {

            return $facturedetail;

        // sinon si le tarif a un libellé, on le prend
        } elseif($facturedetail->poftarif->libelle && strlen(trim($facturedetail->poftarif->libelle))>0) {

            $facturedetail->libelle = $facturedetail->poftarif->libelle;

        // sinon c'est le libellé de la prestation
        } else {

            $facturedetail->libelle = $facturedetail->quantite . 'x ' . $facturedetail->pofprestation->libelle;
        }

        $facturedetail->save();

        return $facturedetail;
    }


    /*
    * factureMoyensPaiementMaj :
    *   - Génère les facture_moyen_paiement en fonction des moyens de paiement actifs, afin de pouvoir les utiliser au paiement de la facture
    *   - Retourne $facture
    */
    public function factureMoyensPaiementMaj(PofFacture $facture) {
        // Si la facture passée en paramètre a déjà été payée, on ne génère rien
        if($facture->id_facture_statut == 2) {
            return $facture;
        }

        $moyens_paiement = PofMoyenPaiement::where('actif', 1)->get();

        foreach($moyens_paiement as $moyen_paiement) {
            $facture_moyen_paiement = PofFactureMoyenPaiement::where('id_facture', $facture->id_facture)
                    ->where('id_moyen_paiement', $moyen_paiement->id_moyen_paiement)
                    ->first();
            
            if($facture_moyen_paiement) {
                continue;
            }
            else {
                $facture_moyen_paiement = new PofFactureMoyenPaiement;
                $facture_moyen_paiement->id_moyen_paiement = $moyen_paiement->id_moyen_paiement;
                $facture_moyen_paiement->id_facture = $facture->id_facture;
                $facture_moyen_paiement->montant = 0;
                $facture_moyen_paiement->save();
            }
        }

        return $facture;
    }
}
