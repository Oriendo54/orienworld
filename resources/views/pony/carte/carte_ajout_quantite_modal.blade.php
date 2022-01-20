<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4>Ajout de crédit</h4>
        </div>
        <div class="modal-body">  
            
            <h5>Carte {{ $carte->pofprestation->libelle }}</h5>
            <br>
            <b>Liste des tarifs disponibles : </b>
            <br>
            
            @foreach($carte->pofprestation->poftarifs as $tarif)
            <button type="button" class="btn btn-primary mt-2" onclick="carteAjoutQuantite({{ $carte->id_carte }},null,{{ $tarif->id_tarif }})">
                @if($tarif->libelle)
                {{ $tarif->libelle }}
                @else
                + {{ $tarif->quantite }}
                @endif
            
            </button>
            <br>
            @endforeach
            
            <div class="input-group mb-3 mt-2">
              <input type="text" class="form-control" name="carteAjoutQuantiteModal_autrequantite" placeholder="Par quantité">
              <div class="input-group-append">
                <button class="btn btn-outline-success" type="button" onclick="carteAjoutQuantite({{ $carte->id_carte }},0,null)">Valider</button>
              </div>
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Annuler</button>
        </div>
    </div>
</div>