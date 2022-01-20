<div class="modal-dialog modal-dialog-centered" style="max-width:600px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-primary" id="staticBackdropLabel">Ajouter une facture à {{ $client->nom }} {{ $client->prenom }}</h4>
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            
            <button class="btn btn-primary btn-sm ml-3" onclick="factureAjouterChoixPrestationModal({{$client->id_client}})">Facturer une prestation</button>
            <button class="btn btn-primary btn-sm ml-3" onclick="factureAjouterChoixPrestationgroupeModal({{$client->id_client}})">Facturer un groupe de prestations</button>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Annuler</button>
        </div>
    </div>
</div>