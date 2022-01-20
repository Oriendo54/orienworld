<div class="modal-dialog modal-dialog-centered" style="max-width:600px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-danger" id="staticBackdropLabel">Modifier la facture</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <p class="h5">Modifier la facture {{ $facture->id_facture }} ?</p>
            
            <p>
                <label for="facture_total_ttc">Modifier le montant de la facture : </label>
                <input type="text" class="form-control" id="facture_total_ttc" aria-describedby="facture_total_ttc" placeholder="TTC de la facture"
                    value="{{round($facture->total_ttc,2)}}">
            </p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success" type="button" id="delete-element" 
                    onclick="factureAnciennePrestationModifier({{ $facture->id_facture }},{{ $facture->id_client }})">
                Valider</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Annuler</button>
        </div>
    </div>
</div>