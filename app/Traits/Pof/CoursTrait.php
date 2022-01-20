<?php
 
namespace App\Traits\Pof;

use Carbon\Carbon;

use App\Models\Pof\PofCours;
use App\Models\Pof\PofClient;
use App\Traits\Pof\TestTrait;
use App\Models\Pof\PofCoursType;
use App\Models\Pof\PofPrestation;
use App\Models\Pof\PofCoursClient;
use Illuminate\Support\Facades\DB;
use App\Models\Pof\PofCoursEmplacement;
use App\Models\Pof\PofCoursClientNiveau;

trait CoursTrait {
    
    use TestTrait;
    
    /*
     * ajouter ou modifier un cours
     */
    public function coursMAJ($id_cours, $id_cours_type, $id_moniteur, $date_cours, $heure_debut, $heure_fin, $duree, $nb_cavalier_max, 
            $id_cours_emplacement, $nb_repetition_cours, $cours_client_niveaux, $libelle) {
        
        if($date_cours) {
            $date_cours = Carbon::createFromFormat('d/m/Y', $date_cours);
        } elseif($id_cours) {
            $cours = PofCours::find($id_cours);
            $date_cours = Carbon::createFromFormat('Y-m-d', $cours->date_cours);
        } else {
            return $this->getErrorModal("Pas de date pour ce cours");
        }
        
        $date_cours_init = Carbon::instance($date_cours);
        
        for ($i = 1; $i <= $nb_repetition_cours; $i++) {
            
            if(!$this->coursVerifierMoniteur($date_cours, $id_moniteur, $id_cours, $heure_debut, $heure_fin)) {
                
                $alerte = "Ce moniteur donne déjà un cours à la même heure :<br>"
                                . $date_cours->format('d/m/Y')."<br>"
                                . $heure_debut." - ".$heure_fin."<br>"
                                . "Choisissez un autre moniteur ou un horaire différent.";
                return $this->getErrorModal($alerte);
            }

            if(!$this->coursVerifierEmplacement($date_cours, $id_cours_emplacement, $id_cours, $heure_debut, $heure_fin)) {
                
                $coursemplacement = PofCoursEmplacement::find($id_cours_emplacement);
                $alerte = "Un cours a déjà lieu à l'emplacement choisi :<br>"
                                . $coursemplacement->libelle."<br>"
                                . $date_cours->format('d/m/Y')."<br>"
                                . $heure_debut." - ".$heure_fin."<br>"
                                . "Choisissez un autre emplacement ou un horaire différent.";
                return $this->getErrorModal($alerte);
            }

            if(!$this->coursVerifierPrestation($id_cours_type,$duree)) {
                
                $courstype = PofCoursType::find($id_cours_type);
            
                $alerte = "Aucune prestation compatible avec ce cours.<br>"
                                . "Il manque une ou des prestations ayant comme paramètre :<br>"
                                . "- le type de cours sélectionné : ".$courstype->libelle."<br>"
                                . "- la durée sélectionnée : ". $duree;
                return $this->getErrorModal($alerte);
            }
            
            $date_cours = $date_cours->addDays(7);
        }
        
        $date_cours = Carbon::instance($date_cours_init);
        
        for ($i = 1; $i <= $nb_repetition_cours; $i++) {
            
            if(!$id_cours) {
                $cours = new PofCours;
            } else {
                $cours = PofCours::find($id_cours);
            }

            $cours->id_cours_type = $id_cours_type;
            $cours->id_moniteur = $id_moniteur;
            $cours->date_cours = $date_cours->format('Y-m-d');
            $cours->heure_debut = $heure_debut;
            $cours->heure_fin = $heure_fin;
            $cours->duree = $duree;
            $cours->libelle = $libelle;

            if(!is_nan($nb_cavalier_max)) {
                $cours->nb_cavalier_max = $nb_cavalier_max;
            }

            $cours->id_cours_emplacement = $id_cours_emplacement;
            
            $cours->save();
            
            if($i==1) {
                
                $id_cours_init = $cours->id_cours;
            }
            
            $date_cours = $date_cours->addDays(7);

            foreach($cours_client_niveaux as $cours_client_niveau) {
                $niveau = new PofCoursClientNiveau;
                $niveau->id_cours = $cours->id_cours;
                $niveau->id_client_niveau = $cours_client_niveau;
                $niveau->save();
            }
        }
        
        return response()->json([
            'date_cours' => $date_cours_init->format('d/m/Y'),
            'id_cours' => $id_cours_init
        ]);
    }
    
    
    
