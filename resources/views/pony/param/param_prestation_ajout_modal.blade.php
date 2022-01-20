<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        
        <div class="modal-header">
            <h4 class="modal-title text-info" id="staticBackdropLabel">@if(!$prestation)Nouvelle @else Modification @endif
                prestation</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="modal-body">  
            
            <label for="prestation_libelle">Libellé de prestation :</label>
            <input type="text" class="form-control mb-2" name="prestation_libelle" id="prestation_libelle"
                   @if($prestation) value="{{ $prestation->libelle }}" @endif
                   />
            
            <label for="prestation_id_tva">TVA</label>
            <select class="form-control mb-2" name="prestation_id_tva" id="prestation_id_tva">
            @foreach($tvas as $tva)
                <option value="{{$tva->id_tva}}"
                        @if($prestation) @if($prestation->id_tva==$tva->id_tva) selected @endif @endif
                        >{{ round($tva->taux,2) }} %</option>
            @endforeach
            </select>
            
            <label for="prestation_id_prestation_type">Type de prestation :</label>
            <select class="form-control mb-2" name="prestation_id_prestation_type" id="prestation_id_prestation_type">
            @foreach($prestationtypes as $prestationtype)
                <option value="{{$prestationtype->id_prestation_type}}"
                        @if($prestation) @if($prestation->id_prestation_type==$prestationtype->id_prestation_type) selected @endif @endif
                        >{{$prestationtype->libelle}}</option>
            @endforeach
            </select>

            <label for="prestation_id_cours_type">Type de cours</label>
            <select class="form-control mb-2" name="prestation_id_cours_type" id="prestation_id_cours_type">
                <option value="0"
                        @if($prestation) @if($prestation->id_cours_type==0 or is_null($prestation->id_cours_type)) selected @endif @endif
                    >Pas de type de cours</option>
            @foreach($courstypes as $courstype)
                <option value="{{$courstype->id_cours_type}}"
                        @if($prestation) @if($prestation->id_cours_type==$courstype->id_cours_type) selected @endif @endif
                        >{{ $courstype->libelle }}</option>
            @endforeach
            </select>

            <label for="prestation_id_client_statut">Statut du client</label>
            <select class="form-control mb-2" name="prestation_id_client_statut" id="prestation_id_client_statut">
                <option value="0"
                        @if($prestation) @if($prestation->id_client_statut==0 or is_null($prestation->id_client_statut)) selected @endif @endif
                        >Pas de statut client</option>
            @foreach($clientstatuts as $clientstatut)
                <option value="{{$clientstatut->id_client_statut}}"
                        @if($prestation) @if($prestation->id_client_statut==$clientstatut->id_client_statut) selected @endif @endif
                        >{{ $clientstatut->libelle }}</option>
            @endforeach
            </select>
            
            <div class="d-flex">
                <div class="input-group w-50 input-group-md ml-1">
                    <label for="prestation_age_min_client">Age du min client :</label>
                </div>
                <div class="input-group w-50 input-group-md ml-1">
                    <label for="prestation_age_max_client">Age du max client :</label>
                </div>
            </div>
            <div class="d-flex">
                <div class="input-group w-50 input-group-md mb-3">
                        <input placeholder="Défaut : 0" type="text" name="prestation_age_min_client" 
                               id="prestation_age_min_client" class="form-control" required
                            @if($prestation) value="{{ $prestation->age_min_client }}" @endif
                            />
                </div>
                <div class="input-group w-50 input-group-md ml-1 mb-3">
                        <input placeholder="Défaut : 99" type="text" name="prestation_age_max_client" 
                               id="prestation_age_max_client" class="form-control" required
                            @if($prestation) value="{{ $prestation->age_max_client }}" @endif
                            />
                </div>
            </div>

            <label for="prestation_duree">Durée :</label>
            <select class="form-control mb-2" name="prestation_duree" id="prestation_duree">
                <option value="00:00:00"
                        @if($prestation) @if($prestation->duree=='00:00:00') selected @endif @endif
                        >Pas de durée</option>
                <option value="00:30:00"
                        @if($prestation) @if($prestation->duree=='00:30:00') selected @endif @endif
                        >30 min</option>
                <option value="01:00:00"
                        @if($prestation) @if($prestation->duree=='01:00:00') selected @endif @endif
                        >1h</option>
                <option value="01:30:00"
                        @if($prestation) @if($prestation->duree=='01:30:00') selected @endif @endif
                        >1h30</option>
                <option value="02:00:00"
                        @if($prestation) @if($prestation->duree=='02:00:00') selected @endif @endif
                        >2h</option>
                <option value="02:30:00"
                        @if($prestation) @if($prestation->duree=='02:30:00') selected @endif @endif
                        >2h30</option>
                <option value="03:00:00"
                        @if($prestation) @if($prestation->duree=='03:00:00') selected @endif @endif
                        >3h</option>
            </select>

        </div>
        <div class="modal-footer">
            
            <button class="btn btn-success" type="button" id="ajout-client-button" 
                    onclick="paramPrestationAjout(@if($prestation){{ $prestation->id_prestation }}@endif)">
                Valider</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">Annuler</button>
            
        </div>
    </div>
</div>
