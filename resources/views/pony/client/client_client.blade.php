<td>{{$client->id_client}}</td>
<td>{{$client->nom}} {{$client->prenom}}</td>

    <td>
    @if(!is_null($client->pofclientadresses))
        @php $i = 0; @endphp
        @foreach($client->pofclientadresses as $clientadresse)
        @if($i)<br/> 
        @endif
        @php $i=1; @endphp
        {{$clientadresse->rue}}, {{$clientadresse->code_postal}} - {{$clientadresse->ville}}
        @php $i++; @endphp
        <button type="button" class="btn btn-sm btn-warning ml-3 mt-1" onclick="clientAdresseAjoutModal({{$client->id_client}}, {{$clientadresse->id_client_adresse}})"><i class="fas fa-pen"></i></button>
        <button type="button" class="btn btn-sm btn-danger mt-1" onclick="clientAdresseSupprModal({{$clientadresse->id_client_adresse}})"><i class="fas fa-trash"></i></button>
        @endforeach
    @else
        Adresse du client inconnue
    @endif
    </td>

    <td> 
    @if(!is_null($client->pofclienttelephones))
        @php $i = 0; @endphp
        @foreach($client->pofclienttelephones as $clienttelephone)
        @if($i), 
        @endif
        @php $i=1; @endphp
        <div class="input-group">
            <input type="text" class="form-control" name="client_telephone" id="{{'client_telephone'.$clienttelephone->id_client_telephone}}" value="{{ trim($clienttelephone->telephone)}}">
            <div class="input-group-append ml-1">
                <button type="button" class="btn btn-sm btn-warning mr-1" onclick="updateClientTelephone({{$clienttelephone->id_client_telephone}})"><i class="fas fa-pen"></i></button>
                <button type="button" class="btn btn-sm btn-danger" onclick="clientTelephoneSupprModal({{$clienttelephone->id_client_telephone}})"><i class="fas fa-trash"></i></button>
            </div>
        </div>
        @endforeach
    @else
        Aucun numéro enregistré
    @endif
    </td>

<td>{{$client->email}}</td>
<td>{{$client->pofclientstatut->libelle}}</td>
<td>
    <div class="d-flex justify-content-between">
    @if($client->pofuserrole)
    {{$client->pofuserrole->pofrole->libelle}}
    @else
    <span class="text-danger font-weight-bold">non inscrit</span>
    @endif
    
    @if(!$client->id_client_parent)
        <button class="btn btn-sm btn-primary ml-2" type="button"
            onclick="clientEnvoyerMailInscriptionModal({{$client->id_client}})">
        <i class="fas fa-envelope-open-text"></i></button>
    @endif
    </div>
</td>
<td>
    <button class="btn btn-sm btn-warning" type="button" 
        onclick="clientAjoutModal({{$client->id_client}})">
    <i class="fas fa-edit"></i></button>
    <button class="btn btn-sm btn-primary client_cheval" id_client="{{$client->id_client}}" type="button" 
        onclick="clientChevalButton({{$client->id_client}})">
    <i class="fas fa-horse"></i></button>
    <button class="btn btn-sm btn-primary" type="button" 
        onclick="clientAdresseAjoutModal({{$client->id_client}})">
    <i class="fas fa-address-book"></i></button>
    <button class="btn btn-sm btn-primary" type="button" 
        onclick="clientTelephoneAjoutModal({{$client->id_client}})">
    <i class="fas fa-phone"></i></button>
    <button class="btn btn-sm btn-success ml-2 afficher_bonachats" type="button" id_client="{{$client->id_client}}"
        onclick="clientBonachats({{$client->id_client}})">
    <i class="fas fa-plus"></i></button>
    <button class="btn btn-sm btn-warning ml-2 fermer_bonachats d-none" type="button" id_client="{{$client->id_client}}"
        onclick="clientFermerBonachats({{$client->id_client}})">
    <i class="fas fa-minus"></i></button>
</td>

