<?php
namespace App\Helpers\POF;

use App\Models\Pof\PofCours;
use App\Models\Pof\PofCheval;
use Illuminate\Support\Facades\DB;

class StatsHelper {

    public static function chevalCalculerUtilisations(PofCheval $cheval, $date_debut, $date_fin) {
        $cours_periode = PofCours::where('id_cheval', $cheval->id_cheval)
                ->whereBetween('date_cours', [$date_debut, $date_fin])
                ->join('pof_cours_client', 'pof_cours_client.id_cours', 'pof_cours.id_cours')
                ->get();

        $nbminutes = 0;
        foreach($cours_periode as $cours) {

            $params = explode(':', $cours->duree);
            // On ajoute le nombre de minutes
            $nbminutes += intval($params[0])*60;
            $nbminutes += intval($params[1]);
        }
        $nbheures = $nbminutes/60;

        return $nbheures;
    }
}