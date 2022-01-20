<h2 class="mt-3">
    <a href="{{ route('client', ['id_client' => $client->id_client]) }}">{{$client->nom}} {{$client->prenom}}</a>
</h2>

<p class="mt-2">
    @if($client->pofclientniveau)
    {{$client->pofclientniveau->libelle}}, 
    @endif
    @if($age > 13) Cheval @endif
    @if($age <= 13) Poney @endif, 
    {{ $age }} ans.<br/>
    {{$client->pofclientstatut->libelle}}
</p>

<h3 class="text-info">Contact</h3>

<p class="ml-1">
    {{$client->email}}<br/>
    
    @foreach($client->pofclienttelephones as $pofclienttelephone)
        {{$pofclienttelephone->telephone}}<br/>
    @endforeach
    
    @foreach($client->pofclientadresses as $pofclientadresse)
        {{$pofclientadresse->rue}}, {{$pofclientadresse->code_postal}} - {{$pofclientadresse->ville}}<br/>
    @endforeach
    
</p>
        
<h3 class="text-info">Cartes</h3>

<ul class="mt-3 mb-3 list-group list-group-flush">
@if(isset($client->pofcartes))
    @foreach($client->pofcartes as $carte)
        <li class="list-group-item p-1">
            {{ $carte->pofprestation->libelle }} -
            @if($carte->solde > 0)
                Solde : {{ round($carte->solde) }}
            @endif
            @if($carte->solde <= 0)
                <span class="text-danger font-weight-bold"> Solde : {{ round($carte->solde) }}</span>
            @endif
            
            <button class="btn-primary ml-2 btn btn-sm" onclick="carteAjoutQuantiteModal({{ $carte->id_carte }})">
                <i class="far fa-edit"></i>
            </button>
            
            @if($carte->solde == 0)
                <button class="btn btn-sm btn-danger" type="button" onclick="carteSupprimerModal({{ $carte->id_carte }})">
                <i class="fas fa-times"></i></button>
            @endif
        </li>
    @endforeach
@else
    <p class="text-danger">Ce client n'a pas encore de carte.</p>
@endif
</ul>

<h3 class="text-info cursor_pointer" onclick="clientCours({{$client->id_client}})">Liste des cours</h3>

<table class="mt-3 mb-3 table table-sm table-bordered">
    <thead>
        <tr>
            <th>Date</th>
            <th>Type de cours</th>
            <th>Cheval</th>
        </tr>
    </thead>
    <tbody>

    @foreach($client5dernierscours as $cours)
    <tr class="cursor_pointer" id="lccd-{{$cours->id_cours}}" 
            onclick="index2();
                selectionDatePlanning('{{$cours->date_cours}}'); 
                getPlanning('{{$cours->date_cours}}'); 
                afficherCoursDetails({{$cours->id_cours}})">
        <td>
            {{ POFDate::dateJourdelasemaine($cours->date_cours) }} 
            {{ $cours->date_cours }} 
            {{ \Carbon\Carbon::parse($cours->heure_debut)->format('H:i') }}
        </td>
        <td>{{ $cours->libelle }}</td>
        <td>@if($cours->id_cheval){{ $cours->nom }}@endif</td>
    </tr>
    @endforeach
    </tbody>
</table>

<h3 class="text-info cursor_pointer" onclick="factureAfficher({{$client->id_client}})">Factures</h3>

<table class="table table-sm table-bordered text-center">
    <thead>
    <tr class="text-center">
        <th>date</td>
        <th>montant</td>
        <th>libelle</td>
    </tr>
    </thead>
    <tbody>
        @foreach($client->poffactures5dernieres as $facture)
        @if($facture->id_facture_statut == 1)
        <tr class="text-danger table-warning">
        @else 
        <tr class="">
        @endif
            <td>{{ \Carbon\Carbon::parse($facture->date_facture)->format('d/m/Y')}}</td>
            <td>{{round($facture->total_ttc, 2)}} €</td>
            <td>{{$facture->libelle}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3 class="text-info cursor_pointer" onclick="abonnementCreerModal({{$client->id_client}})">Abonnements</h3>

<div id="abonnements">
    @include('pony.abonnements.abonnements', ['client' => $client])
</div>