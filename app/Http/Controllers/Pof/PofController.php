<?php

namespace app\Http\Controllers\Pof;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Pof\PofCarte;
use App\Models\Pof\PofCours;
use Illuminate\Http\Request;
use App\Models\Pof\PofCheval;
use App\Models\Pof\PofClient;
use App\Traits\Pof\TestTrait;
use App\Models\Pof\PofFacture;
use App\Traits\Pof\CoursTrait;
use App\Models\Pof\PofCoursType;
use App\Models\Pof\PofMoniteurs;
use App\Models\Pof\PofChevalType;
use App\Models\Pof\PofPrestation;
use App\Models\Pof\PofCoursClient;

use Illuminate\Support\Facades\DB;
use App\Models\Pof\PofClientNiveau;
use App\Models\Pof\PofClientStatut;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\Pof\PofCoursClientNiveau;
use Illuminate\Support\Facades\Validator;
use App\Models\Pof\PofCoursTypePrestation;

class PofController extends Controller {
    
    use CoursTrait;
    use TestTrait;
    
    public function index() {
        
        if(Gate::allows('client')) {
            $user = User::find(auth()->user()->id);
            $client = $user->pofclient;
            $enfants = PofClient::where('id_client_parent', $client->id_client)->get();
            
            return view('pony.client.client_home', compact('client', 'enfants'));
        }
        
        if(Gate::allows('back-access')) {
            $clients = PofClient::all();
            return view('pony.index',compact('clients'));
        }

        $erreur = 'Impossible d\'accéder à l\'application car vous n\'êtes pas enregistré comme client. Veuillez contacter un administrateur pour corriger le problème.';
        return $this->getErrorModal($erreur);
    }
    
    
    public function script() {
        
//        $coursAll = PofCours::orderby('date_cours')
//            ->orderby('heure_debut')
//            ->orderby('heure_fin')
//            ->get()
//            ;
//        
//        $i = 0;
//        $message = '';
//        
//        $debut_cours_a = null; 
//        $fin_cours_a = null;
//        $debut_cours_b = null;
//        $fin_cours_b = null;
//        
//        foreach($coursAll as $cours) {
//            
//            $debut_cours_a = $cours->heure_debut;
//            $fin_cours_a = $cours->heure_fin;
//            
//            $cours->id_cours_emplacement = 1;
//            $cours->id_moniteur = 1;
//            
//            if($debut_cours_b) {
//                if($this->testChevauchementCours($debut_cours_a, $fin_cours_a, $debut_cours_b, $fin_cours_b)) {
//                    $i++;
//                } else {
//                    $i = 0;
//                }
//            }
//            
//            $cours->id_cours_emplacement += $i;
//            $cours->id_moniteur += $i;
//            $cours->save();
//            
//            $message .= $cours->heure_debut.' '.$cours->heure_fin.' '.$cours->id_cours_emplacement.' '.$cours->id_moniteur.'<br>';
//            
//            $debut_cours_b = $cours->heure_debut;
//            $fin_cours_b = $cours->heure_fin;
//        }
        
        return $this->getMessageModal($message);
    }
    
    

    /*
    * clearAffichage :
    *   - Renvoie la vue index.
    *   - Le fichier JS se charge de nettoyer les éléments de la vue une fois la requête aboutie.
    */
    public function clearAffichage() {
        
        $clients = PofClient::all();
        return view('pony.index',compact('clients'));
    }



    // GESTION DES DATES

