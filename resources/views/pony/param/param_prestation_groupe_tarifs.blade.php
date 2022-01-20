<tr class="ligne_prestation_groupe_tarif" id_prestation_groupe="{{ $groupe->id_prestation_groupe }}">
    <td>{{ $groupe->id_prestation_groupe }}</td>
    <td colspan="9">
        <table class="table table-sm table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Prestation</th>
                    <th>Id tarif</th>
                    <th>Libellé</th>
                    <th>Quantité</th>
                    <th colspan="2">Prix TTC</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groupe->pofprestationgroupeliens as $groupe_lien)
                    @if($groupe_lien->id_tarif_defaut)
                        <tr class="ligne_tarif" id_prestation_groupe_lien="{{ $groupe_lien->id_prestation_groupe_lien }}">
                            <td>{{ $groupe_lien->pofprestation->libelle }}</td>
                            <td>{{ $groupe_lien->id_tarif_defaut }}</td>
                            <td>{{ $groupe_lien->tarifdefaut->libelle }}</td>
                            <td>{{ $groupe_lien->tarifdefaut->quantite }}</td>
                            <td>{{ round($groupe_lien->tarifdefaut->prix_ttc,2) }}</td>
                            <td><button class="btn btn-sm btn-warning" onclick="paramPrestationGroupeTarifDefautModal({{$groupe_lien->id_prestation_groupe_lien}})"><i class="fas fa-edit"></i></button></td>
                        </tr>
                    @else
                        <tr class="ligne_tarif" id_prestation_groupe_lien="{{ $groupe_lien->id_prestation_groupe_lien }}">
                            <td>{{$groupe_lien->pofprestation->libelle }}</td>
                            <td colspan="4">
                                Sélectionnez un tarif par défaut
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="paramPrestationGroupeTarifDefautModal({{$groupe_lien->id_prestation_groupe_lien}})"><i class="fas fa-plus"></i></button>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

    </td>
</tr>

