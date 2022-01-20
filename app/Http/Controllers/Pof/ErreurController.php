<?php

namespace app\Http\Controllers\Pof;

use Carbon\Carbon;
use App\Models\Pof\PofLog;
use App\Models\Pof\PofCours;
use Illuminate\Http\Request;
use App\Traits\Pof\TestTrait;
use App\Traits\Pof\CoursTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ErreurController extends Controller {

    use CoursTrait;
    use TestTrait;
    
    public function erreurs() {
        
        // Récupérer tous les cours qui se chevauchent
        $cours_du_jour = PofCours::where('date_cours', Carbon::now()->format('Y-m-d'))->get();
        $cours_superposes = [];

        foreach($cours_du_jour as $cours) {
            if(count($test = $this->getCoursSuperposes($cours)) > 0) {
                if(!in_array($cours, $cours_superposes)) {
                    array_push($cours_superposes, $cours);
                }
            }
        }
        
        $logs = PofLog::orderBy('id_log', 'desc')->limit(100)->get();

        return view('pony.erreurs.erreurs', compact('cours_superposes', 'logs'));
    }

    /*
     * Supprimer les logs qui ont plus de 9 jours
     */
    function PofLogNettoyage() {
        
        $sql = 'delete from pof_log where created_at < date_add(now(), INTERVAL -9 DAY);';
        
        DB::select($sql);
    }

    /*
    * Vide complètement les logs.
    */
    function PofViderLogs() {
        $sql = 'truncate table pof_log;';
        
        DB::select($sql);
    }

}