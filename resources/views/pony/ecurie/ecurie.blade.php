@extends('pony.template_pony')

@section('content')
    <div id="links"
    ecurieChevalAjoutModal="{{ route('ecurieChevalAjoutModal') }}"
    ecurieChevalAjout="{{ route('ecurieChevalAjout') }}"
    ecurieChevalAfficherCharges="{{ route('ecurieChevalAfficherCharges') }}"
    ecurieClientChevalStatutAjoutModal="{{ route('ecurieClientChevalStatutAjoutModal') }}"
    ecurieClientChevalStatutAjout="{{ route('ecurieClientChevalStatutAjout') }}"
    ecurieChargeAttribuerChevauxModal="{{ route('ecurieChargeAttribuerChevauxModal') }}"
    ecurieChargeAttribuerChevaux="{{ route('ecurieChargeAttribuerChevaux') }}"
    ecurieSupprChevalChargeModal="{{ route('ecurieSupprChevalChargeModal') }}"
    ecurieSupprimerChevalCharge="{{ route('ecurieSupprimerChevalCharge') }}"
    ecurieAppliquerChargesMensuelles="{{ route('ecurieAppliquerChargesMensuelles') }}"
    ></div>

    <button type="button" class="btn btn-primary mb-3 mr-3" onclick="ecurieChevalAjoutModal()" id="">Nouveau cheval</button>
    <button type="button" class="btn btn-primary mb-3" onclick="ecurieChargeAttribuerChevauxModal()">
        Renseigner une charge
    </button>
                
    <div id="chevaux" class="mb-4">
        @include('pony.ecurie.ecurie_chevaux', ['chevaux' => $chevaux])
    </div>
    
    <button class="btn btn-primary mb-3" onclick="ecurieClientChevalStatutAjoutModal()" id="">Nouveau statut client-cheval</button>
                
    <div id="client_cheval_statut">
        @include('pony.ecurie.ecurie_client_cheval_statut', ['client_cheval_statuts' => $client_cheval_statuts])
    </div>
@endsection

@section('scriptjs')
    <script type="text/javascript" type="module" src="{{ URL::asset('js/pof/ecurie.js') }}"></script>
@endsection
