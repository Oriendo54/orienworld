<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofClient extends Model {
    protected $table = 'pof_client';
    public $primaryKey = 'id_client';

    public function pofcoursclients() {
        return $this->hasMany('App\Models\Pof\PofCoursClient', 'id_client', 'id_client')->orderBy('id_cours_client','desc');
    }

    public function pofclientniveau() {
        return $this->hasOne('App\Models\Pof\PofClientNiveau', 'id_client_niveau', 'id_client_niveau');
    }

    public function pofcartes() {
        return $this->hasMany('App\Models\Pof\PofCarte', 'id_client', 'id_client');
    }
    
    public function pofclientadresses() {
        return $this->hasMany('App\Models\Pof\PofClientAdresse', 'id_client', 'id_client');
    }
    
    public function pofclientadressedefaut() {
        return $this->hasOne('App\Models\Pof\PofClientAdresse', 'id_client', 'id_client')->limit(1)->orderBy('id_client_adresse','desc');
    }

    public function pofclienttelephones() {
        return $this->hasMany('App\Models\Pof\PofClientTelephone', 'id_client', 'id_client');
    }

    public function poffactures() {
        return $this->hasMany('App\Models\Pof\PofFacture', 'id_client', 'id_client')->orderBy('date_facture','desc');
    }

    public function poffactures5dernieres() {
        return $this->hasMany('App\Models\Pof\PofFacture', 'id_client', 'id_client')->limit(5)->orderBy('date_facture','desc');
    }

    public function pofclientstatut() {
        return $this->hasOne('App\Models\Pof\PofClientStatut', 'id_client_statut', 'id_client_statut');
    }

    public function pofclientchevaux() {
        return $this->hasMany('App\Models\Pof\PofClientCheval', 'id_client', 'id_client');
    }

    public function pofabonnementclient() {
        return $this->hasMany('App\Models\Pof\PofAbonnementClient', 'id_client', 'id_client');
    }

    public function pofbonachats() {
        return $this->hasMany('App\Models\Pof\PofBonachat', 'id_client', 'id_client');
    }

    public function pofuserrole() {
        return $this->hasOne('App\Models\Pof\PofUserRole', 'id_user', 'id_user');
    }

    public function pofuser() {
        return $this->hasOne('App\Models\User', 'id', 'id_user');
    }
}