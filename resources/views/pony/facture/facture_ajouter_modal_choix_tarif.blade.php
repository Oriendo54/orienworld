<div class="modal-dialog modal-dialog-centered" style="max-width:600px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-primary" id="staticBackdropLabel">Ajouter une facture à {{ $client->nom }} {{ $client->prenom }}</h4>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">

            @if(isset($groupe))
            <h5 class="mb-3">Choisissez le tarif souhaité pour chaque prestation</h5>
                @foreach($groupe_liens as $groupe_lien)
                    <label for="facture_id_tarif">{{$groupe_lien->pofprestation->libelle}}</label>
                    <select name="facture_id_tarif" id="{{'facture_id_tarif'.$groupe_lien->pofprestation->id_prestation}}" class="form-control mb-3 select_tarif" required>
                        @foreach($groupe_lien->pofprestation->poftarifs as $tarif)
                            @if($tarif->id_tarif == $groupe_lien->id_tarif_defaut)
                            <option value="{{$tarif->id_tarif}}" selected>
                            @else
                            <option value="{{$tarif->id_tarif}}">
                            @endif
                                {{$tarif->libelle}} -
                                {{$tarif->quantite}}x
                                {{round($tarif->prix_ttc,2)}} €
                            </option>
                        @endforeach
                    </select>
                @endforeach
            @else
            <p><b>Prestation choisie : {{$prestation->libelle}}</b></p>
            <label for="facture_id_tarif">Tarif</label>
            <select name="facture_id_tarif" id="facture_id_tarif" class="form-control" required>
                @foreach($prestation->poftarifs as $tarif)
                    <option value="{{$tarif->id_tarif}}">
                        {{$tarif->libelle}} -
                        {{$tarif->quantite}}x
                        {{round($tarif->prix_ttc,2)}} €
                    </option>
                @endforeach
            </select>
            @endif

        </div>
        <div class="modal-footer">
            @if(isset($groupe))
            <button class="btn btn-warning" type="button" onclick="factureAjouterChoixPrestationgroupeModal({{ $client->id_client }})">
                Retour au choix précédent</button>

            <button class="btn btn-primary" type="button" onclick="factureAjouter({{ $client->id_client }}, {{$groupe->id_prestation_groupe}})">
                Valider</button>
            @else
            <button class="btn btn-warning" type="button" onclick="factureAjouterChoixPrestationModal({{ $client->id_client }})">
                Retour au choix précédent</button>
            <button class="btn btn-primary" type="button" onclick="factureAjouter({{ $client->id_client }})">
                Valider</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Annuler</button>
            @endif
        </div>
    </div>
</div>
