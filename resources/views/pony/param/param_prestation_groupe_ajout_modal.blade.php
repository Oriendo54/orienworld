<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        
        <div class="modal-header">
            <h4 class="modal-title text-info" id="staticBackdropLabel">
                @if(isset($creer_groupe) && $creer_groupe)
                    Créer un groupe de prestations
                @else
                    Ajouter une prestation au groupe
                @endif
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="modal-body">

            @if(isset($creer_groupe) && $creer_groupe)
                <h5 class="mb-3">Sélectionner deux prestations à ajouter au nouveau groupe</h5>
                <label for="id_prestation1">Première prestation</label>
            @else
                <label for="id_prestation1">Choisir la prestation</label>
            @endif
                <select class="form-control mb-3" name="id_prestation1" id="id_prestation1">
                    @foreach($prestations as $prestation_a_grouper)
                    <option value="{{ $prestation_a_grouper->id_prestation }}">{{ $prestation_a_grouper->libelle }}</option>
                    @endforeach
                </select>

            @if(isset($creer_groupe) && $creer_groupe)
                <label for="id_prestation2">Deuxième prestation</label>
                <select class="form-control mb-3" name="id_prestation2" id="id_prestation2">
                    @foreach($prestations as $prestation_a_grouper)
                    <option value="{{ $prestation_a_grouper->id_prestation }}">{{ $prestation_a_grouper->libelle }}</option>
                    @endforeach
                </select>
            @endif

            <label for="groupe_libelle">Libellé du groupe :</label>
            @if(isset($creer_groupe) && $creer_groupe)
            <input type="text" id="groupe_libelle" name="groupe_libelle" class="form-control mb-2"/>
            @else
            <input type="text" id="groupe_libelle" name="groupe_libelle" class="form-control mb-2" value="{{$groupe->libelle}}"/>
            @endif

            @if(isset($erreur))
            <p id="erreur-groupe-prestation" class="text-danger font-weight-bold">{{$erreur}}</p>
            @endif
        </div>
        <div class="modal-footer">
            @if(isset($creer_groupe) && $creer_groupe)
            <button class="btn btn-success" type="button" id="ajout-prestation_groupe" 
                    onclick="paramPrestationGroupeAjout('new', null)">
                Valider</button>
            @else
            <button class="btn btn-success" type="button" id="ajout-prestation_groupe" 
                    onclick="paramPrestationGroupeAjout('update', {{$groupe->id_prestation_groupe}})">
                Valider</button>
            @endif
            <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">Annuler</button>
            
        </div>
    </div>
</div>