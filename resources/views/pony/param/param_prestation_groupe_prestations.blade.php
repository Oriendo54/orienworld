<tr class="ligne_prestation_groupe" id_prestation_groupe="{{ $groupe->id_prestation_groupe }}">
    <td>{{ $groupe->id_prestation_groupe }}</td>
    <td colspan="9">
        
        <button class="btn btn-primary btn-sm" onclick="paramPrestationGroupeAjoutModal({{ $groupe->id_prestation_groupe }})">
            Ajouter une prestation au groupe</button>
        
        @if($groupe->pofprestationgroupeliens)
        
        <table class="table table-sm table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Id prestation</th>
                    <th>Libelle</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groupe->pofprestationgroupeliens as $prestation_groupe_lien)

                <tr>
                    <td>{{ $prestation_groupe_lien->id_prestation_groupe_lien }}</td> 
                    <td>{{ $prestation_groupe_lien->pofprestation->id_prestation }}</td> 
                    <td>{{ $prestation_groupe_lien->pofprestation->libelle }}</td> 
                    <td>
                        <button class="btn btn-sm btn-danger" type="button" 
                            onclick="paramPrestationGroupeSupprPrestation({{ $groupe->id_prestation_groupe }}, {{$prestation_groupe_lien->pofprestation->id_prestation}})">
                        <i class="fas fa-times"></i></button>
                    </td> 
                </tr>

                @endforeach
            </tbody>
        </table>
        
        @endif

    </td>
</tr>
