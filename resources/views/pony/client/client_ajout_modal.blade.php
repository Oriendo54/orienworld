<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-info" id="staticBackdropLabel">@if(!$client) Nouveau client @else Modifier le client @endif</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="d-flex">
                <div class="input-group w-50 input-group-md ml-1 mb-3">
                    <input placeholder="Nom" type="text" name="client_nom" id="client_nom" class="form-control" required
                           @if($client) value="{{ $client->nom }}" @endif
                           />
                </div>
                <div class="input-group w-50 input-group-md ml-1 mb-3">
                    <input placeholder="Prénom" type="text" name="client_prenom" id="client_prenom" class="form-control" required
                           @if($client) value="{{ $client->prenom }}" @endif
                           />
                </div>
            </div>
            <div class="w-50 ml-1 mb-3">
                <label for="client_date_naissance">Date de naissance :</label>
                <input type="date" placeholder="Date de naissance" name="client_date_naissance" id="client_date_naissance" class="form-control" required
                           @if($client) value="{{ $client->date_naissance }}" @endif
                           />
            </div>
            <div class="d-flex">
                <div class="input-group w-50 input-group-md ml-1 mb-3">
                    <input placeholder="Email" type="email" name="client_email" id="client_email" class="form-control" required
                           @if($client) value="{{ $client->email }}" @endif
                           />
                </div>
                @if(!$client)
                <div class="input-group w-50 input-group-md ml-1 mb-3">
                    <input placeholder="Telephone" type="text" name="client_telephone" id="client_telephone" class="form-control" required/>
                </div>
                @endif
            </div>

            @if(!$client)
            <div class="input-group w-50 input-group-md ml-1 mb-3">
                <input placeholder="Adresse" type="text" name="client_rue" id="client_rue" class="form-control" required/>
            </div>
            <div class="d-flex mb-3">
                <div class="w-50 ml-1">
                    <input type="text" placeholder="Code Postal" name="client_code_postal" id="client_code_postal" class="form-control" required/>
                </div>
                <div class="w-50 ml-1">
                    <input type="text" placeholder="Ville" class="form-control" name="client_ville" id="client_ville" required/>
                </div>
            </div>
            @endif

            <div class="d-flex mb-3">
                <div class="ml-1">
                    <label for="client_id_niveau_client">Niveau</label>
                    <select name="client_id_niveau_client" id="client_id_niveau_client" class="form-control" required>
                        @foreach($niveaux as $niveau)
                            <option value="{{$niveau->id_client_niveau}}">{{$niveau->libelle}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="d-flex mb-3">
                <div class="ml-1">
                    <label for="client_id_client_statut">Statut</label>
                    <select name="client_id_client_statut" id="client_id_client_statut" class="form-control" required>
                        @foreach($clientstatuts as $clientstatut)
                            <option value="{{$clientstatut->id_client_statut}}" 
                                    @if($client)
                                    @if($client->id_client_statut == $clientstatut->id_client_statut)
                                    selected
                                    @endif
                                    @endif
                                    >{{$clientstatut->libelle}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @can('admin')
                @if($client)
                    @if($client->pofuserrole)
                    <div class="d-flex mb-3">
                        <div class="ml-1">
                            <label for="client_role">Rôle</label>
                            <select name="client_role" id="client_role" actuel_role="{{$client->pofuserrole->id_role}}" class="form-control" required>
                                <option value="{{$client->pofuserrole->id_role}}" selected>{{$client->pofuserrole->pofrole->libelle}}</option>
                                @foreach($roles as $role)
                                    @if($role->id_role != $client->pofuserrole->id_role)
                                    <option value="{{$role->id_role}}">{{$role->libelle}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                @endif
            @endcan
        </div>
        <div class="modal-footer">
            <button class="btn btn-success" type="button" id="ajout-client-button" @if(!$client) onclick="clientAjout()" @else onclick="clientVerifierRole({{$client->id_client}})" @endif>
                Valider</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">Annuler</button> 
        </div>
    </div>
</div>