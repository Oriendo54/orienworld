<div class="modal-dialog modal-dialog-centered" style="max-width:250px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-danger" id="staticBackdropLabel">
                Réinscrire {{ $coursclient->pofclient->firstname }} {{ $coursclient->pofclient->lastname }}
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <button class="btn btn-success mb-2" type="button" id="delete-element" 
                    onclick="coursReinscrire({{ $coursclient->id_cours }},{{ $coursclient->id_client }},{{ $coursclient->id_cours_client }},7)">
                Semaine prochaine</button>
            <br>
            <button class="btn btn-primary mb-2" type="button" id="delete-element" 
                    onclick="coursReinscrire({{ $coursclient->id_cours }},{{ $coursclient->id_client }},{{ $coursclient->id_cours_client }},14)">
                Dans deux semaines</button>
            <br>
            <button class="btn btn-secondary" type="button" id="delete-element" 
                    onclick="coursReinscrire({{ $coursclient->id_cours }},{{ $coursclient->id_client }},{{ $coursclient->id_cours_client }},21)">
                Dans trois semaines</button>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Annuler</button>
        </div>
    </div>
</div>