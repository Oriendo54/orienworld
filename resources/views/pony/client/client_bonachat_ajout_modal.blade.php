<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        
        <div class="modal-header">
            @if(!isset($bonachat))
            <h4 class="modal-title text-info" id="staticBackdropLabel">Ajouter un bon d'achat à {{$client->nom}} {{$client->prenom}}</h4>
            @else
            <h4 class="modal-title text-info" id="staticBackdropLabel">Modifier le bon d'achat de {{$client->nom}} {{$client->prenom}}</h4>
            @endif
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="modal-body">
            @if(!isset($bonachat))
            <div class="input-group w-75 input-group-md ml-1 mb-3">
                <input placeholder="Valeur" type="text" name="valeur" id="valeur" class="form-control" required/>
            </div>
            <div class="input-group w-75 input-group-md ml-1 mb-3">
                <label for="minimum" class="mr-2">Minimum :</label>
                <input type="text" name="minimum" id="minimum" class="form-control" value="0" required/> 
            </div>
            @endif
            <div class="input-group w-75 input-group-md ml-1 mb-3">
                <label for="date_expiration" class="mr-2">Date d'expiration :</label>
                @if(isset($bonachat))
                <input type="date" name="date_expiration" id="date_expiration" class="form-control" value="{{\Carbon\Carbon::parse($bonachat->date_expiration)->format('Y-m-d')}}" required/>
                @else
                <input type="date" name="date_expiration" id="date_expiration" class="form-control" value="2099-12-31" required/>
                @endif
            </div>
        </div>
        <div class="modal-footer">
            @if(!isset($bonachat))
            <button class="btn btn-success" type="button" id="ajout-bonachat-button" 
                    onclick="clientBonachatCreer({{$client->id_client}})">
                Ajouter</button>
            @else
            <button class="btn btn-success" type="button" id="ajout-bonachat-button" 
                    onclick="clientBonachatMaj({{$client->id_client}}, {{$bonachat->id_bonachat}})">
                Mettre à jour</button>
            @endif
            <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">Annuler</button>
        </div>
    </div>
</div>