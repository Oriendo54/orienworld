<div class="modal-dialog modal-dialog-centered" style="max-width:600px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-primary" id="staticBackdropLabel">
                Ajouter un abonnement à {{ $client->nom }} {{ $client->prenom }}
            </h4>
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">

                <form>
                    <div class="form-group mb-3">
                        <label for="abonnement_prestation" class="h6">Prestation :</label>
                        <select class="form-control" name="abonnement_prestation" id="abonnement_prestation">
                                <option value="" selected>Aucune prestation sélectionnée</option>
                            @foreach($prestations as $prestation)
                                <option value="{{$prestation->id_prestation}}">{{$prestation->libelle}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="abonnement_prestation_groupe" class="h6">Groupe de prestations :</label>
                        <select class="form-control" name="abonnement_prestation_groupe" id="abonnement_prestation_groupe">
                                <option value="" selected>Aucun groupe sélectionné</option>
                            @foreach($groupes as $groupe)
                                <option value="{{$groupe->id_prestation_groupe}}">{{$groupe->libelle}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="abonnement_date_expiration" class="h6">Date d'expiration (laisser vide pour une durée indéterminée) :</label>
                        <input type="date" class="form-control" id="abonnement_date_expiration" name="abonnement_date_expiration">
                    </div>

                    <div class="form-group mb-3">
                        <label for="abonnement_libelle" class="h6">Libellé :</label>
                        <input type="text" class="form-control" name="abonnement_libelle" id="abonnement_libelle"/>
                    </div>
                </form>

        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" onclick="abonnementChoixTarifModal({{ $client->id_client }})">
                Sélectionner les tarifs</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Annuler</button>
        </div>
    </div>
</div>