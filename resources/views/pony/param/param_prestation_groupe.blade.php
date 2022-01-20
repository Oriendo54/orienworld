<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom du groupe</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($groupes as $groupe)
    
        <tr class="ligne_groupe" id_prestation_groupe="{{ $groupe->id_prestation_groupe }}">
            <td>{{ $groupe->id_prestation_groupe }}</td>
            <td>{{ $groupe->libelle }}</td>
            <td>
                <button class="btn btn-secondary paramPrestationGroupe" id_prestation_groupe="{{$groupe->id_prestation_groupe}}" type="button" 
                    onclick="paramPrestationGroupeButton({{$groupe->id_prestation_groupe}})">
                Groupe</button>
                <button class="btn btn-primary paramPrestationGroupeTarif" id_prestation_groupe="{{$groupe->id_prestation_groupe}}" type="button" 
                    onclick="paramPrestationGroupeTarifButton({{$groupe->id_prestation_groupe}})">
                Tarifs</button>
                <button class="btn btn-danger" 
                    onclick="paramPrestationSupprGroupeModal({{$groupe->id_prestation_groupe}})">
                <i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

