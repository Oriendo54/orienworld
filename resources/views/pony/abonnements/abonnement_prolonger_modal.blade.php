<div class="modal-dialog modal-dialog-centered" style="max-width:700px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-primary" id="staticBackdropLabel">Prolonger l'abonnement n° {{$abonnement->id_abonnement}} 
                de {{$abonnement->pofabonnementclient->pofclient->nom}} {{$abonnement->pofabonnementclient->pofclient->prenom}}</h4>
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
        
            <div class="form-group">
                <label for="date_expiration" class="h6">Nouvelle date d'expiration (laisser vide pour une durée indéterminée) :</label>
                <input type="date" class="form-control" id="date_expiration" name="date_expiration">
            </div>

        </div>
        <div class="modal-footer">
            @if(isset($expiration))
            <button type="button" class="btn btn-success" onclick="abonnementProlonger({{ $abonnement->id_abonnement }}, true)">Prolonger</button>
            @else
            <button type="button" class="btn btn-success" onclick="abonnementProlonger({{ $abonnement->id_abonnement }})">Modifier la date</button>
            @endif
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Annuler</button>
        </div>
    </div>
</div>