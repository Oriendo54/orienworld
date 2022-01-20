<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        
        <div class="modal-header">
            <h4 class="modal-title text-info" id="staticBackdropLabel">@if(!$moniteur)Nouveau @else Modifier le @endif
                moniteur</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="modal-body">
            <form>
                <div class="mb-3 d-flex flex-column">
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom" @if($moniteur)value="{{$moniteur->nom}}"@endif class="form-control ml-2 w-75" required>
                </div>

                <div class="mb-3 d-flex flex-column">
                    <label for="prenom">Prénom :</label>
                    <input type="text" name="prenom" id="prenom" @if($moniteur)value="{{$moniteur->prenom}}"@endif class="form-control ml-2 w-75" required>
                </div>

                <div class="mb-3 d-flex flex-column">
                    <label for="email">Email:</label>
                    @if(!$moniteur)
                    <input type="text" name="email" id="email" class="form-control ml-2 w-75" required/>
                    @else
                        @if($moniteur->email)
                        <input type="text" name="email" id="email" class="form-control ml-2 w-75" value="{{$moniteur->email}}" required/>
                        @else
                        <input type="text" name="email" id="email" class="form-control ml-2 w-75" required/>
                        @endif
                    @endif
                </div>

                @can('admin')
                <div class="mb-2 d-flex flex-column">
                    @if($moniteur)
                        @if($moniteur->pofuserrole)
                        <div class="d-flex mb-3">
                            <div class="ml-1">
                                <label for="moniteur_role">Rôle</label>
                                <select name="moniteur_role" id="moniteur_role" actuel_role="{{$moniteur->pofuserrole->id_role}}" class="form-control" required>
                                    <option value="{{$moniteur->pofuserrole->id_role}}" selected>{{$moniteur->pofuserrole->pofrole->libelle}}</option>
                                    @foreach($roles as $role)
                                        @if($role->id_role != $moniteur->pofuserrole->id_role)
                                        <option value="{{$role->id_role}}">{{$role->libelle}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif
                    @endif
                </div>
                @endcan

                <div class="d-flex flex-column">
                    <label for="couleur">Couleur :</label>
                    <input type="color" name="couleur" id="couleur" @if($moniteur)value="{{$moniteur->couleur}}"@endif class="form-control ml-2 w-75">
                </div>
            </form>
        </div>
        <div class="modal-footer">          
            <button class="btn btn-success" type="button" id="ajout-moniteur-button" 
                @if(!$moniteur) onclick="moniteurCreer()" 
                @else onclick="moniteurVerifierRole({{$moniteur->id_moniteur}})"
                @endif>
                Valider</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">Annuler</button>     
        </div>
    </div>
</div>
