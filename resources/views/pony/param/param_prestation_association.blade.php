<tr class="ligne_prestation_association" id_prestation="{{ $prestation->id_prestation }}">
    <td>{{ $prestation->id_prestation }}</td>
    <td colspan="9">
        
        <button class="btn btn-primary btn-sm" onclick="paramPrestationAssociationAjoutModal({{ $prestation->id_prestation }})" id="">
            Associer avec une autre prestation</button>
        
        @if($prestation->pofprestationassociationlien)
        
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
                @foreach($prestation->pofprestationassociationlien->pofprestationassociation->pofprestationassociationliensecondaires 
                    as $prestationassociationprestationsecondaires)

                <tr>
                    <td>{{ $prestationassociationprestationsecondaires->id_prestation_association_lien }}</td> 
                    <td>{{ $prestationassociationprestationsecondaires->pofprestation->id_prestation }}</td> 
                    <td>{{ $prestationassociationprestationsecondaires->pofprestation->libelle }}</td> 
                    <td>
                        <button class="btn btn-sm btn-danger" type="button" 
                            onclick="paramPrestationAssociationSupprModal({{ $prestationassociationprestationsecondaires->id_prestation_association_lien }})">
                        <i class="fas fa-times"></i></button>
                    </td> 
                </tr>

                @endforeach
            </tbody>
        </table>
        
        @endif

    </td>
</tr>
