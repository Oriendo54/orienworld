@extends('pony.template_pony')

@section('content')

<div id="links"
paramPrestationAjoutModal="{{ route('paramPrestationAjoutModal') }}"
paramPrestationAjout="{{ route('paramPrestationAjout') }}"
paramPrestationSupprModal="{{ route('paramPrestationSupprModal') }}"
paramPrestationSupprimer="{{ route('paramPrestationSupprimer') }}"
paramPrestationTarif="{{ route('paramPrestationTarif') }}"
paramTarifAjoutModal="{{ route('paramTarifAjoutModal') }}"
paramTarifAjout="{{ route('paramTarifAjout') }}"
paramTarifSupprModal="{{ route('paramTarifSupprModal') }}"
paramTarifSupprimer="{{ route('paramTarifSupprimer') }}"
paramPrestationAssociation="{{ route('paramPrestationAssociation') }}"
paramPrestationAssociationAjoutModal="{{ route('paramPrestationAssociationAjoutModal') }}"
paramPrestationAssociationAjout="{{ route('paramPrestationAssociationAjout') }}"
paramPrestationAssociationSupprModal="{{ route('paramPrestationAssociationSupprModal') }}"
paramPrestationGroupe="{{ route('paramPrestationGroupe') }}"
paramPrestationGroupeAjoutModal="{{ route('paramPrestationGroupeAjoutModal') }}"
paramPrestationGroupeAjout="{{ route('paramPrestationGroupeAjout') }}"
paramPrestationGroupeSupprPrestation="{{ route('paramPrestationGroupeSupprPrestation') }}"
paramPrestationSupprGroupeModal="{{ route('paramPrestationSupprGroupeModal') }}"
paramPrestationSupprGroupe="{{ route('paramPrestationSupprGroupe') }}"
paramPrestationGroupeTarif="{{ route('paramPrestationGroupeTarif') }}"
paramPrestationGroupeTarifDefautModal="{{ route('paramPrestationGroupeTarifDefautModal') }}"
paramPrestationGroupeTarifDefaut="{{ route('paramPrestationGroupeTarifDefaut') }}"
paramCreerChargeModal="{{ route('paramCreerChargeModal') }}"
paramCreerCharge="{{ route('paramCreerCharge') }}"
paramSupprChargeModal="{{ route('paramSupprChargeModal') }}"
paramSupprimerCharge="{{ route('paramSupprimerCharge') }}"
></div>

<button class="btn btn-primary mb-3" onclick="paramPrestationAjoutModal()" id="">Nouvelle prestation</button>

<div id="prestation">
    @include('pony.param.param_prestation', ['prestations' => $prestations])
</div>

<button class="btn btn-primary mb-3" onclick="paramPrestationGroupeAjoutModal()" id="">Nouveau groupe de prestations</button>

<div id="prestation_groupe">
    @include('pony.param.param_prestation_groupe', ['prestations' => $prestations])
</div>

<button class="btn btn-primary mb-3 mt-3" onclick="paramCreerChargeModal()">Nouvelle charge pour les chevaux</button>

<div id="charges">
    @include('pony.param.param_charge_chevaux', ['charges' => $charges])
</div>

@endsection

@section('scriptjs')
    <script type="text/javascript" src="{{ URL::asset('js/pof/params.js') }}"></script>
@endsection