<div id="facture" class="col">
    <div class="row">

        <div class="col">
        <button class="btn btn-sm btn-danger" onclick="factureVider(); changeDatePlanning(0)">
            <i class="fas fa-times"></i></button>
        <button class="btn btn-sm btn-success" onclick="factureAjouterSelectionTypeAjoutModal({{$client->id_client}})">Ajouter une facture</button>
        <button class="btn btn-sm btn-primary" onclick="factureLierModal({{$client->id_client}})">Lier des factures</button>
        <button class="btn btn-sm btn-secondary" id="factures_payees_button" onclick="facturePayeesButton()">Factures payées</button>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col">
            <table class="table table-sm table-bordered text-center">
                <thead>
                <tr class="text-center">
                    <th colspan="6">Factures</th>
                </tr>
                <tr class="text-center">
                    <th width="6%">Numéro</th>
                    <th width="8%">Date</th>
                    <th width="9%">Client</th>
                    <th width="9%">Montant</th>
                    <th>Libelle</th>
                    <th width="16%">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($factures as $facture)
                    @if($facture->id_facture_statut == 1)
                    <tr class="text-danger table-warning">
                    @else
                    <tr class="d-none facture_payee">
                    @endif
                        <td>{{$facture->id_facture}}</td>
                        <td>{{ \Carbon\Carbon::parse($facture->date_facture)->format('d/m/Y')}}</td>
                        <td>{{$facture->pofclient->nom}} {{$facture->pofclient->prenom}}</td>
                        <td>{{round($facture->total_ttc, 2)}} €</td>
                        <td>{{$facture->libelle}}</td>
                        <td class="text-left">

                             @if(POFFacture::factureATarif($facture->id_facture))
                                @if($facture->id_facture_statut == 1)
                                <button class="btn btn-sm btn-success" type="button"
                                    onclick="factureBonachatModal({{$facture->id_facture}})">
                                <i class="fas fa-check"></i></button>
                                <button class="btn btn-sm btn-danger" type="button"
                                    onclick="factureSupprimerModal({{$facture->id_facture}})">
                                <i class="fas fa-times"></i></button>
                                <button class="btn btn-sm btn-primary" type="button"
                                    onclick="factureModifierModal({{$facture->id_facture}})">
                                <i class="fas fa-edit"></i></button>
                                @else
                                <button class="btn btn-sm btn-warning" type="button"
                                    onclick="factureImpayerModal({{$facture->id_facture}})">
                                <i class="fas fa-times"></i></button>
                                @endif
                                @if($facture->id_facture_statut == 1 && count($facture->poffacturedetailliens)>1)
                                <button class="btn btn-sm btn-warning mt-1" type="button"
                                    onclick="factureDelierModal({{$facture->id_facture}})">
                                    <b>D</b></button>
                                @endif
                            @else
                                @if($facture->id_facture_statut == 1)
                                <button class="btn btn-sm btn-success" type="button"
                                    onclick="factureAnciennePrestationPayerModal({{$facture->id_facture}})">
                                <i class="fas fa-check"></i></button>
<!--                                <button class="btn btn-sm btn-danger" type="button"
                                    onclick="factureSansPrestationSupprimerModal({{$facture->id_facture}})">
                                <i class="fas fa-times"></i></button>
-->                             <button class="btn btn-sm btn-primary" type="button"
                                    onclick="factureAnciennePrestationModifierModal({{$facture->id_facture}})">
                                <i class="fas fa-edit"></i></button>
                                @else
                                <button class="btn btn-sm btn-warning" type="button"
                                    onclick="factureImpayerModal({{$facture->id_facture}})">
                                <i class="fas fa-times"></i></button>
                                @endif
                            @endif

                            <a class="btn btn-sm btn-secondary mt-1" href="{{ route('PDFFacture',$facture->id_facture) }}">
                            <i class="fa fa-print" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
