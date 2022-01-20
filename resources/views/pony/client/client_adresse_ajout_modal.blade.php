<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        
        <div class="modal-header">
            <h4 class="modal-title text-info" id="staticBackdropLabel">Ajouter une adresse à {{$client->nom}} {{$client->prenom}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="modal-body">  
            <div class="input-group w-50 input-group-md ml-1 mb-3">
                @if(isset($adresse))
                <input type="text" name="client_rue" id="client_rue" class="form-control" value="{{$adresse->rue}}" required/>
                @else
                <input placeholder="Adresse" type="text" name="client_rue" id="client_rue" class="form-control" required/>
                @endif
            </div>
            <div class="d-flex mb-3">
                <div class="w-50 ml-1">
                    @if(isset($adresse))
                    <input type="text" name="client_code_postal" id="client_code_postal" class="form-control" value="{{$adresse->code_postal}}" required/>
                    @else
                    <input type="text" placeholder="Code Postal" name="client_code_postal" id="client_code_postal" class="form-control" required/>
                    @endif
                </div>
                <div class="w-50 ml-1">
                    @if(isset($adresse))
                    <input type="text" class="form-control" name="client_ville" id="client_ville" value="{{$adresse->ville}}" required/>
                    @else
                    <input type="text" placeholder="Ville" class="form-control" name="client_ville" id="client_ville" required/>
                    @endif
                </div>
            </div>  
        </div>
        <div class="modal-footer">
            @if(!isset($adresse))
            <button class="btn btn-success" type="button" id="ajout-client-button" 
                    onclick="clientAdresseAjout({{$client->id_client}})">
                Ajouter</button>
            @else
            <button class="btn btn-success" type="button" id="ajout-client-button" 
                    onclick="updateClientAdresse({{$adresse->id_client_adresse}})">
                Mettre à jour</button>
            @endif
            <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">Annuler</button>
        </div>
    </div>
</div>