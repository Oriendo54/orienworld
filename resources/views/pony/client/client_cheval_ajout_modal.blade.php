<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        
        <div class="modal-header">
            <h4 class="modal-title text-info" id="staticBackdropLabel">Ajouter un cheval à {{ $client->nom }} {{ $client->prenom }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="modal-body">  
            
            <label for="clientcheval_id_cheval">Cheval</label>
            <select class="form-control mb-2" name="clientcheval_id_cheval" id="clientcheval_id_cheval">
                @foreach($chevaux as $cheval)
                <option value="{{ $cheval->id_cheval }}"
                        @if($client_cheval) 
                        @if($client_cheval->id_cheval==$cheval->id_cheval) 
                        selected 
                        @endif 
                        @endif
                        >{{ $cheval->nom }}</option>
                @endforeach
            </select>
            
            <label for="clientcheval_id_client_cheval_statut">Statut client-cheval</label>
            <select class="form-control mb-2" name="clientcheval_id_client_cheval_statut" id="clientcheval_id_client_cheval_statut">
                @foreach($client_cheval_statuts as $client_cheval_statut)
                <option value="{{ $client_cheval_statut->id_client_cheval_statut }}"
                        @if($client_cheval) 
                        @if($client_cheval->id_client_cheval_statut==$client_cheval_statut->id_client_cheval_statut) 
                        selected 
                        @endif 
                        @endif
                        >{{ $client_cheval_statut->libelle }}</option>
                @endforeach
            </select>
                
        </div>
        <div class="modal-footer">
            
            <button class="btn btn-success" type="button" id="ajout-client-button" 
                    onclick="clientChevalAjout({{ $client->id_client }},@if($client_cheval){{ $client_cheval->id_client_cheval }}@endif)">
                Valider</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">Annuler</button>
            
        </div>
    </div>
</div>
