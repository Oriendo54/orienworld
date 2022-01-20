<div class="modal-dialog modal-dialog-centered" style="max-width:600px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-danger" id="staticBackdropLabel">Attention !</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <p>L'abonnement n°{{$abonnement->id_abonnement}} 
            du client {{$abonnement->pofabonnementclient->pofclient->nom}} {{$abonnement->pofabonnementclient->pofclient->prenom}}
            est sur le point d'expirer.</p>
            
            <p class="mb-3">Voulez-vous supprimer cet abonnement ou le prolonger ?</p>
            <button type="button" class="btn btn-sm btn-info" onclick="abonnementGetDetails({{$abonnement->id_abonnement}}, true)">Afficher l'abonnement</button>
            
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" onclick="abonnementSupprimer({{ $abonnement->id_abonnement }})">Supprimer l'abonnement</button>
            <button type="button" class="btn btn-primary" onclick="abonnementProlongerModal({{ $abonnement->id_abonnement }}, true)">Prolonger l'abonnement</button>
        </div>
    </div>
</div>