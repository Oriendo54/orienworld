<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-danger" id="staticBackdropLabel">Attention !</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <p class="h5">Voulez-vous vraiment supprimer {{$element}} ?</p>
            @if(isset($message))
            <p class="mt-2">{{$message}}</p>
            @endif
        </div>
        <div class="modal-footer">
            @if(isset($function))
            <button class="btn btn-danger" type="button" id="delete-element" onclick="{{$function}}">Supprimer {{$element}}</button>
            @else
            <button class="btn btn-danger" type="button" id="delete-element">Supprimer {{$element}}</button>
            @endif
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Annuler</button>
        </div>
    </div>
</div>