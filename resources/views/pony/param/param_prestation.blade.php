<table class="table table-bordered table-striped">
    <thead>
        <tr class="table-warning">
            <th>Id</th>
            <th>Libellé</th>
            <th>TVA</th>
            <th>Type</th>
            <th>Type cours</th>
            <th>Durée</th>
            <th>Type client</th>
            <th>Age min</th>
            <th>Age max</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($prestations as $prestation)
    
        <tr class="ligne_prestation" id_prestation="{{ $prestation->id_prestation }}">
            <td>{{ $prestation->id_prestation }}</td>
            <td>{{ $prestation->libelle }}</td>
            <td>{{ round($prestation->poftva->taux,2) }} %</td>
            <td>{{ $prestation->pofprestationtype->libelle }}</td>
            <td>@if($prestation->pofcourstype){{ $prestation->pofcourstype->libelle }}@endif</td>
            <td>{{ $prestation->duree }}</td>
            <td>@if($prestation->pofclientstatut){{ $prestation->pofclientstatut->libelle }}@endif</td>
            <td>{{ $prestation->age_min_client }}</td>
            <td>{{ $prestation->age_max_client }}</td>
            <td>
                <button class="btn btn-warning" type="button" 
                    onclick="paramPrestationAjoutModal({{$prestation->id_prestation}})">
                <i class="fas fa-edit"></i></button>
                <button class="btn btn-primary paramPrestationTarif" id_prestation="{{$prestation->id_prestation}}" type="button" 
                    onclick="paramPrestationTarifButton({{$prestation->id_prestation}})">
                Tarif</button>
                <button class="btn btn-secondary paramPrestationAssociation" id_prestation="{{$prestation->id_prestation}}" type="button" 
                    onclick="paramPrestationAssociationButton({{$prestation->id_prestation}})">
                Association</button>
                <button class="btn btn-danger paramPrestationSupprimer" id_prestation="{{$prestation->id_prestation}}" type="button" 
                    onclick="paramPrestationSupprModal({{$prestation->id_prestation}})">
                <i class="fas fa-trash"></i></button></button>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

