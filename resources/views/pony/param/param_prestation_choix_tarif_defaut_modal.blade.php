<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        
        <div class="modal-header">
            <h4 class="modal-title text-info" id="staticBackdropLabel">
                Sélectionner un tarif par défaut pour la prestation {{$prestation->libelle}}
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="modal-body">
            <h5>Groupe {{$groupe_lien->pofprestationgroupe->libelle}}.</h5>
            <select class="form-control" id="choix_tarif_defaut">
                @foreach($tarifs as $tarif)
                    <option value="{{$tarif->id_tarif}}">{{$tarif->libelle}} - {{round($tarif->prix_ttc, 2)}} €</option>
                @endforeach
            </select>
            
        <div class="modal-footer">
            <button class="btn btn-success" type="button" 
                onclick="paramPrestationGroupeTarifDefaut({{$groupe_lien->id_prestation_groupe_lien}}, 
                {{$groupe_lien->pofprestationgroupe->id_prestation_groupe}})">
                    valider
            </button>
            <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">Annuler</button>    
        </div>
    </div>
</div>