    /*
    * getCarbonFromRequest :
    *   - Contrôle le format de la date transmise via l'objet $request
    *   - Renvoie une date Carbon pouvant être manipulée, ou la valeur null.
    */
    public function getCarbonFromRequest(Request $request) {
        // On vérifie si la date fournie dans la requête correspond au pattern yyyy-mm-dd
        if($request->date && preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}/', $request->date)) {
            $params = explode('-', $request->date);
            $date = Carbon::createFromDate($params[0], $params[1], $params[2]);
        }
        // Ou au pattern dd/mm/yyyy
        else if($request->date && preg_match('/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/', $request->date)) {
            $params = explode('/', $request->date);
            $date = Carbon::createFromDate($params[2], $params[1], $params[0]);
        }
        // Ou au pattern dd-mm-yyyy
        else if($request->date && preg_match('/[0-9]{2}-[0-9]{2}-[0-9]{4}/', $request->date)) {
            $params = explode('-', $request->date);
            $date = Carbon::createFromDate($params[2], $params[1], $params[0]);
        }
        else {
            $date = null;
        }
        return $date;
    }


    /*
    * changeDatePlanning :
    *   - Génère et renvoie une nouvelle date pour le planning à partir d'une date et d'un nombre de jours de décalage.
    *   - Renvoie "error" en cas d'erreur.
    */
    public function changeDatePlanning(Request $request) {
        
        $ancienne_date = $this->getCarbonFromRequest($request);

        if(!$ancienne_date) {
//            $alerte = "format de date non reconnu. Impossible de mettre à jour le planning.";
//            $error = $this->getErrorModal($alerte);
//            return $error;
            $ancienne_date = Carbon::now()->format('Y-m-d');
        }
//        else {
        $nouvelle_date = $ancienne_date;
        
            if($request->decalage == 1) {
                $nouvelle_date = $ancienne_date->addDay()->format('Y-m-d');
            }
            if($request->decalage == -1) {
                $nouvelle_date = $ancienne_date->subDay()->format('Y-m-d');
            }
            if($request->decalage == 7) {
                $nouvelle_date = $ancienne_date->addWeek()->format('Y-m-d');
            }
            if($request->decalage == -7) {
                $nouvelle_date = $ancienne_date->subWeek()->format('Y-m-d');
            }

            if(!$nouvelle_date) {
                $alerte = "impossible de générer la nouvelle date souhaitée pour mettre à jour le planning";
                $error = $this->getErrorModal($alerte);
                return $error;
            }
            else {
                return response()->json([
                    'nouvelle_date' => $nouvelle_date
                ]);
            }            
//        }
    }


    /*
    * getPlanning :
    *   - Génère le planning des cours pour la date choisie par l'utilisateur.
    *   - Si l'utilisateur n'a pas transmis de date via la requête, par défaut, génère le planning pour aujourd'hui.
    *   - Renvoie dans un objet Json la liste des cours et la vue du planning.
    */
    public function getPlanning(Request $request) {
        
        if($request->decalage) {
            // Si un décalage est fourni dans la requête, on génère la nouvelle date.
            $date = $this->changeDatePlanning($request);
            if($date === 'error') {
                $alerte = "format de date non reconnu. Impossible de mettre à jour le planning.";
                $error = $this->getErrorModal($alerte);
                return $error;
            }
        }
        else {
            $date = $this->getCarbonFromRequest($request);
        }
        if($date == null) {
            $date = Carbon::today();
        }

        $cours_liste = PofCours::where('date_cours', $date->format('Y-m-d'))->get();
        
        // Formatage de la date pour l'affichage
            switch($date->format('l')) {
                case "Monday":
                    $date_planning = "Lundi ".$date->format('d/m/Y');
                    break;
                case "Tuesday":
                    $date_planning = "Mardi ".$date->format('d/m/Y');
                    break;
                case "Wednesday":
                    $date_planning = "Mercredi ".$date->format('d/m/Y');
                    break;
                case "Thursday":
                    $date_planning = "Jeudi ".$date->format('d/m/Y');
                    break;
                case "Friday":
                    $date_planning = "Vendredi ".$date->format('d/m/Y');
                    break;
                case "Saturday":
                    $date_planning = "Samedi ".$date->format('d/m/Y');
                    break;
                case "Sunday":
                    $date_planning = "Dimanche ".$date->format('d/m/Y');
                    break;   
            }

        // Préparation du tableau contenant la liste des cours pour l'affichage dans le planning
        $listecours = $this->prepareCoursPourPlanning($cours_liste);
        $date = $date->format('Y-m-d');

        return response()->json([
            'view' => view('pony.pof.planning_cours', compact('cours_liste', 'date_planning', 'date'))
                ->render(),
//            'cours_liste' => $cours_liste,
            'listecours' => $listecours
        ]);
    }


    /*
    * prepareCoursPourPlanning :
    *   - Prépare la liste des cours et la formate pour l'affichage dans la vue.
    *   - Renvoie un tableau $listecours à la fonction getPlanning.
    */
    public function prepareCoursPourPlanning($array_cours) {
        
        $listecours = [];
        foreach ($array_cours as $cours) {
            // Calcul du nombre de cases que le cours doit occuper sur le planning
            $duree_cours = explode(':', $cours->duree);
            $duree_minutes = intval($duree_cours[1]) + intval($duree_cours[0])*60;
            $nombre_cases = $duree_minutes/15;

            // Ajout d'un tableau [heures_occupees] contenant toutes les heures que le cours recouvre, avec un pas de 15min
            // afin de pouvoir sélectionner les cellules à supprimer dans le planning pour l'affichage.
            $params_fin = explode(':', $cours->heure_fin);
            $params_debut = explode(':', $cours->heure_debut);

            $fin = Carbon::CreateFromTime($params_fin[0], $params_fin[1]);
            $debut = Carbon::CreateFromTime($params_debut[0], $params_debut[1]);
            $heures_occupees = [];

            while($fin != $debut) {
                $fin = $fin->subMinute(15);
                array_push($heures_occupees, $fin->format('H:i:s'));
            }

            array_pop($heures_occupees);

            // Construction du tableau qui sera envoyé au fichier JS dans la réponse
            $cours_details = [
                'id_cours' => $cours->id_cours,
                'id_cours_type' => $cours->id_cours_type,
                'heure_debut' => $cours->heure_debut,
                'heure_fin' => $cours->heure_fin,
                'duree' => $cours->duree,
                'heures_occupees' => $heures_occupees,
                'nombre_cases' => $nombre_cases,
                'emplacement' => $cours->id_cours_emplacement,
                'nb_cavaliers_valides' => count(PofCoursClient::where('id_cours', $cours->id_cours)->where('id_cours_client_statut', 2)->get()),
                'nb_cavalier_inscrits' => count(PofCoursClient::where('id_cours', $cours->id_cours)->get()),
                'moniteur_nom' => $cours->pofmoniteur->nom,
                'moniteur_prenom' => $cours->pofmoniteur->prenom,
                'moniteur_couleur' => $cours->pofmoniteur->couleur,
                'couleur' => $cours->pofcourstype->couleur_planning,
                'libelle' => $cours->pofcourstype->libelle_planning
            ];
            array_push($listecours, $cours_details);
        }
        return $listecours;
    }


    /*
    * getSemainePlanning :
    *   - Génère le semainier en fonction de la date fournie en paramètre.
    *   - Renvoie $semaine_planning
    */

    
    public function getSemainePlanning($date) {
        switch($date->format('l')) {
            case "Monday":
                $semaine_planning = [
                    'lundi' => $date->format('d/m/Y'),
                    'mardi' => $date->addDay()->format('d/m/Y'),
                    'mercredi' => $date->addDay()->format('d/m/Y'),
                    'jeudi' => $date->addDay()->format('d/m/Y'),
                    'vendredi' => $date->addDay()->format('d/m/Y'),
                    'samedi' => $date->addDay()->format('d/m/Y'),
                    'dimanche' => $date->addDay()->format('d/m/Y'),
                ];
                break;
            case "Tuesday":
                $semaine_planning = [
                    'lundi' => $date->subDay()->format('d/m/Y'),
                    'mardi' => $date->addDay()->format('d/m/Y'),
                    'mercredi' => $date->addDay()->format('d/m/Y'),
                    'jeudi' => $date->addDay()->format('d/m/Y'),
                    'vendredi' => $date->addDay()->format('d/m/Y'),
                    'samedi' => $date->addDay()->format('d/m/Y'),
                    'dimanche' => $date->addDay()->format('d/m/Y'),
                ];
                break;
            case "Wednesday":
                $semaine_planning = [
                    'lundi' => $date->subDay(2)->format('d/m/Y'),
                    'mardi' => $date->addDay()->format('d/m/Y'),
                    'mercredi' => $date->addDay()->format('d/m/Y'),
                    'jeudi' => $date->addDay()->format('d/m/Y'),
                    'vendredi' => $date->addDay()->format('d/m/Y'),
                    'samedi' => $date->addDay()->format('d/m/Y'),
                    'dimanche' => $date->addDay()->format('d/m/Y'),
                ];
                break;
            case "Thursday":
                $semaine_planning = [
                    'lundi' => $date->subDay(3)->format('d/m/Y'),
                    'mardi' => $date->addDay()->format('d/m/Y'),
                    'mercredi' => $date->addDay()->format('d/m/Y'),
                    'jeudi' => $date->addDay()->format('d/m/Y'),
                    'vendredi' => $date->addDay()->format('d/m/Y'),
                    'samedi' => $date->addDay()->format('d/m/Y'),
                    'dimanche' => $date->addDay()->format('d/m/Y'),
                ];
                break;
            case "Friday":
                $semaine_planning = [
                    'lundi' => $date->subDay(4)->format('d/m/Y'),
                    'mardi' => $date->addDay()->format('d/m/Y'),
                    'mercredi' => $date->addDay()->format('d/m/Y'),
                    'jeudi' => $date->addDay()->format('d/m/Y'),
                    'vendredi' => $date->addDay()->format('d/m/Y'),
                    'samedi' => $date->addDay()->format('d/m/Y'),
                    'dimanche' => $date->addDay()->format('d/m/Y'),
                ];
                break;
            case "Saturday":
                $semaine_planning = [
                    'lundi' => $date->subDay(5)->format('d/m/Y'),
                    'mardi' => $date->addDay()->format('d/m/Y'),
                    'mercredi' => $date->addDay()->format('d/m/Y'),
                    'jeudi' => $date->addDay()->format('d/m/Y'),
                    'vendredi' => $date->addDay()->format('d/m/Y'),
                    'samedi' => $date->addDay()->format('d/m/Y'),
                    'dimanche' => $date->addDay()->format('d/m/Y'),
                ];
                break;
            case "Sunday":
                $semaine_planning = [
                    'lundi' => $date->subDay(6)->format('d/m/Y'),
                    'mardi' => $date->addDay()->format('d/m/Y'),
                    'mercredi' => $date->addDay()->format('d/m/Y'),
                    'jeudi' => $date->addDay()->format('d/m/Y'),
                    'vendredi' => $date->addDay()->format('d/m/Y'),
                    'samedi' => $date->addDay()->format('d/m/Y'),
                    'dimanche' => $date->addDay()->format('d/m/Y'),
                ];
                break;   
        }
        return $semaine_planning;
    }
    

    /*
    * getTotalCavaliersSemaineByTerm :
    *   - Retourne le nombre total de cavaliers validés ou le nombre total de cavaliers inscrits sur la semaine
    *   - Pour choisir le total renvoyé, passer 'valides' ou 'inscrits' en deuxième paramètre de la fonction
    */
    public function getTotalCavaliersSemaineByTerm($semaine_planning, $term) {
        $total = $semaine_planning['lundi_'.$term] + $semaine_planning["mardi_".$term] + $semaine_planning["mercredi_".$term] + $semaine_planning["jeudi_".$term] + $semaine_planning["vendredi_".$term] + $semaine_planning["samedi_".$term] + $semaine_planning["dimanche_".$term];
        return $total;
    }


    /*
    * addTotauxSemainePlanning :
    *   - pour chaque jour du semainier, calcule le nombre de cavaliers validés et le nombre total d'inscrits
    *   - insère ces valeurs dans le tableau $semaine_planning pour l'affichage
    *   - retourne $semaine_planning
    */
    public function addTotauxSemainePlanning($semaine_planning) {
        $totaux = [];

        foreach($semaine_planning as $key => $jour) {
            $totaux[$key.'_inscrits'] = $this->getTotalInscritsJournee($jour);
            $totaux[$key.'_valides'] = $this->getTotalValidesJournee($jour);
        }

        $semaine_planning = array_merge($totaux, $semaine_planning);
        return $semaine_planning;
    }

    
    /*
    * selectionDatePlanning :
    *   - Renvoie dans un objet Json la vue selection_date_planning et le semainier.
    */
    public function selectionDatePlanning(Request $request) {

        $date = $this->getCarbonFromRequest($request);
        if($date == null) {
            $date = Carbon::today();
        }

        // Création du tableau semaine_planning
        $semaine_planning = $this->getSemainePlanning($date);
        $semaine_planning = $this->addTotauxSemainePlanning($semaine_planning);

        $total_inscrits = $this->getTotalCavaliersSemaineByTerm($semaine_planning, 'inscrits');
        $total_valides = $this->getTotalCavaliersSemaineByTerm($semaine_planning, 'valides');

        $moniteurs = PofMoniteurs::all();

        return response()->json([
            'view' => view('pony.pof.selection_date_planning', compact('semaine_planning', 'moniteurs'))
                ->render(),
            'semaine_planning' => $semaine_planning,
            'total_inscrits' => $total_inscrits,
            'total_valides' => $total_valides
        ]);
    }


    /*
    * afficherClientDetails :
    *   - Nécessite un id_client dans la requête.
    *   - Prépare les paramètres nécessaires pour la vue clients_details.
    *   - Renvoie la vue clients_details et compacte les paramètres nécessaires.
    */
    public function afficherClientDetails(Request $request) {
        $client = PofClient::find($request->id_client);

        $naissance = $client->date_naissance;
        $now = Carbon::Today();
        $age = $now->DiffInYears($naissance);
        
        $client5dernierscours = PofCours::select(
                    'pof_cours.id_cours as id_cours',
                    'pof_cours.date_cours as date_cours',
                    'pof_cours.heure_debut as heure_debut',
                    'pof_cours_type.libelle as libelle',
                    'pof_cours_client.id_cheval as id_cheval',
                    'pof_cheval.nom as nom'
                )
                ->join('pof_cours_type','pof_cours_type.id_cours_type','=','pof_cours.id_cours_type')
                ->join('pof_cours_client','pof_cours_client.id_cours','=','pof_cours.id_cours')
                ->leftjoin('pof_cheval','pof_cheval.id_cheval','=','pof_cours_client.id_cheval')
                ->where('id_client',$client->id_client)
                ->orderBy('date_cours','desc')
                ->orderBy('heure_debut', 'desc')
                ->limit(5)
                ->get()
                ;

        return response()->json([
            'view' => view('pony.pof.client_details', compact('client', 'age','client5dernierscours'))
                ->render()
        ]);
    }


    public function coursAjouterModal(Request $request) {
        
        $moniteurs = PofMoniteurs::all();
        
        $date_cours = null;
        if($request->date_cours) {
            $date_cours = $request->date_cours;
        }
        
        $cours = PofCours::find($request->id_cours);
        $client_niveaux = PofClientNiveau::where('id_client_niveau', '<', 7)->get();
        
        return view('pony.pof.cours_ajout_modal', compact('moniteurs', 'date_cours', 'cours', 'client_niveaux'));
    }


    /*
    * coursAjouter :
    *   - Crée un nouveau cours en BDD.
    *   - Vérifie que le moniteur et l'emplacement choisis sont disponibles, sinon renvoie une erreur.
    *   - avant de valider la première occurence du cours, on vérifie s'il existe bien une prestation compatible
    *   - Fonction à factoriser (WIP).
    */
    public function coursAjouter(Request $request) {
        
        // si cours répétif : créer le cours sur les 10 prochaines années
        $nb_repetition_cours = 1;
        if($request->cours_repetitif && !$request->id_cours) {
            $nb_repetition_cours = 52 * 10;
        }

        if(!$request->cours_client_niveaux) {
            $erreur = 'Sélectionnez au moins un niveau pour les cavaliers !';
            return $this->getErrorModal($erreur);
        }
        
        $duree = $this->coursDuree($request->heure_debut, $request->heure_fin);
        
        return $this->coursMAJ($request->id_cours, $request->id_cours_type, $request->id_moniteur, $request->date_cours, $request->heure_debut, 
                $request->heure_fin, $duree, $request->nb_cavalier_max, $request->id_cours_emplacement, $nb_repetition_cours, 
                $request->cours_client_niveaux, $request->libelle);
       
    }     


    /*
    * afficherCoursDetails :
    *   - Prépare les paramètres nécessaires pour charger la vue cours_details.
    *   - Renvoie dans un objet Json la vue cours_details et les informations du cours.
    */
    public function afficherCoursDetails(Request $request) {
        $cours = PofCours::find($request->id_cours);
        $clients = PofClient::all();

        $cavaliers = PofCoursClient::where('id_cours', $cours->id_cours)
            ->get();

        // Préparation des informations du cours pour l'affichage au bon format dans la vue
        $infos_cours = $this->prepareCoursDetails($cours);

        return response()->json([
            'view' => view('pony.pof.cours_details', compact('cours', 'cavaliers','clients'))
                ->render(),
            'infos_cours' => $infos_cours
        ]);
    }


    /*
    * prepareCoursDetails :
    *   - Prépare les informations du cours transmis par afficherCoursDetails au fichier JS.
    *   - Renvoie un objet $infos_cours à la fonction afficherCoursDetails().
    */
    public function prepareCoursDetails(PofCours $cours) {
        $params = explode('-', $cours->date_cours);
        $date_cours = Carbon::createFromDate($params[0], $params[1], $params[2])->format('d/m/Y');

        $params_debut = explode(':', $cours->heure_debut);
        $heure_debut = Carbon::createFromTime($params_debut[0], $params_debut[1])->format('H:i');

        $params_fin = explode(':', $cours->heure_fin);
        $heure_fin = Carbon::createFromTime($params_fin[0], $params_fin[1])->format('H:i');

        $infos_cours = [
            'date_cours' => $date_cours,
            'heure_debut' => $heure_debut,
            'heure_fin' => $heure_fin
        ];
        return $infos_cours;
    }



    /*
    * ajoutCavalier :
    *   - Inscrit le cavalier choisi au cours sélectionné en BDD.
    *   - Retourne la vue cours_details avec les informations du cours.
    *   - si le cavalier est inscrit dans un cours se déroulant à la même heure => erreur
    */
    public function ajoutCavalier(Request $request) {

        $cours = PofCours::find($request->id_cours);
        
        $client = PofClient::find($request->id_client);
        
        if($this->coursInscrire($cours,$client)) {
            if(!$this->coursVerifierClientNiveau($cours,$client)) {
                $clients = PofClient::all();

                $cavaliers = PofCoursClient::where('id_cours', $cours->id_cours)
                    ->get();

                $infos_cours = $this->prepareCoursDetails($cours);
                
                $message = 'Le client inscrit n\'a pas le niveau pour ce cours !';
                return response()->json([
                    'view' => view('pony.pof.cours_details', compact('cours', 'cavaliers','clients'))
                        ->render(),
                    'infos_cours' => $infos_cours,
                    'alerte_niveau' => view('pony.message_modal', compact('message'))
                        ->render()
                ]);
            }
            else {
                return $this->afficherCoursDetails($request); 
            }
        } else {
            $alerte = 'le cavalier choisi est déjà inscrit à ce cours !';
            return $this->getErrorModal($alerte);
        }
    }


    /*
    * retirerCavalier :
    *   - Annule l'inscription du cavalier au cours sélectionné en BDD.
    *   - Retourne la vue cours_details avec les informations du cours.
    */
    public function retirerCavalier(Request $request) {
        $cavalier = PofCoursClient::where('id_cours', $request->id_cours)
            ->where('id_client', $request->id_client)
            ->first();
        $cavalier->delete();

        $view = $this->afficherCoursDetails($request);
        return $view;
    }


    /*
    * choixMontureModal :
    *   - Liste les chevaux disponibles au moment du cours sélectionné.
    *   - Renvoie la modale d'attribution de monture pour un cavalier, avec la liste des chevaux disponibles.
    */
    public function choixMontureModal(Request $request) {

        $cours = PofCours::find($request->id_cours);
        $coursclient = PofCoursClient::where('id_client', $request->id_client)
            ->where('id_cours', $cours->id_cours)
            ->first();
        
        $id_chevaux_non_dispo = [];
        $cours_a_verifier = PofCours::where('date_cours', $cours->date_cours)
            ->get();

        foreach($cours_a_verifier as $cav) {
            $chevauchement = $this->testChevauchementCours($cours->heure_debut, $cours->heure_fin, $cav->heure_debut, $cav->heure_fin);

            if($chevauchement == true) {
                // S'il y a chevauchement, on récupère l'id de toutes les montures présentes
                $montures_attribuees = PofCoursClient::where('id_cours', $cav->id_cours)
                ->whereNotNull('id_cheval')
                ->get();

                // Et on les insère dans le tableau des chevaux non disponibles
                foreach($montures_attribuees as $monture_attribuee) {
                    array_push($id_chevaux_non_dispo, $monture_attribuee->id_cheval);
                }
            }
        }
        
        $chevaux = PofCheval::whereIn('id_cheval_statut', [1,3])
            ->whereNotIn('id_cheval', $id_chevaux_non_dispo)
            ->where('actif',1)
            ->orderby('nom')
            ->get()
            ;
        
        $chevaux_proprietaires = PofCheval::whereIn('id_cheval_statut', [2])
            ->whereNotIn('id_cheval', $id_chevaux_non_dispo)
            ->where('actif',1)
            ->orderby('nom')
            ->get()
            ;
        
        $cheval_types = PofChevalType::all();
        
        return response()->json([
            'modalAfficher' => view('pony.pof.choix_monture_modal', compact('chevaux_proprietaires', 'chevaux', 'coursclient','cheval_types'))->render()
        ]);
    }


    /*
    * choixMonture :
    *   - Attribue la monture choisie au cavalier sélectionné.
    *   - Retourne la vue cours_details avec les informations du cours.
    */
    public function choixMonture(Request $request) {
        
        $coursclient = PofCoursClient::where('id_client', $request->id_client)
                ->where('id_cours', $request->id_cours)
                ->first();
        $cours = PofCours::find($request->id_cours);

        // Vérification de la disponibilité de la monture choisie
        // Normalement, il ne devrait pas y avoir de problème car choixMontureModal() ne propose que les montures disponibles
        $cours_a_verifier = PofCours::where('date_cours', $cours->date_cours)
            ->where('id_cours', '!=', $cours->id_cours)
            ->get();
        foreach($cours_a_verifier as $cav) {
            $chevauchement = $this->testChevauchementCours($cours->heure_debut, $cours->heure_fin, $cav->heure_debut, $cav->heure_fin);

            // Si le cours vérifié chevauche le cours où la monture doit être attribuée
            if($chevauchement == true) {

                // On récupère les PofCoursClient du cours qui chevauche
                $autres_coursclient = PofCoursClient::where('id_cours', $cav->id_cours)
                    ->whereNotNull('id_cheval')
                    ->get();

                // Et on vérifie que la monture choisie n'est pas déjà attribuée.
                foreach($autres_coursclient as $acc) {
                    if($acc->id_cheval == $request->id_cheval) {
                        $alerte = "la monture choisie est déjà attribuée dans un autre cours. Sélectionnez une autre monture. Cours n° " . $cav->id_cours . ', cheval n° ' . $request->id_cheval;
                        $error = $this->getErrorModal($alerte);
                        return $error;
                    }
                }
            }
        }

        // La monture choisie est bel et bien disponible ; on peut l'attribuer au cavalier.
        $coursclient->id_cheval = $request->id_cheval;
        $coursclient->save();
        
        return true;
    }


    /*
    * validerCours :
    *   - Sélectionne la prestation adaptée en fonction du statut du client et du type de cours auquel il est inscrit.
    *   - Valide le client pour le cours sélectionné.
    *   - Décrémente la carte du client s'il en a une.
    *   - Crée une nouvelle carte et la décrémente si le client n'en avait pas. Renvoie une modale d'erreur dans ce cas.
    */
    public function validerCours(Request $request) {
        $cours = PofCours::find($request->id_cours);
        $client = PofClient::find($request->id_client);
        $prestation = $this->getPrestationCours($cours,$client);

        if(!$prestation) {
            $alerte = "Aucune prestation trouvée pour un(e) ". $cours->pofcourstype->libelle . " d'une durée de " . $cours->duree . " pour un(e) client(e) de type " . $client->pofclientstatut->libelle;
            return $this->getErrorModal($alerte); 
        }

        // Récupération de la carte du client pour la prestation trouvée
        $carte_client = PofCarte::where('id_client', $client->id_client)
            ->where('id_prestation', $prestation->id_prestation)
            ->first();

        // Si le client a bien une carte correspondant à la prestation, on décrémente le solde de sa carte et on valide sa présence au cours.
        if($carte_client) {
            $carte_client = $this->decrementerCarteClient($carte_client);
            $cours_client = $this->validerCoursClient($cours->id_cours, $client->id_client);
            return;
        }
        if(!$carte_client) {
            // Si le client n'a pas de carte, création d'une nouvelle carte et décrémentation du solde en négatif.
            $carte_client = $this->decrementerCarteClient(null, $prestation->id_prestation, $client->id_client);
            $cours_client = $this->validerCoursClient($cours->id_cours, $client->id_client);
            return;

            /* Puis renvoi d'une modale d'avertissement.
            $alerte = "le client n'a pas de carte pour ce type de prestation. Création d'une nouvelle carte effectuée. Le solde du client est à présent négatif.";
            $error = $this->getErrorModal($alerte);
            return $error;
            */
        }
    }


    /*
    * validerCoursClient :
    *   - Récupère le pofcoursclient associé à l'id_cours et à l'id_client fournis
    *   - Change l'id_cours_client_statut à 2 pour valider le client.
    */
    public function validerCoursClient($id_cours, $id_client) {
        // Validation du client
        $cours_client = PofCoursClient::where('id_cours', $id_cours)
        ->where('id_client', $id_client)
        ->first();
        $cours_client->id_cours_client_statut = 2;
        $cours_client->save();

        return $cours_client;
    }
    
    
    /*
    * invaliderCours :
    *   - Invalide le client pour le cours sélectionné.
    *   - Incrémente la carte du client.
    */
    public function invaliderCours(Request $request) {
        $cours = PofCours::find($request->id_cours);
        $client = PofClient::find($request->id_client);
        $prestation = $this->getPrestationCours($cours,$client);

        // Récupération de la carte du client pour la prestation trouvée
        $carte_client = PofCarte::where('id_client', $client->id_client)
            ->where('id_prestation', $prestation->id_prestation)
            ->first();
        
        $this->incrementerCarteClient($carte_client);
        $this->invaliderCoursClient($cours->id_cours, $client->id_client);
        
        return;
    }
    
    
    /*
    * invaliderCoursClient :
    *   - Récupère le pofcoursclient associé à l'id_cours et à l'id_client fournis
    *   - Change l'id_cours_client_statut à 1 pour invalider le client.
    */
    public function invaliderCoursClient($id_cours, $id_client) {
        // Validation du client
        $cours_client = PofCoursClient::where('id_cours', $id_cours)
        ->where('id_client', $id_client)
        ->first();
        $cours_client->id_cours_client_statut = 1;
        $cours_client->save();

        return $cours_client;
    }


    /*
    * decrementerCarteClient :
    *   - Crée une carte si le client n'en possède pas.
    *   - Décrémente la carte du client.
    */
    public function decrementerCarteClient(PofCarte $carte = null, $id_prestation = null, $id_client = null) {
        if(!$carte) {
            $carte = new PofCarte;
            $carte->id_client = $id_client;
            $carte->id_prestation = $id_prestation;
            $carte->solde = -1;
            $carte->save();
        }
        else {
            $carte->solde = $carte->solde - 1;
            $carte->save();
        }
        return $carte;
    }


    /*
    * incrementerCarteClient :
    *   - Incrémente la carte du client.
    */
    public function incrementerCarteClient(PofCarte $carte) {
        
        $carte->solde++;
        $carte->save();
        return $carte;
    }


    /*
    * getPrestationCours :
    *   - Trouve la prestation adaptée à partir d'un cours et d'un client.
    *   - Renvoie la prestation obtenue.
    * le client doit avec le statut et l'age compatible avec la prestation
    */
    public function getPrestationCours(PofCours $cours,PofClient $client) {

        $age = Carbon::Today()->DiffInYears($client->date_naissance);
        $duree = $cours->duree;
        
        $prestation = PofPrestation::where('id_client_statut', $client->id_client_statut)
            ->where('id_cours_type', $cours->id_cours_type)
            ->where('id_prestation_type',1)
            ->where('age_min_client','<=',$age)
            ->where('age_max_client','>=',$age)
            ->where(function($query) use ($duree){
                $query->where('duree', $duree)
                    ->orWhere('duree', '00:00:00')
                    ;
            })
            ->first();
        
        return $prestation;
    }
    


    public function coursSuppressionModal(Request $request) {
        $cours = PofCours::find($request->id_cours);
        return view('pony.pof.cours_suppression_modal', compact('cours'));
    }


    /*
    * coursSuppression :
    *   - Supprime le cours sélectionné de la BDD, ainsi que tous les détails associés.
    *   - Si flag_occurence = 1 : supprimer juste le cours 
    *   - Si flag_occurence = 2 : supprimer le cours et les occurences du cours sans inscription , 
    *      dont la date est supérieure au cours courant
    *   - Renvoie la date du cours supprimé au fichier JS pour mettre à jour l'affichage du planning.
    */
    public function coursSuppression(Request $request) {
        
        // préparation date pour return
        $courscourant = PofCours::find($request->id_cours);
        $params = explode('-', $courscourant->date_cours);
        $date_cours = Carbon::createFromDate($params[0], $params[1], $params[2])->format('d-m-Y');
        
        // vérification si le cours courant n'a plus de cavalier, sinon retour d'erreur
        $coursclients = PofCoursClient::where('id_cours', $request->id_cours)->get();
        if(count($coursclients)>0) {
            
            $erreur = 'Impossible de supprimer le cours : des cavaliers sont encore inscrits';
            
            return response()->json([
                'error' => 1,
                'view' => view('pony.erreur_modal', compact('erreur'))->render()
            ]);
        }
        
        // si un seul cours à supprimer :
        $cours = PofCours::where('id_cours',$courscourant->id_cours)->get();
        
        // si plusieurs occurence d'un cours à supprimer :
        // ne pas prendre les cours qui ont des cavaliers inscrits
        if($request->flag_occurence == 2) {
            $cours = PofCours::where([['id_cours_type',$courscourant->id_cours_type],
                ['id_moniteur',$courscourant->id_moniteur],
                ['id_cours_emplacement',$courscourant->id_cours_emplacement],
                ['date_cours','>=',$courscourant->date_cours],
                ['heure_debut',$courscourant->heure_debut],
                ['heure_fin',$courscourant->heure_fin]
                ])
                ->whereNotIn('id_cours', function($q){
                    $q->select('id_cours')
                    ->from('pof_cours_client')
                    ;
                })
                ->get();
        }
        
        foreach($cours as $cours_a_supprimer) {
            $cours_a_supprimer->delete();
        }
        
        return response()->json([
            'error' => 0,
            'date_cours' => $date_cours
        ]);
    }
    
    
    public function rechercherClient(Request $request) {
        
        $id_client = explode('#',$request->recherche_client)[0];
        
        if(!is_numeric($id_client)) {
            return $this->getErrorModal('sélectionner un client dans la liste');
        }
        
        return response()->json([
            'id_client' => $id_client
        ]);
        
    }

    public function clientCours(Request $request) {
        
        $client = PofClient::find($request->id_client);
        $listecours = PofCours::where('pof_cours_client.id_client', $client->id_client)
                ->join('pof_cours_client', 'pof_cours.id_cours', 'pof_cours_client.id_cours')
                ->orderBy('date_cours', 'desc')
                ->orderBy('heure_debut')
                ->get();
        
        return response()->json([
            'view' => view('pony.pof.cours', compact('client', 'listecours'))
                ->render()
        ]);
    }
    
    
    public function coursReinscrireModal(Request $request) {
        
        $coursclient = PofCoursClient::find($request->id_cours_client);
        
        return response()->json([
            'view' => view('pony.pof.cours_reinscription_modal', compact('coursclient'))
                ->render()
        ]);
    }
    
    
    public function coursReinscrire(Request $request) {
        
        $coursclient = PofCoursClient::find($request->id_cours_client);
        $cours = $coursclient->pofcours;
        
        $date_cours = $cours->date_cours .' '.$cours->heure_debut;
        
        $date_prochain_cours = Carbon::createFromFormat('Y-m-d H:i:s', $date_cours);
        $date_prochain_cours->addDay($request->nb_jour);
        
        $this->PofLog($date_prochain_cours);
        
        // Si le cours n'existe pas, on le créé
        if(!$cours_nv = PofCours::where([
            ['id_moniteur',$cours->id_moniteur],
            ['date_cours',$date_prochain_cours->toDateString()],
            ['heure_debut',$date_prochain_cours->toTimeString()],
            ['heure_fin', $cours->heure_fin],
            ['id_cours_type',$cours->id_cours_type],
            ['id_cours_emplacement', $cours->id_cours_emplacement]
            ])->first()) {

            if(!$test_chevauchement = $this->coursVerifierMoniteur($date_prochain_cours, $cours->id_moniteur, 
            $cours->id_cours, $cours->heure_debut, $cours->heure_fin)) {
                
                $erreur = 'Impossible d\'effectuer la réinscription : '.$cours->pofmoniteur->prenom.' a déjà un cours différent prévu le '.$date_prochain_cours->format('d-m-Y').' au même horaire.'; 
                return $this->getErrorModal($erreur);
            }

            if(!$test_chevauchement = $this->coursVerifierEmplacement($date_prochain_cours, $cours->id_cours_emplacement, $cours->id_cours,
            $cours->heure_debut, $cours->heure_fin)) {

                $erreur = 'Impossible d\'effectuer la réinscription : un cours est déjà prévu ';

                if(in_array($cours->id_cours_emplacement, [1, 2])) {
                    $erreur .= 'dans le '.$cours->pofcoursemplacement->libelle;
                }
                else if($cours->id_cours_emplacement === 3) {
                    $erreur .= 'dans la '.$cours->pofcoursemplacement->libelle;
                }
                else {
                    $erreur .= 'en '.$cours->pofcoursemplacement->libelle;
                }
                $erreur .= ' le '.$date_prochain_cours->format('d-m-Y').' au même horaire.';
                return $this->getErrorModal($erreur);
            }
            
            $cours_nv = new PofCours;

            $cours_nv->id_cours_type = $cours->id_cours_type;
            $cours_nv->id_moniteur = $cours->id_moniteur;
            $cours_nv->date_cours = $date_prochain_cours->toDateString();
            $cours_nv->heure_debut = $cours->heure_debut;
            $cours_nv->heure_fin = $cours->heure_fin;
            $cours_nv->duree = $cours->duree;
            $cours_nv->nb_cavalier_max = $cours->nb_cavalier_max;
            $cours_nv->id_cours_emplacement = $cours->id_cours_emplacement;
            $cours_nv->libelle = $cours->libelle;
            
            $cours_nv->save();

            $cours_client_niveaux = $cours->pofcoursclientniveaux;
            foreach($cours_client_niveaux as $cours_client_niveau) {
                $ccnv = new PofCoursClientNiveau;
                $ccnv->id_cours = $cours_nv->id_cours;
                $ccnv->id_client_niveau = $cours_client_niveau->id_client_niveau;
                $ccnv->save();
            }
        }
        
        if($cours_client = $this->coursInscrire($cours_nv,$coursclient->pofclient)) {
            
            $message = 'Inscription de '.$coursclient->pofclient->nom.' '.$coursclient->pofclient->prenom.' au cours suivant : ';
            $message .= '<br> - le '.$coursclient->pofcours->date_cours.' à '.$coursclient->pofcours->heure_debut;
            $message .= '<br> - durée : '.$coursclient->pofcours->duree;
            $message .= '<br> - type : '.$coursclient->pofcours->pofcourstype->libelle;
        
            return $this->getMessageModal($message);
        } else {
            $alerte = 'le cavalier choisi est déjà inscrit à ce cours !';
            return $this->getErrorModal($alerte);
        }
    }
}