@extends('pony.template_pony')
@section('content')

<div id="links"
    getPlanning="{{ route('getPlanning') }}"
    selectionDatePlanning="{{ route('selectionDatePlanning') }}"
    changeDatePlanning="{{ route('changeDatePlanning') }}"
    coursAjouterModal="{{ route('coursAjouterModal') }}"
    coursAjouter="{{ route('coursAjouter') }}"
    afficherCoursDetails="{{ route('afficherCoursDetails') }}"
    coursSuppressionModal="{{ route('coursSuppressionModal') }}"
    coursSuppression="{{ route('coursSuppression') }}"
    coursReinscrireModal="{{ route('coursReinscrireModal') }}"
    coursReinscrire="{{ route('coursReinscrire') }}"
    afficherClientDetails="{{ route('afficherClientDetails') }}"
    ajoutCavalierModal="{{ route('ajoutCavalierModal') }}"
    ajoutCavalier="{{ route('ajoutCavalier') }}"
    retirerCavalier="{{ route('retirerCavalier') }}"
    choixMontureModal="{{ route('choixMontureModal') }}"
    choixMonture="{{ route('choixMonture') }}"
    validerCours="{{ route('validerCours') }}"
    invaliderCours="{{ route('invaliderCours') }}"
    clearAffichage="{{ route('clearAffichage') }}"
    carteAjoutQuantiteModal="{{ route('carteAjoutQuantiteModal') }}"
    carteAjoutQuantite="{{ route('carteAjoutQuantite') }}"
    carteSupprimerModal="{{ route('carteSupprimerModal') }}"
    carteSupprimer="{{ route('carteSupprimer') }}"
    factureAfficher="{{ route('factureAfficher') }}"
    clientCours="{{ route('clientCours') }}"
    factureSupprimerModal="{{ route('factureSupprimerModal') }}"
    factureSupprimer="{{ route('factureSupprimer') }}"
    factureBonachatModal="{{ route('factureBonachatModal') }}"
    factureBonachatUtiliser="{{ route('factureBonachatUtiliser') }}"
    factureBonachatAnnuler="{{ route('factureBonachatAnnuler') }}"
    facturePayerModal="{{ route('facturePayerModal') }}"
    factureSetPaiementMode="{{ route('factureSetPaiementMode') }}"
    facturePayer="{{ route('facturePayer') }}"
    factureGenererTickets="{{ route('factureGenererTickets') }}"
    factureModifierModal="{{ route('factureModifierModal') }}"
    factureModifier="{{ route('factureModifier') }}"
    factureImpayerModal="{{ route('factureImpayerModal') }}"
    factureImpayer="{{ route('factureImpayer') }}"
    factureLierModal="{{ route('factureLierModal') }}"
    factureLier="{{ route('factureLier') }}"
    factureDelierModal="{{ route('factureDelierModal') }}"
    factureDelier="{{ route('factureDelier') }}"
    factureAjouterSelectionTypeAjoutModal="{{ route('factureAjouterSelectionTypeAjoutModal') }}"
    factureAjouterChoixPrestationModal="{{ route('factureAjouterChoixPrestationModal') }}"
    factureAjouterChoixTarifModal="{{ route('factureAjouterChoixTarifModal') }}"
    factureAjouterChoixPrestationgroupeModal="{{ route('factureAjouterChoixPrestationgroupeModal') }}"
    factureAjouter="{{ route('factureAjouter') }}"
    rechercherClient="{{ route('rechercherClient') }}"
    script="{{ route('script') }}"
    factureAnciennePrestationPayerModal="{{ route('factureAnciennePrestationPayerModal') }}"
    factureAnciennePrestationPayer="{{ route('factureAnciennePrestationPayer') }}"
    factureAnciennePrestationModifierModal="{{ route('factureAnciennePrestationModifierModal') }}"
    factureAnciennePrestationModifier="{{ route('factureAnciennePrestationModifier') }}"
    index2="{{ route('index2') }}"
    abonnementVerifierEcheance="{{ route('abonnementVerifierEcheance') }}"
    abonnementCreerModal="{{ route('abonnementCreerModal') }}"
    abonnementChoixTarifModal="{{ route('abonnementChoixTarifModal') }}"
    abonnementCreer="{{ route('abonnementCreer') }}"
    abonnementGetDetails="{{ route('abonnementGetDetails') }}"
    abonnementSupprimerModal="{{ route('abonnementSupprimerModal') }}"
    abonnementSupprimer="{{ route('abonnementSupprimer') }}"
    abonnementProlongerModal="{{ route('abonnementProlongerModal') }}"
    abonnementProlonger="{{ route('abonnementProlonger') }}"
></div>

<div class="row">
    <div class="col-3">

        <div class="row">
            <div class="col">
                <input class="form-control" list="datalistOptions" id="recherche_client" placeholder="rechercher un client"
                       autocomplete="off"
                       >
                <div class="invalid-feedback">3 lettres minimum</div>
                <datalist id="datalistOptions">

                    @foreach($clients as $client)

                    <option value="{{ $client->id_client }}# {{ $client->nom }} {{ $client->prenom }}">

                    @endforeach

                </datalist>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div id="display-client-details">
                </div>
            </div>
        </div>
    </div>


    <div class="col-9">

        <div class="row" id="index2">

            @include('pony.index.index2')

        </div>

    </div>
</div>
@endsection

@section('scriptjs')
    <script type="text/javascript" src="{{ URL::asset('js/pof/pof.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/pof/carte.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/pof/facture.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/pof/abonnement.js') }}"></script>
@endsection
