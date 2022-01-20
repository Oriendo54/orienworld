<?php

namespace App\Models\Pof;

use Illuminate\Database\Eloquent\Model;

class PofPrestation extends Model {
    protected $table = 'pof_prestation';
    public $primaryKey = 'id_prestation';
    public $timestamps = false;

    public function poffacturedetails() {
        return $this->hasMany('App\Models\Pof\PofFactureDetail', 'id_prestation', 'id_prestation');
    }

    public function pofprestationtype() {
        return $this->hasOne('App\Models\Pof\PofPrestationType', 'id_prestation_type', 'id_prestation_type');
    }

    public function pofcourstype() {
        return $this->hasOne('App\Models\Pof\PofCoursType', 'id_cours_type', 'id_cours_type');
    }

    public function pofclientstatut() {
        return $this->hasOne('App\Models\Pof\PofClientStatut', 'id_client_statut', 'id_client_statut');
    }

    public function pofcartes() {
        return $this->hasMany('App\Models\Pof\PofCarte', 'id_prestation', 'id_prestation');
    }

    public function poftarifs() {
        return $this->hasMany('App\Models\Pof\PofTarif', 'id_prestation', 'id_prestation');
    }

    public function poftarifprincipal() {
        return $this->hasOne('App\Models\Pof\PofTarif', 'id_prestation', 'id_prestation')->where('quantite',1);
    }

    public function poftva() {
        return $this->hasOne('App\Models\Pof\PofTva', 'id_tva', 'id_tva');
    }

    public function pofprestationassociationlien() {
        return $this->hasOne('App\Models\Pof\PofPrestationassociationLien', 'id_prestation', 'id_prestation')->where('prestation_principale',1);
    }

    public function pofprestationassociationliensecondaire() {
        return $this->hasOne('App\Models\Pof\PofPrestationassociationLien', 'id_prestation', 'id_prestation')->where('prestation_principale',null);
    }

    public function pofprestationgroupelien() {
        return $this->hasOne('App\Models\Pof\PofPrestationgroupeLien', 'id_prestation', 'id_prestation');
    }
}