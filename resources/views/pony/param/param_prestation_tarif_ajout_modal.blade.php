<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        
        <div class="modal-header">
            <h4 class="modal-title text-info" id="staticBackdropLabel">Nouveau tarif pour la prestation {{ $prestation->libelle }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="modal-body">  
            
            <label for="tarif_libelle">Libellé</label>
            <input type="text" class="form-control mb-2" name="tarif_libelle" id="tarif_libelle"
                   @if($tarif) value="{{ $tarif->libelle }}" @endif
                   />
            
            <label for="tarif_prix_ttc">Prix TTC</label>
            <input type="text" class="form-control mb-2" name="tarif_prix_ttc" id="tarif_prix_ttc"
                   @if($tarif) value="{{ round($tarif->prix_ttc,2) }}" @endif
                   />
            
            <label for="tarif_pourcentage">Pourcentage</label>
            <input type="text" class="form-control mb-2" name="tarif_pourcentage" id="tarif_pourcentage"
                   @if($tarif) value="{{ round($tarif->pourcentage,2) }}" @endif
                   />
            
            <label for="tarif_quantite">Quantité</label>
            <input type="text" class="form-control mb-2" name="tarif_quantite" id="tarif_quantite" placeholder="1 par défaut"
                   @if($tarif) value="{{ $tarif->quantite }}" @endif
                   />
            
            <label for="tarif_date_debut">Date de début</label>
            <input type="date" name="tarif_date_debut" id="tarif_date_debut" class="form-control" required
                       @if($tarif) value="{{ $tarif->date_debut }}" @endif
                       />
            
            <label for="tarif_date_fin">Date de fin</label>
            <input type="date" name="tarif_date_fin" id="tarif_date_fin" class="form-control" required
                       @if($tarif) value="{{ $tarif->date_fin }}" @endif
                       />
                
        </div>
        <div class="modal-footer">
            
            <button class="btn btn-success" type="button" id="ajout-client-button" 
                    onclick="paramTarifAjout({{ $prestation->id_prestation }}@if($tarif),{{ $tarif->id_tarif }}@endif)">
                Valider</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">Annuler</button>
            
        </div>
    </div>
</div>
