<div class="modal-dialog modal-dialog-centered" style="max-width:600px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-danger" id="staticBackdropLabel">Suppression d'un cours</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <p class="h5">Supprimer uniquement le cours à la date du {{\Carbon\Carbon::parse($cours->date_cours)->format('d-m-Y')}} ou toutes les occurences du cours ?</p>
            <p>Les occurences où au moins un cavalier est inscrit seront conservées.</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-warning" type="button" id="delete-element" onclick="coursSuppression({{ $cours->id_cours }},1)">
                Supprimer juste ce cours</button>
            <button class="btn btn-danger" type="button" id="delete-element" onclick="coursSuppression({{ $cours->id_cours }},2)">
                Supprimer toutes les occurences</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Annuler</button>
        </div>
    </div>
</div>