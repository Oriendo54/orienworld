<?php

namespace app\Http\Controllers\Pof;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Pof\PofRole;
use App\Models\Pof\PofCarte;
use App\Models\Pof\PofCheval;
use App\Models\Pof\PofClient;
use App\Models\Pof\PofFacture;
use App\Models\Pof\PofBonachat;
use App\Models\Pof\PofUserRole;
use App\Models\Pof\PofPrestation;
use App\Models\Pof\PofClientCheval;
use App\Models\Pof\PofClientNiveau;
use App\Models\Pof\PofClientStatut;
use App\Models\Pof\PofClientAdresse;
use App\Models\Pof\PofFactureDetail;
use App\Models\Pof\PofClientTelephone;
use App\Models\Pof\PofClientChevalStatut;

use App\Traits\Pof\ChevalTrait;
use App\Traits\Pof\ClientTrait;
use App\Traits\Pof\BonachatTrait;
use App\Mail\UserInscriptionMail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class ClientController extends Controller {
    
    use ClientTrait;
    use ChevalTrait;
    use BonachatTrait;

    public function client($id_client = null) {
        
        if(!$id_client) {
            $clients = PofClient::orderBy('id_client', 'desc')
                ->paginate(50);
        } else {
            
            $clients = PofClient::where('id_client',$id_client)->get();
        }

        return view('pony.client.client', compact('clients'));
    }
    
    
    public function clientMAJ(Request $request) {
        $client = PofClient::find($request->id_client);

        return response()->json([
            'view' => view('pony.client.client_client', compact('client'))
                ->render()
        ]);
    }
    
    
    // CREATION ET UPDATE D'UN CLIENT
    
    public function clientAjoutModal(Request $request) {
        
        if($request->id_client) {
            $client = PofClient::find($request->id_client);
        } else {
            $client = null;
        }
        
        $clientstatuts = PofClientStatut::all();
        $niveaux = PofClientNiveau::all();
        $roles = PofRole::all();
        
        return response()->json([
            'view' => view('pony.client.client_ajout_modal', compact('clientstatuts', 'niveaux', 'client', 'roles'))
                ->render()
        ]);
    }

    public function clientChangerRoleModal(Request $request) {
        $role = PofRole::find($request->id_role);
        $client = PofClient::find($request->id_client);

        if($client->pofuserrole->id_user == auth()->user()->id) {
            $erreur = 'impossible de modifier votre propre rôle, vous êtes administrateur de l\'application !';
            return $this->getErrorModal($erreur);
        }

        $message = 'Vous êtes sur le point de changer le rôle de l\'utilisateur.';
        if($request->ancien_role == 1) {
            $message = 'Vous êtes sur le point de révoquer un administrateur !';
        }

        $action = 'attribuer le rôle '.$role->libelle.' à cet utilisateur';
        $fonction = 'clientAjout('.$client->id_client.')';

        return response()->json([
            'view' => view('pony.warning_modal', compact('action', 'fonction'))
                ->render()
        ]);
    }


    public function clientChangerRole(PofClient $client, int $id_role) {
        $userrole = $client->pofuserrole;
        $userrole->id_role = $id_role;
        $userrole->save();

        return $userrole->pofrole;
    }

    
    public function clientAjout(Request $request) {
        
        if($client_modif = PofClient::find($request->id_client)) {
            
            $validator = Validator::make($request->all(), [
                'client_nom'=> 'required|min:3',
                'client_prenom'=> 'required|min:3',
                'client_date_naissance'=> 'required|min:3',
                'client_email'=> 'required|email'
            ]);
            
        } else {
            
            $validator = Validator::make($request->all(), [
                'client_nom'=> 'required|min:3',
                'client_prenom'=> 'required|min:3',
                'client_date_naissance'=> 'required|min:3',
                'client_email'=> 'required|email',
                'client_telephone'=> 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:10',
                'client_rue'=> 'required|min:3',
                'client_code_postal'=> 'required|min:4|max:5',
                'client_ville'=> 'required|min:3'
            ]);
            
        }
        
        if ($validator->fails()) {
            return response()->json(['return'=>0,'error'=>$validator->errors()]);
        }
        
        $client = $this->updateClient($client_modif, $request);
        
        if(!$client_modif) {
            $telephone = $this->updateClientTelephone($client, $request);
            $adresse = $this->updateClientAdresse($client, $request);
        }
        else {
            // Si un id_role est spécifié en requête et si le client est déjà inscrit à l'application,
            // on met à jour son rôle
            if($request->id_role && $client->pofuserrole) {
                $role = $this->clientChangerRole($client, $request->id_role);
            }
        }

        return response()->json([
            'id_client' => $client->id_client
        ]);
    }
    
    /*
    * updateClient : 
    *   - Crée un nouveau client si nécessaire.
    *   - Met à jour les données du client en BDD.
    *   - Renvoie l'objet Client.
    */
    public function updateClient(PofClient $client = null, Request $request) {
        if($client == null) {
            $client = new PofClient;
        
            // à la création du compte le statut du client est celui par défaut
            $client_statut_par_defaut = PofClientStatut::where('par_defaut',1)->first();
            $client->id_client_statut = $client_statut_par_defaut->id_client_statut;
        }

        if($request->client_nom) {
            $client->nom = $request->client_nom;
        }
        if($request->client_prenom) {
            $client->prenom = $request->client_prenom;
        }
        // A modifier par la suite, valeur fixée temporairement à null pour permettre l'insertion
        $client->id_client_parent = null;

        if($request->client_date_naissance) {
            $client->date_naissance = $request->client_date_naissance;
        }
        if($request->client_email) {
            $client->email = $request->client_email;
        }
            
        if($request->client_id_niveau_client) {
            $client->id_client_niveau = $request->client_id_niveau_client;
        }
            
        if($request->client_id_client_statut) {
            $client->id_client_statut = $request->client_id_client_statut;
        }
        
        $client->save();
        
        $client = $this->clientStatutMAJ($client);  

        return $client;
    }


    /*
    * updateClientTelephone :
    *   - Met à jour le téléphone du client en BDD.
    *   - Renvoie l'objet Telephone.
    */
    public function updateClientTelephone(PofClient $client, Request $request) {
        $validator = Validator::make($request->all(), [
            'client_telephone'=> 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:10'
        ]);

        if($request->id_client_telephone) {
            $telephone = PofClientTelephone::find($request->id_client_telephone);
            $client = PofClient::find($telephone->id_client);
        }
        else {
            $telephone = PofClientTelephone::where('id_client', $client->id_client)
                ->first();
        }
        if(!$telephone) {
            $telephone = new PofClientTelephone;
            $telephone->id_client = $client->id_client;
        }

        $telephone->telephone = $request->client_telephone;
        $telephone->save();

        return $telephone;
    }


    public function clientTelephoneAjoutModal(Request $request) {
        $client = PofClient::find($request->id_client);

        return response()->json([
            'view' => view('pony.client.client_telephone_ajout_modal', compact('client'))
                ->render()
        ]);
    }


    public function clientTelephoneAjout(Request $request) {
        $client = PofClient::find($request->id_client);

        $validator = Validator::make($request->all(), [
            'client_telephone'=> 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:10'
        ]);

        $telephone = new PofClientTelephone;
        $telephone->id_client = $client->id_client;
        $telephone->telephone = $request->client_telephone;
        $telephone->save();

        return response()->json([
            'view' => view('pony.client.client_client', compact('client'))
                ->render()
        ]);
    }


    public function clientTelephoneSupprModal(Request $request) {
        $telephone = PofClientTelephone::find($request->id_client_telephone);
        $element = 'ce téléphone';
        $function = 'clientTelephoneSupprimer('.$telephone->id_client_telephone.')';

        return response()->json([
            'view' => view('pony.delete_warning_modal', compact('element', 'function'))
                ->render()
        ]);
    }


    public function clientTelephoneSupprimer(Request $request) {
        $telephone = PofClientTelephone::find($request->id_client_telephone);
        $telephone->delete();

        return;
    }


    /*
    * updateClientAdresse :
    *   - Met à jour l'adresse du client en BDD.
    *   - Renvoie l'objet Adresse.
    */
    public function updateClientAdresse(PofClient $client, Request $request) {
        $validator = Validator::make($request->all(), [
            'client_rue'=> 'required|min:3',
            'client_code_postal'=> 'required|min:4|max:5',
            'client_ville'=> 'required|min:3'
        ]);
        
        if($request->id_client_adresse) {
            $adresse = PofClientAdresse::find($request->id_client_adresse);
            $client = $adresse->pofclient;
        }
        else {
            $adresse = PofClientAdresse::where('id_client', $client->id_client)
                ->first();
        }
        
        if(!$adresse) {
            $adresse = new PofClientAdresse;
            $adresse->id_client = $client->id_client;
        }

        $adresse->rue = $request->client_rue;
        $adresse->code_postal = $request->client_code_postal;
        $adresse->ville = $request->client_ville;
        $adresse->save();

        return $adresse;
    }


    public function clientAdresseAjoutModal(Request $request) {
        $client = PofClient::find($request->id_client);

        if($request->id_client_adresse) {
            $adresse = PofClientAdresse::find($request->id_client_adresse);
            return response()->json([
                'view' => view('pony.client.client_adresse_ajout_modal', compact('client', 'adresse'))
                    ->render()
            ]);
        }
        else {
            return response()->json([
                'view' => view('pony.client.client_adresse_ajout_modal', compact('client'))
                    ->render()
            ]);
        }
    }


    public function clientAdresseAjout(Request $request) {
        $client = PofClient::find($request->id_client);

        $validator = Validator::make($request->all(), [
            'client_rue'=> 'required|min:3',
            'client_code_postal'=> 'required|min:4|max:5',
            'client_ville'=> 'required|min:3'
        ]);

        $adresse = new PofClientAdresse;
        $adresse->id_client = $client->id_client;
        $adresse->rue = $request->client_rue;
        $adresse->code_postal = $request->client_code_postal;
        $adresse->ville = $request->client_ville;
        $adresse->save();

        return response()->json([
            'view' => view('pony.client.client_client', compact('client'))
                ->render()
        ]);
    }

    public function clientAdresseSupprModal(Request $request) {
        $adresse = PofClientAdresse::find($request->id_client_adresse);
        $element = 'cette adresse';
        $function = 'clientAdresseSupprimer('.$adresse->id_client_adresse.')';

        return response()->json([
            'view' => view('pony.delete_warning_modal', compact('element', 'function'))
                ->render()
        ]);
    }

    public function clientAdresseSupprimer(Request $request) {
        $adresse = PofClientAdresse::find($request->id_client_adresse);
        $adresse->delete();

        return;
    }
    

    public function editClient(Request $request) {
        // Modification d'un client existant
        if($request->id_client) {
            $client = PofClient::find($request->id_client);
            $client = $this->updateClient($client, $request);
            $telephone = $this->updateClientTelephone($client, $request);
            $adresse = $this->updateClientAdresse($client, $request);

            return;
        }
    }
    
    
    public function clientCheval(Request $request) {
        
        $client = PofClient::find($request->id_client);
          
        return view('pony.client.client_chevaux', compact('client'));
    }
    
    /*
     * Ne pas proposer les chevaux déjà associés au client
     */
    public function clientChevalAjoutModal(Request $request) {
        
        $client = PofClient::find($request->id_client);
        $client_cheval_statuts = PofClientChevalStatut::all();
        $id_client = $client->id_client;
        
        $chevaux = PofCheval::whereNotIn('id_cheval', function($q) use($id_client){
                    $q->select('pof_client_cheval.id_cheval')
                    ->from('pof_client_cheval')
                    ->where('pof_client_cheval.id_client',$id_client);
                })
                ->where('actif',1)
                ->orderby('nom');
        
        if($request->id_client_cheval) {
            
            $client_cheval = PofClientCheval::find($request->id_client_cheval);
            $chevaux = $chevaux->orWhere('id_cheval',$client_cheval->id_cheval);
            
        } else {
            $client_cheval = null;
        }   
                
        $chevaux = $chevaux->get();
        
        return response()->json([
            'view' => view('pony.client.client_cheval_ajout_modal', compact('client','client_cheval_statuts','chevaux','client_cheval'))
                ->render()
        ]);
    }
    
    public function clientChevalAjout(Request $request) {
        
        $client = PofClient::find($request->id_client);
        $client_cheval_modif = PofClientCheval::find($request->id_client_cheval);
                
        $validator = Validator::make($request->all(), [
            'clientcheval_id_client_cheval_statut'=> 'required|numeric',
            'clientcheval_id_cheval'=> 'required|numeric'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['return'=>0,'error'=>$validator->errors()]);
        }
        
        $this->clientChevalMAJ($client, $client_cheval_modif, $request);

        return view('pony.client.client_chevaux', compact('client'));
    }
    
    
    public function clientChevalMAJ(PofClient $client, PofClientCheval $client_cheval = null, Request $request) {
        
        if(!$client_cheval) {
            
            $client_cheval = new PofClientCheval;
            $client_cheval->id_client = $client->id_client;
        }
        
        $client_cheval->id_client_cheval_statut = $request->clientcheval_id_client_cheval_statut;
        $client_cheval->id_cheval = $request->clientcheval_id_cheval;
        
        $client_cheval->save();
        
        $cheval = $client_cheval->pofcheval;
        
        $this->clientStatutMAJ($client);
        $this->chevalStatutMAJ($cheval);

        return $client_cheval;
    }
    
    
    public function clientChevalSupprModal(Request $request) {
        
        $client_cheval = PofClientCheval::find($request->id_client_cheval);
        
        return response()->json([
            'view' => view('pony.client.client_cheval_suppr_modal', compact('client_cheval'))
                ->render()
        ]);
    }
    
    
    public function clientChevalSuppr(Request $request) {
        
        $client_cheval = PofClientCheval::find($request->id_client_cheval);
        $client = $client_cheval->pofclient;
        $cheval = $client_cheval->pofcheval;
                
        $client_cheval->delete();
        
        $this->clientStatutMAJ($client);
        $this->chevalStatutMAJ($cheval);

        return true;
    }

    public function clientBonachats(Request $request) {
        $client = PofClient::find($request->id_client);
        $bonachats = $this->clientDesactiverBonachatsExpires($client);

        $bonachats = PofBonachat::where('id_client', $client->id_client)
            ->where('actif', 1)
            ->get();

        return response()->json([
            'view' => view('pony.client.client_bonachats', compact('client', 'bonachats'))
                ->render()
        ]);
    }

    public function clientBonachatsEpuises(Request $request) {
        $client = PofClient::find($request->id_client);
        $bonachats = PofBonachat::where('id_client', $client->id_client)
            ->where('actif', 0)
            ->get();

        $epuises = true;

        return response()->json([
            'view' => view('pony.client.client_bonachats', compact('client', 'bonachats', 'epuises'))
                ->render()
        ]);
    }

    public function clientBonachatFactures(Request $request) {
        $bonachat = PofBonachat::find($request->id_bonachat);

        return response()->json([
            'view' => view('pony.client.client_bonachat_factures_modal', compact('bonachat'))
                ->render()
        ]);
    }


    public function clientBonachatCreerModal(Request $request) {
        $client = PofClient::find($request->id_client);
        
        if($request->id_bonachat) {
            $bonachat = PofBonachat::find($request->id_bonachat);
            return response()->json([
                'view' => view('pony.client.client_bonachat_ajout_modal', compact('client', 'bonachat'))
                    ->render()
            ]);
        }
        
        return response()->json([
            'view' => view('pony.client.client_bonachat_ajout_modal', compact('client'))
                ->render()
        ]);
    }


    public function clientBonachatCreer(Request $request) {
        $client = PofClient::find($request->id_client);

        $bonachat = new PofBonachat;
        $bonachat->id_client = $client->id_client;
        $bonachat->minimum = $request->minimum;
        $bonachat->valeur = $request->valeur;
        $bonachat->restant = $request->valeur;

        $params_expiration = explode('-', $request->date_expiration);
        $bonachat->date_expiration = Carbon::createFromDate($params_expiration[0], $params_expiration[1], $params_expiration[2]);
        $bonachat->save();

        return $this->clientBonachats($request);
    }


    public function clientBonachatMaj(Request $request) {
        $client = PofClient::find($request->id_client);
        $bonachat = PofBonachat::find($request->id_bonachat);

        $params_expiration = explode('-', $request->date_expiration);
        $bonachat->date_expiration = Carbon::createFromDate($params_expiration[0], $params_expiration[1], $params_expiration[2]);
        $bonachat->save();

        return $this->clientBonachats($request);
    }


    public function clientDesactiverBonachatsExpires(PofClient $client) {

        $bonachats = $this->desactiverBonachatsExpires(null, $client);
        return $client;
    }


    public function clientBonachatSupprModal(Request $request) {
        $bonachat = PofBonachat::find($request->id_bonachat);
        $client = PofClient::find($request->id_client);

        $element = 'ce bon d\'achat';
        $function = 'clientBonachatSupprimer('.$client->id_client.','.$bonachat->id_bonachat.')';

        return response()->json([
            'view' => view('pony.delete_warning_modal', compact('element', 'function'))
                ->render()
        ]);
    }


    public function clientBonachatSupprimer(Request $request) {
        $bonachat = PofBonachat::find($request->id_bonachat);
        $bonachat->delete();

        return $this->clientBonachats($request);
    }


    public function clientEnvoyerMailInscriptionModal(Request $request) {
        $client = PofClient::find($request->id_client);

        $action = 'envoyer un email de connexion à ce client';
        $fonction = 'clientEnvoyerMailInscription('.$client->id_client.')';
        return response()->json([
            'view' => view('pony.warning_modal', compact('action', 'fonction'))
                ->render()
        ]);
    }


    public function clientEnvoyerMailInscription(Request $request) {
        $client = PofClient::find($request->id_client);
        if($client->id_client_parent) {
            $erreur = 'impossible d\'inscrire un enfant à l\'application.';
            return $this->getErrorModal($erreur);
        }

        // Si nécessaire, création du compte utilisateur
        if(!$user = User::where('email', $client->email)->first()) {
            $user = $this->clientInscrireUtilisateur($client);
        }

        // Envoi du mail
        Mail::to($client->email)->send(new UserInscriptionMail($user));

        $message = 'Le mail d\'inscription a été envoyé.';
        return response()->json([
            'view' => view('pony.message_modal', compact('message'))
                ->render()
        ]);
    }
}