    /*
     * Vérifier s'il existe un cours avec le même moniteur à la même heure.
     */
    public function coursVerifierMoniteur($date_cours, $id_moniteur, $id_cours, $heure_debut, $heure_fin) {
    
        $cours_a_verifier = PofCours::where('date_cours', $date_cours->format('Y-m-d'))
                ->where('id_moniteur', $id_moniteur)
                ->where('id_cours','!=', $id_cours)
                ->get();

        foreach($cours_a_verifier as $cav) {
            if ($this->testChevauchementCours($cav->heure_debut, $cav->heure_fin, $heure_debut, $heure_fin)) {
                return false;
            }
        }
        
        return true;
    }
    
    
    /*
     * Puis vérifier s'il en existe un au même emplacement
     */
    public function coursVerifierEmplacement($date_cours, $id_cours_emplacement, $id_cours, $heure_debut, $heure_fin) {
    
        $cours_a_verifier = PofCours::where('date_cours', $date_cours->format('Y-m-d'))
            ->where('id_cours_emplacement', $id_cours_emplacement)
            ->where('id_cours','!=', $id_cours)
            ->get();

        foreach($cours_a_verifier as $cav) {
            
//            $message = $cav->id_cours.' '.$cav->date_cours.' '.$cav->pofcoursemplacement->libelle.' '.$cav->heure_debut.' '.$cav->heure_fin;
//            $this->PofLog($message);
            
            if($this->testChevauchementCours($cav->heure_debut, $cav->heure_fin, $heure_debut, $heure_fin)) {
                return false;
            }
        }
        
        return true;
    }
    
    
    /*  
    *   - Vérifie si le cours B chevauche le cours A.
    *   - Params :
    *       -> heure de début et de fin du cours A au format H:i:s
    *       -> heure de début et de fin du cours B au format H:i:s
    *   - Retourne true s'il y a chevauchement.
    */
    public function testChevauchementCours($debut_cours_a, $fin_cours_a, $debut_cours_b, $fin_cours_b) {
        $debut_a = intval(implode(explode(':', $debut_cours_a)));
        $fin_a = intval(implode(explode(':', $fin_cours_a)));
    
        $debut_b = intval(implode(explode(':', $debut_cours_b)));
        $fin_b = intval(implode(explode(':', $fin_cours_b)));
    
        // Les heures de début ou de fin sont identiques
        if($debut_a == $debut_b || $fin_a == $fin_b) {
//            $this->PofLog('Les heures de début ou de fin sont identiques');
            return true;
        }
        // Le début de A est contenu dans B
        if($debut_a > $debut_b && $debut_a < $fin_b) {
//            $this->PofLog('Le début de A est contenu dans B');
            return true;
        }
        // La fin de A est contenue dans B
        if($fin_a > $debut_b && $fin_a < $fin_b) {
//            $this->PofLog('La fin de A est contenue dans B');
            return true;
        }
        // B est contenu dans A
        if($debut_b > $debut_a && $fin_b < $fin_a) {
//            $this->PofLog('B est contenu dans A');
            return true;
        }
        else {
            return false;
        }
    }
    
    
    /*  
    * calcl de la durée d'un cours
    */
    public function coursDuree($heure_debut, $heure_fin) {
        
        $heure_debut = Carbon::createFromFormat('H:i:s',$heure_debut);
        $heure_fin = Carbon::createFromFormat('H:i:s',$heure_fin);
        
        return gmdate("H:i:s", $heure_debut->diffInSeconds($heure_fin));
    }
    
    
    /*
    * vérifie si un cours possède des prestations
    */
    public function coursVerifierPrestation($id_cours_type,$duree) {

        if(!PofPrestation::where([['id_cours_type', $id_cours_type]])
            ->where(function($query) use ($duree){
                $query->where('duree', $duree)
                    ->orWhere('duree', '00:00:00')
                    ;
                })
            ->first()) {
            return false;
        }
        
        return true;
    }


