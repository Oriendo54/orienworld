<div class="modal-dialog modal-dialog-centered" style="max-width:900px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-primary" id="staticBackdropLabel">Lier des factures de {{$client->nom}} {{$client->prenom}}</h4>
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            
            
            <table class="table table-sm table-bordered text-center">
                <thead>
                <tr class="text-center">
                    <th colspan="6">Factures</th>
                </tr>
                <tr class="text-center">
                    <th>Numéro</th>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Montant</th>
                    <th>Libelle</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($factures as $facture)
                    @if($facture->id_facture_statut == 1)
                    <tr class="text-danger table-warning">
                    @else 
                    <tr class="">
                    @endif
                        <td>{{$facture->id_facture}}</td>
                        <td>{{$facture->created_at->format('d-m-Y')}}</td>
                        <td>{{$facture->pofclient->nom}} {{$facture->pofclient->prenom}}</td>
                        <td>{{round($facture->total_ttc, 2)}} €</td>
                        <td>{{$facture->libelle}}</td>
                        <td class="text-left">
                            <div class="form-check">
                                <input class="form-check-input" name="facture_lier" type="checkbox" value="{{$facture->id_facture}}">
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
        <div class="modal-footer">
            <button class="btn btn-success" type="button" onclick="factureLier({{$client->id_client}})">
                Valider le lien</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Annuler</button>
        </div>
    </div>
</div>