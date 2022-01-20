<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-danger" id="staticBackdropLabel">Erreur !</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body error">
            <img src="../img/oricryemote.png" alt="ori-cry"/>
            @if(isset($erreur))
            <p>Erreur : {{ $erreur }}</p>
            @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Retour</button>
        </div>
    </div>
</div>