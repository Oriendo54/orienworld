<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        
        <div class="modal-header">
            <h4 class="modal-title text-info" id="staticBackdropLabel">Nouveau moyen de paiement</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="modal-body">
            <form>
                <div class="mb-3 d-flex flex-column">
                    <label for="libelle">Libellé :</label>
                    <input type="text" name="libelle" id="libelle" class="form-control ml-2 w-75" required>
                </div>
            </form>
        </div>
        <div class="modal-footer">          
            <button class="btn btn-success" type="button" id="ajout-paiement-button" 
                    onclick="moyenPaiementCreer()">
                Valider</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">Annuler</button>     
        </div>
    </div>
</div>
