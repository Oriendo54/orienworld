<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        
        <div class="modal-header">
            <h4 class="modal-title text-info" id="staticBackdropLabel">Association avec {{ $prestation->libelle }} </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="modal-body">  
            
            <label for="prestationassociation_id_prestation">Prestation à associer avec {{ $prestation->libelle }}</label>
            <select class="form-control mb-2" name="prestationassociation_id_prestation" id="prestationassociation_id_prestation">
                @foreach($prestations as $prestation_a_associer)
                <option value="{{ $prestation_a_associer->id_prestation }}">{{ $prestation_a_associer->libelle }}</option>
                @endforeach
            </select>
                
        </div>
        <div class="modal-footer">
            
            <button class="btn btn-success" type="button" id="ajout-client-button" 
                    onclick="paramPrestationAssociationAjout({{ $prestation->id_prestation }})">
                Valider</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">Annuler</button>
            
        </div>
    </div>
</div>
