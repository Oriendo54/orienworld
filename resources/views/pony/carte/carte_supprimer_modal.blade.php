<div class="modal-dialog modal-dialog-centered" style="max-width:900px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-primary" id="staticBackdropLabel">Supprimer la carte {{ $carte->id_carte }}</h4>
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            
            <p><b>Client : {{$carte->pofclient->nom}} {{$carte->pofclient->prenom}}</b></p>
            
            <p>
            {{ $carte->pofprestation->libelle }} -
            @if($carte->solde > 0)
                Solde : {{ round($carte->solde) }}
            @endif
            @if($carte->solde <= 0)
                <span class="text-danger font-weight-bold"> Solde : {{ round($carte->solde) }}</span>
            @endif    
            </p>
            
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" onclick="carteSupprimer({{ $carte->id_carte }})">
                Supprimer</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Annuler</button>
        </div>
    </div>
</div>