@extends('pony.template_pony')

@section('content')
    <div id="links"
        clientMAJ="{{ route('clientMAJ') }}"
        clientAjoutModal="{{ route('clientAjoutModal') }}"
        clientAjout="{{ route('clientAjout') }}"
        clientChangerRoleModal="{{ route('clientChangerRoleModal') }}"
        clientEnvoyerMailInscriptionModal="{{ route('clientEnvoyerMailInscriptionModal') }}"
        clientEnvoyerMailInscription="{{ route('clientEnvoyerMailInscription') }}"
        clientCheval="{{ route('clientCheval') }}"
        clientChevalAjoutModal="{{ route('clientChevalAjoutModal') }}"
        clientChevalAjout="{{ route('clientChevalAjout') }}"
        clientChevalSupprModal="{{ route('clientChevalSupprModal') }}"
        clientChevalSuppr="{{ route('clientChevalSuppr') }}"
        clientTelephoneAjoutModal="{{ route('clientTelephoneAjoutModal') }}"
        clientTelephoneAjout="{{ route('clientTelephoneAjout') }}"
        updateClientTelephone="{{ route('updateClientTelephone') }}"
        clientTelephoneSupprModal="{{ route('clientTelephoneSupprModal') }}"
        clientTelephoneSupprimer="{{ route('clientTelephoneSupprimer') }}"
        clientAdresseAjoutModal="{{ route('clientAdresseAjoutModal') }}"
        clientAdresseAjout="{{ route('clientAdresseAjout') }}"
        updateClientAdresse="{{ route('updateClientAdresse') }}"
        clientAdresseSupprModal="{{ route('clientAdresseSupprModal') }}"
        clientAdresseSupprimer="{{ route('clientAdresseSupprimer') }}"
        clientBonachats="{{ route('clientBonachats') }}"
        clientBonachatsEpuises="{{ route('clientBonachatsEpuises') }}"
        clientBonachatFactures="{{ route('clientBonachatFactures') }}"
        clientBonachatCreerModal="{{ route('clientBonachatCreerModal') }}"
        clientBonachatCreer="{{ route('clientBonachatCreer') }}"
        clientBonachatMaj="{{ route('clientBonachatMaj') }}"
        clientBonachatSupprModal="{{ route('clientBonachatSupprModal') }}"
        clientBonachatSupprimer="{{ route('clientBonachatSupprimer') }}"
    ></div>

    <button class="btn btn-primary mb-3" onclick="clientAjoutModal()" id="ajout-client">Nouveau client</button>
                
    <div id="liste-clients">
        
        <table class="table table-bordered table-striped table-hover clients pony-table">
            <thead>
                <tr class="table-warning">
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Adresse</th>
                    <th>Telephone</th>
                    <th>Mail</th>
                    <th>Statut</th>
                    <th>Rôle</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                <tr class="ligne_client" id_client="{{$client->id_client}}">
                    @include('pony.client.client_client', ['client' => $client])
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @if(count($clients)>1)
        {{ $clients->links("pagination::bootstrap-4") }}
        @endif
        
    </div>
@endsection

@section('scriptjs')
    <script type="text/javascript" type="module" src="{{ URL::asset('js/pof/clients.js') }}"></script>
@endsection
