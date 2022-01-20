<div class="modal-dialog modal-dialog-centered" style="max-width:600px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-primary" id="staticBackdropLabel">Ajouter une facture à {{ $client->nom }} {{ $client->prenom }}</h4>
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            
            <label for="facture_id_groupe_prestation">Groupe de prestations</label>
            <select name="facture_id_groupe_prestation" id="facture_id_groupe_prestation" class="form-control">
                @foreach($groupes as $groupe)
                    <option value="{{$groupe->id_prestation_groupe}}">{{$groupe->libelle}}</option>
                @endforeach
            </select>
            
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" onclick="factureAjouterChoixTarifModal({{ $client->id_client}})">
                Choisir ce groupe de prestations</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Annuler</button>
        </div>
    </div>
</div>