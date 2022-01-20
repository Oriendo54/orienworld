<?php
 
namespace App\Traits\Pof;

use App\Models\Pof\PofClient;
use App\Traits\Pof\ClientTrait;
use App\Models\Pof\PofPrestation;
use Illuminate\Support\Facades\DB;
use App\Models\Pof\PofPrestationgroupe;

trait PrestationTrait {

    use ClientTrait;
   /*
    * prendre les prestations :
    * - compatibles avec le statut du client (statut identique ou pas de statut défini)
    * - non secondaires (dans une association et non principale)
    */
    public function clientPrestationCompatibles(PofClient $client) {
        $client_age = $this->clientAge($client);

        $prestations = PofPrestation::select('pof_prestation.*')
            ->where(function($query) use ($client){
                $query->where('id_client_statut', $client->id_client_statut)
                    ->orWhere('id_client_statut',0)
                    ;
            })
            ->where(function($query) use ($client_age){
                $query->where([['age_min_client', 0],['age_max_client', 0]])
                    ->orWhere([['age_min_client','<=', $client_age],['age_max_client','>=', $client_age]])
                    ;
            })
            ->leftjoin('pof_prestation_association_lien', 'pof_prestation.id_prestation', 'pof_prestation_association_lien.id_prestation')
            ->where(function($query) use ($client){
                $query->where('pof_prestation_association_lien.prestation_principale', 1)
                    ->orWhere('pof_prestation_association_lien.id_prestation_association_lien', null)
                    ;
            })
            ->orderBy('pof_prestation.libelle')
            ->get();

        return $prestations;
    }

    /*
    * prendre les groupes de prestations
    * dont toutes les prestations sont compatibles avec le client
    */
    public function clientPrestationgroupeCompatibles(PofClient $client) {
        $client_age = $this->clientAge($client);

        $groupes = PofPrestationgroupe::select('pof_prestation_groupe.*')->distinct()
                ->join('pof_prestation_groupe_lien', 'pof_prestation_groupe.id_prestation_groupe', 'pof_prestation_groupe_lien.id_prestation_groupe')
                ->join('pof_prestation', 'pof_prestation_groupe_lien.id_prestation', 'pof_prestation.id_prestation')
                ->where(function($query) use ($client){
                    $query->where('id_client_statut', $client->id_client_statut)
                            ->orwhere('id_client_statut',0);
                  })
                ->where(function($query) use ($client_age){
                    $query->where([['age_min_client','<=', $client_age],['age_max_client','>=', $client_age]]);
                  })
                ->get();

        return $groupes;
    }
}