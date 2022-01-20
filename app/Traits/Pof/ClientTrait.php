<?php
 
namespace App\Traits\Pof;

use Carbon\Carbon;

use App\Models\User;
use App\Models\Pof\PofCours;
use App\Models\Pof\PofClient;
use App\Models\Pof\PofUserRole;
use Illuminate\Support\Facades\DB;
use App\Models\Pof\PofClientStatut;
use Illuminate\Support\Facades\Hash;

trait ClientTrait {
 
    public function clientStatutMAJ(PofClient $client) {
        
        /*
         * Si le client est propriétaire d'au moins un cheval, alors son statut est de type propriétaire
         */
        foreach($client->pofclientchevaux as $clientcheval) {
            
            if($client->pofclientstatut->code == 'PSG') {
                $client_statut = PofClientStatut::where('code','PSGP')->first();
                $client->id_client_statut = $client_statut->id_client_statut;
            }
            
            if($client->pofclientstatut->code == 'ADH') {
                $client_statut = PofClientStatut::where('code','ADHP')->first();
                $client->id_client_statut = $client_statut->id_client_statut;
            }
            
        }
        
        /*
         * Si le client n'est plus propriétaire, alors son statut n'est pas de type propriétaire
         */
        if(!count($client->pofclientchevaux)) {
            
            if($client->pofclientstatut->code == 'PSGP') {
                $client_statut = PofClientStatut::where('code','PSG')->first();
                $client->id_client_statut = $client_statut->id_client_statut;
            }
            
            if($client->pofclientstatut->code == 'ADHP') {
                $client_statut = PofClientStatut::where('code','ADH')->first();
                $client->id_client_statut = $client_statut->id_client_statut;
            }
            
        }
        
        $client->save();
        
        return $client;
    }
    
    public function clientAge(PofClient $client) {
        
        return Carbon::Today()->DiffInYears($client->date_naissance);
    }

    public function clientInscrireUtilisateur(PofClient $client) {
        $client_name = $client->nom.' '.$client->prenom;

        // Création de l'utilisateur en BDD
        $user = new User;
        $user->name = $client_name;
        $user->email = $client->email;
        $user->password = Hash::make($this->genererChaineAleatoire());
        $user->save();

        // Attribution de son rôle
        $user_role = new PofUserRole;
        $user_role->id_user = $user->id;
        $user_role->id_role = 3;
        $user_role->save();

        // Mise à jour de la table pof_client
        $client->id_user = $user->id;
        $client->save();
        
        return $user;
    }
}