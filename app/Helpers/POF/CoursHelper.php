<?php
namespace App\Helpers\POF;
 
use App\Models\Pof\PofCours;

use App\Models\Pof\PofCheval;
use App\Models\Pof\PofClient;
use App\Traits\Pof\CoursTrait;
use App\Models\Pof\PofCoursClient;
use App\Models\Pof\PofClientNiveau;
use Illuminate\Support\Facades\DB;
use App\Models\Pof\PofCoursClientNiveau;
 
class CoursHelper {
    
    use CoursTrait;
    
    public static function chevalNombreUtilisation($id_cheval,$id_cours) {
        
        $cours = PofCours::find($id_cours);
        $cheval = PofCheval::find($id_cheval);
        $nbminutes = 0;

        $coursclients = PofCoursClient::where('id_cheval',$cheval->id_cheval)
                ->join('pof_cours','pof_cours.id_cours','=','pof_cours_client.id_cours')
                ->where('pof_cours.date_cours',$cours->date_cours)
                ->get();

        foreach($coursclients as $coursclient) {
            $duree = $coursclient->pofcours->duree;

            $params = explode(':', $duree);
            // On ajoute le nombre de minutes
            $nbminutes += intval($params[0])*60;
            $nbminutes += intval($params[1]);
        }

        // Et on convertit le total en heures
        $nbheures = $nbminutes / 60;
        
        return $nbheures;
    }


    public static function dureeCours($id_cours) {
        $cours = PofCours::find($id_cours);
        $duree = $cours->duree;
        $params = explode(':', $duree);

        $heures = intval($params[0]);
        $minutes = intval($params[1]);

        $textduree = $heures.'h';
        if($minutes != 0) {
            $textduree .= $minutes;
        }

        return $textduree;
    }


    // Vérifie si le cours accepte bien le niveau choisi
    public static function verifierCoursNiveau(PofCours $cours, PofClientNiveau $client_niveau) {
        if($cours_client_niveau = PofCoursClientNiveau::where('id_cours', $cours->id_cours)
            ->where('id_client_niveau', $client_niveau->id_client_niveau)
            ->first())
        {
            return true;
        } else {
            return false;
        }
    }

    
    public static function coursClientGetCheval(PofCours $cours, PofClient $client) {
        $coursclient = PofCoursClient::where('id_cours', $cours->id_cours)
                ->where('id_client', $client->id_client)
                ->first();
        
        $cheval = PofCheval::find($coursclient->id_cheval);

        return $cheval;
    }


    // Renvoie le $coursclient à partir d'un client et d'un cours
    public static function getCoursClient(PofCours $cours, PofClient $client) {
        $coursclient = PofCoursClient::where('id_cours', $cours->id_cours)
                ->where('id_client', $client->id_client)
                ->first();

        return $coursclient;
    }


    // Renvoie les cours auxquels s'est inscrit un client
    public static function clientCours(PofClient $client) {
        $coursclients = $client->pofcoursclients;
        $cours_ids = [];

        foreach($coursclients as $coursclient) {
            array_push($cours_ids, $coursclient->pofcours->id_cours);
        }

        $cours = PofCours::whereIn('id_cours', $cours_ids)->get();
        return $cours;
    }
}