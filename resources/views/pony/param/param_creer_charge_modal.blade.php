<div class="modal-dialog modal-dialog-centered" style="max-width:600px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-info" id="staticBackdropLabel">Créer une charge</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="modal-body">
            <div class="input-group mb-3">
                <input type="text" id="charge_libelle" class="form-control" placeholder="libellé" required @if($charge) value="{{$charge->libelle}}" @endif/>
            </div>
            <div class="d-flex flex-column">
                <label for="charge_periodicite">Periodicité</label>
                <select class="form-control" id="charge_periodicite">
                    <option value="mensuel">Mensuelle</option>
                    <option value="unitaire" selected>Unitaire</option>
                </select>
            </div>
            <div class="d-flex flex-column mt-3">
                <label for="charge_montant">Montant par défaut (optionnel)</label>
                <input type="text" id="charge_montant" name="charge_montant" class="form-control" @if($charge) value="{{round($charge->montant, 2)}}" @endif/>
            </div>
        </div>

        <div class="modal-footer">
            @if(!$charge)
                <button class="btn btn-primary" type="button" onclick="paramCreerCharge()">Créer la charge</button>
            @else
                <button class="btn btn-primary" type="button" onclick="paramCreerCharge({{$charge->id_charge}})">Modifier la charge</button>
            @endif
            <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">Annuler</button>
        </div>
    </div>
</div>