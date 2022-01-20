<div class="modal-dialog modal-dialog-centered" style="max-width:900px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-primary" id="staticBackdropLabel">Délier la facture</h4>
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
           
            <p>Délier la facture : <p>
            <p>
                {{ $facture->libelle }}
            </p>
           
        </div>
        <div class="modal-footer">
            <button class="btn btn-success" type="button" onclick="factureDelier({{ $facture->id_facture }},{{ $facture->id_client }})">
                Délier</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Annuler</button>
        </div>
    </div>
</div>