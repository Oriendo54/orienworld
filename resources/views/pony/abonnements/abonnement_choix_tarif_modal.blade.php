<div class="modal-dialog modal-dialog-centered" style="max-width:600px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-primary" id="staticBackdropLabel">Ajouter un abonnement à {{ $client->nom }} {{ $client->prenom }}</h4>
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">

            <div class="choix_utilisateur"
                libelle="{{$libelle}}"
                date_expiration="{{$date_expiration}}">
            </div>

            @if($groupe)
                <div id="id_prestation_groupe" id_prestation_groupe="{{$groupe->id_prestation_groupe}}"></div>

                <h5 class="mb-3">Choisissez le tarif souhaité pour chaque prestation</h5>
                @foreach($groupe->pofprestationgroupeliens as $groupe_lien)
                    <label for="abonnement_id_tarif">{{$groupe_lien->pofprestation->libelle}}</label>
                    <select name="abonnement_id_tarif" id="{{'abonnement_id_tarif'.$groupe_lien->pofprestation->id_prestation}}" class="form-control mb-3 select_tarif" required>
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

                <h5 class="mb_3">Périodicité</h5>
                <div class="form-group">
                    <select class="form-control" id="abonnement_periodicite" name="abonnement_periodicite">
                        <option value="hebdomadaire" selected>Hebdomadaire</option>
                        <option value="mensuel">Mensuelle</option>
                        <option value="annuel">Annuelle</option>
                    </select>
                </div>
            @else
                <div id="id_prestation" id_prestation="{{$prestation->id_prestation}}"></div>
                
                <label for="abonnement_id_tarif" class="mb-3 h5">Choisissez le tarif souhaité</label>
                <select name="abonnement_id_tarif" id="{{'abonnement_id_tarif'}}" class="form-control mb-3 select_tarif" required>
                    @foreach($prestation->poftarifs as $tarif)
                        <option value="{{$tarif->id_tarif}}">
                            {{$tarif->libelle}} - 
                            {{$tarif->quantite}}x 
                            {{round($tarif->prix_ttc,2)}} €
                        </option>
                    @endforeach
                </select>
                
                @if(!in_array($prestation->id_prestation_type, [2, 5]))
                <h5 class="mb_3">Périodicité</h5>
                <div class="form-group">
                    <select class="form-control" id="abonnement_periodicite" name="abonnement_periodicite">
                        <option value="hebdomadaire" selected>Hebdomadaire</option>
                        <option value="mensuel">Mensuelle</option>
                        <option value="annuel">Annuelle</option>
                    </select>
                </div>
                @endif
            @endif

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-warning" onclick="abonnementCreerModal({{ $client->id_client }})">Retour au choix précédent</button>
            <button type="button" class="btn btn-success" onclick="abonnementCreer({{ $client->id_client }})">Créer l'abonnement</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Annuler</button>
        </div>
    </div>
</div>