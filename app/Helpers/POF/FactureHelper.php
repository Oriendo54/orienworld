<?php
namespace App\Helpers\POF;
 
use App\Models\Pof\PofFacture;
use Illuminate\Support\Facades\DB;
use App\Models\Pof\PofFactureDetail;
use App\Models\Pof\PofFactureBonachat;
use App\Models\Pof\PofFactureMoyenPaiement;
 
class FactureHelper {
    
    public static function factureATarif($id_facture) {
        
        $facturedetails = PofFactureDetail::where('id_facture',$id_facture)
                ->where('id_tarif','>',0)
                ->get()
                ;
        
        return count($facturedetails);
    }

    public static function factureMoyenPaiementMontant($id_facture, $id_moyen_paiement) {
        $facture_moyen_paiement = PofFactureMoyenPaiement::where('id_facture', $id_facture)
                ->where('id_moyen_paiement', $id_moyen_paiement)
                ->first();
        
        if($facture_moyen_paiement) {
            return round($facture_moyen_paiement->montant, 2);
        }
        else {
            return 0;
        }
    }

    // Calcule et renvoie le montant utilisé sur le bon d'achat donné, pour régler la facture donnée
    public static function factureBonachatMontantUtilise($id_facture, $id_bonachat) {
        $facture_bonachat = PofFactureBonachat::where('id_facture', $id_facture)
            ->where('id_bonachat', $id_bonachat)
            ->first();
        
        if($facture_bonachat) {
            $montant = $facture_bonachat->montant;
        }
        else {
            $montant = 0;
        }

        return $montant;
    }

    // Calcule et retourne le montant total utilisé en bons d'achat pour la facture donnée
    public static function factureBonachatsUtilises($id_facture) {
        $facture_bonachats = PofFactureBonachat::where('id_facture', $id_facture)
            ->get();

        $total_bonachats = 0;
        foreach($facture_bonachats as $bonachat) {
            $total_bonachats += $bonachat->montant;
        }

        return $total_bonachats;
    }

    // Calcule et renvoie le reste à renseigner entre les différents moyens de paiement d'une facture
    public static function factureResteARenseigner($id_facture) {
        $facture = PofFacture::find($id_facture);

        // Calcul des moyens de paiement déjà renseignés
        $facture_moyens_paiement = $facture->poffacturemoyenspaiement;
        $total_moyens_paiement = 0;
        foreach($facture_moyens_paiement as $moyen_paiement) {
            $total_moyens_paiement += $moyen_paiement->montant;
        }

        $reste = $facture->total_bonachat_deduis - $total_moyens_paiement;
        return $reste;
    }
}