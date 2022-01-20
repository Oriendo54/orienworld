<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        
        <div class="modal-header">
            <h4 class="modal-title text-info" id="staticBackdropLabel">Ajouter un téléphone à {{$client->nom}} {{$client->prenom}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="modal-body">  
            <div class="input-group w-50 input-group-md ml-1 mb-3">
                <input placeholder="Telephone" type="text" name="client_telephone" id="client_telephone" class="form-control" required/>
            </div>
                
        </div>
        <div class="modal-footer">
            
            <button class="btn btn-success" type="button" id="ajout-client-button" 
                    onclick="clientTelephoneAjout({{$client->id_client}})">
                Ajouter</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">Annuler</button>
            
        </div>
    </div>
</div>