    public function getCoursSuperposes(PofCours $cours) {
        // On teste tous les autres cours de la journée
        $cours_a_tester = PofCours::where('id_cours', '!=', $cours->id_cours)
            ->where('id_cours_emplacement', $cours->id_cours_emplacement)
            ->where('date_cours', $cours->date_cours)
            ->get();
        $superpositions = [];

        foreach($cours_a_tester as $cours_compare) {
            // S'il y a chevauchement, on les insère dans un tableau
            if($chevauchement = $this->testChevauchementCours($cours->heure_debut, $cours->heure_fin, 
            $cours_compare->heure_debut, $cours_compare->heure_fin)) {
                array_push($superpositions, $cours_compare);
            }
        }

        return $superpositions;
    }


    /*
    * getTotalValidesJournee :
    *   - Calcule le nombre de cavaliers validés dans la journée
    */
    public function getTotalValidesJournee($date_cours) {
        $params = explode('/', $date_cours);
        $cours_du_jour = PofCours::where('date_cours', Carbon::createFromDate($params[2], $params[1], $params[0])->format('Y-m-d'))->get();

        $nb_valides = 0;
        foreach($cours_du_jour as $cours) {
            $coursclient = PofCoursClient::where('id_cours', $cours->id_cours)->where('id_cours_client_statut', 2)->get();
            $nb_valides += count($coursclient);
        }

        return $nb_valides;
    }


    /*
    * getTotalInscritsJournee :
    *   - Calcule le nombre de cavaliers inscrits + le nombre de cavaliers validés dans la journée
    */
    public function getTotalInscritsJournee($date_cours) {
        $params = explode('/', $date_cours);
        $cours_du_jour = PofCours::where('date_cours', Carbon::createFromDate($params[2], $params[1], $params[0])->format('Y-m-d'))->get();

        $nb_cavaliers = 0;
        foreach($cours_du_jour as $cours) {
            $nb_cavaliers += count($cours->pofcoursclient);
        }

        return $nb_cavaliers;
    }


    
    public function coursInscrire(PofCours $cours,PofClient $client) {
        
        if(PofCoursClient::where('id_client', $client->id_client)
            ->where('id_cours', $cours->id_cours)
            ->first()) {
            
            return false;
            
        } else {
            
            $coursDejaInscrits = PofCours::where('date_cours',$cours->date_cours)
                    ->join('pof_cours_client', 'pof_cours_client.id_cours', '=', 'pof_cours.id_cours')
                    ->where('id_client',$client->id_client)
                    ->get();
            
            foreach($coursDejaInscrits as $coursDejaInscrit) {
                if($this->testChevauchementCours($cours->heure_debut, $cours->heure_fin, $coursDejaInscrit->heure_debut, $coursDejaInscrit->heure_fin)) {
                    return $this->getErrorModal('Ce cavalier est déjà inscrit dans un cours qui se déroule à la même heure.');
                }
            }
            
            $cours_client = new PofCoursClient;
            $cours_client->id_cours = $cours->id_cours;
            $cours_client->id_client = $client->id_client;
            $cours_client->id_cheval = null;
            $cours_client->id_cours_client_statut = 1;
            $cours_client->save();

            return true;
        }
    }


    public function coursVerifierClientNiveau(PofCours $cours, PofClient $client) {
        if($cours_client_niveaux = PofCoursClientNiveau::where('id_cours', $cours->id_cours)
                ->where('id_client_niveau', $client->pofclientniveau->id_client_niveau)
                ->first()) 
        {
            return true;
        }
        else {
            return false;
        }
    }
}