<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-danger" id="staticBackdropLabel">Attention !</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            @if(isset($message))
                <p class="mb-3">{{$message}}</p>
            @endif
            <p class="h5">Voulez-vous vraiment {{ $action }} ?</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" onclick="{{ $fonction }}">Confirmer</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Annuler</button>
        </div>
    </div>
</div>