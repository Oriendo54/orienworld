<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-info" id="staticBackdropLabel">Nouveau cheval</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="modal-body">
            
                <div class="input-group input-group-md mb-3">
                    <input placeholder="Nom" type="text" name="cheval_nom" id="cheval_nom" class="form-control" required
                           @if($cheval) value="{{ $cheval->nom }}" @endif
                           />
                </div>
            
                <div class="ml-1 mb-3">
                    <label for="cheval_date_naissance">Date de naissance :</label>
                    <input type="date" placeholder="Date de naissance" name="cheval_date_naissance" id="cheval_date_naissance" class="form-control" required
                               @if($cheval) value="{{ $cheval->date_naissance }}" @endif
                               />
                </div>
            
                <label for="cheval_id_cheval_type">Type de cheval</label>
                <select name="cheval_id_cheval_type" id="cheval_id_cheval_type" class="form-control" required>
                    @foreach($chevaltypes as $chevaltype)
                        <option value="{{$chevaltype->id_cheval_type}}"
                                @if($cheval)
                                @if($cheval->id_cheval_type==$chevaltype->id_cheval_type) selected @endif
                                @endif
                                >{{$chevaltype->libelle}}</option>
                    @endforeach
                </select>

                <div class="mt-3 ml-2">
                    <div class="form-check">
                        <input class="form-check-input cheval_actif" type="radio" name="cheval_actif" id="cheval_actif1" value="1" checked>
                        <label class="form-check-label" for="cheval_actif1">
                            Actif
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input cheval_actif" type="radio" name="cheval_actif" id="cheval_actif2" value="0">
                        <label class="form-check-label" for="cheval_actif2">
                            Inactif
                        </label>
                    </div>
                </div>  
        </div>
        
        <div class="modal-footer">
                
                <button class="btn btn-success" type="button" id="ajout-client-button" 
                        onclick="ecurieChevalAjout(@if($cheval){{ $cheval->id_cheval }}@endif)">
                    Valider</button>
                <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">Annuler</button>
                
        </div>
    </div>
</div>