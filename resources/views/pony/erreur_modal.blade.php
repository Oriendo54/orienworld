<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-danger" id="staticBackdropLabel">Erreur !</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @if(isset($erreur))
            <p class="text-danger">{!! $erreur !!}</p>
            @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Fermer</button>
        </div>
    </div>
</div>