<div class="modal-dialog modal-dialog-centered" style="max-width:600px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-danger" id="staticBackdropLabel">Payer la facture</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <p class="h5">Payer la facture {{ $facture->id_facture }} ?</p>
            
            <p>
                Total : {{round($facture->total_ttc,2)}} € TTC
            </p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success" type="button" id="delete-element" 
                    onclick="factureAnciennePrestationPayer({{ $facture->id_facture }},{{ $facture->id_client }})">
                Payer</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Annuler</button>
        </div>
    </div>
</div>