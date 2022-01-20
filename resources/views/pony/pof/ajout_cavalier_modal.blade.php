<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-info" id="staticBackdropLabel">Ajouter un cavalier</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <ul class="list-group">
                @if(isset($liste_cavaliers))
                    @foreach($liste_cavaliers as $cavalier)
                        <li class="cursor_pointer list-group-item" onclick="ajoutCavalier('{{ $cavalier->id_client }}')">{{$cavalier->nom}} {{$cavalier->prenom}}</li>
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="modal-footer">
            
        </div>
    </div>
</div>