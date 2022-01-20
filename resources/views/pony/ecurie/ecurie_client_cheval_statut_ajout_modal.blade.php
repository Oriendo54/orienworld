<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        
        <div class="modal-header">
            <h4 class="modal-title text-info" id="staticBackdropLabel">
                @if(!$client_cheval_statut) Ajout d'un nouveau statut client-cheval
                @else Modification du statut {{ $client_cheval_statut->libelle }}
                @endif
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="modal-body">  
            
            <label for="clientchevalstatut_libelle">Libellé du statut</label>
            <input type="text" class="form-control mb-2" name="clientchevalstatut_libelle" id="clientchevalstatut_libelle"
                   @if($client_cheval_statut) value="{{ $client_cheval_statut->libelle }}" @endif
                   />
                
        </div>
        <div class="modal-footer">
            
            <button class="btn btn-success" type="button" id="ajout-client-button" 
                    onclick="ecurieClientChevalStatutAjout(@if($client_cheval_statut){{ $client_cheval_statut->id_client_cheval_statut }}@endif)">
                Valider</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">Annuler</button>
            
        </div>
    </div>
</div>
