<tr class="ligne_prestation_tarif" id_prestation="{{ $prestation->id_prestation }}">
    <td>{{ $prestation->id_prestation }}</td>
    <td colspan="9">
        
        <button class="btn btn-primary btn-sm" onclick="paramTarifAjoutModal({{ $prestation->id_prestation }})" id="">Nouveau Tarif</button>
        
        <table class="table table-sm table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Libellé</th>
                    <th>Quantité</th>
                    <th>Prix TTC</th>
                    <th>Pourcentage</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prestation->poftarifs as $tarif)

                <tr class="ligne_tarif" id_tarif="{{ $tarif->id_tarif }}">
                    <td>{{ $tarif->id_tarif }}</td>
                    <td>{{ $tarif->libelle }}</td>
                    <td>{{ $tarif->quantite }}</td>
                    <td>{{ round($tarif->prix_ttc,2) }}</td>
                    <td>{{ round($tarif->pourcentage,2) }} %</td>
                    <td>{{  \Carbon\Carbon::parse($tarif->date_debut)->format('d/m/Y') }}</td>
                    <td>{{  \Carbon\Carbon::parse($tarif->date_fin)->format('d/m/Y') }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" type="button" 
                            onclick="paramTarifAjoutModal({{ $prestation->id_prestation }},{{$tarif->id_tarif}})">
                        <i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger" type="button"
                            onclick="paramTarifSupprModal({{ $tarif->id_tarif }})">
                        <i class="fas fa-trash"></i></button>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>

    </td>
</tr>
