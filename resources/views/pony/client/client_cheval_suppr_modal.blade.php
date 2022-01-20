<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        
        <div class="modal-header">
            <h4 class="modal-title text-info" id="staticBackdropLabel">Suppression association client-cheval</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="modal-body">  
            
            Le client {{ $client_cheval->pofclient->nom }} {{ $client_cheval->pofclient->prenom }} 
            n'est plus associé avec {{ $client_cheval->pofcheval->nom }} ?
                
        </div>
        <div class="modal-footer">
            
            <button class="btn btn-success" type="button" id="ajout-client-button" 
                    onclick="clientChevalSuppr({{$client_cheval->id_client_cheval}},{{$client_cheval->pofclient->id_client}})">
                Valider la suppression du lien</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">Annuler</button>
            
        </div>
    </div>
</div>
