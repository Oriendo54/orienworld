<div class="modal-dialog modal-dialog-centered" style="max-width:800px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-primary" id="staticBackdropLabel">Bon d'achat n° {{$bonachat->id_bonachat}} 
                de {{$bonachat->pofclient->nom}} {{$bonachat->pofclient->prenom}}</h4>
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
        
        <h6>Factures associées</h6>
        <table class="table table-sm table-striped table-bordered">
            <thead>
                <th>Numéro</th>
                <th>Date</th>
                <th>Libellé</th>
                <th>Total TTC</th>
                <th>Montant utilisé</th>
                <th>Statut</th>
            </thead>

            <tbody>
                @foreach($bonachat->poffacturebonachats as $facture_bonachat)
                <tr>
                    <td>{{$facture_bonachat->poffacture->id_facture}}</td>
                    <td>{{\Carbon\Carbon::parse($facture_bonachat->poffacture->date_facture)->format('d-m-Y')}}</td>
                    <td>{{$facture_bonachat->poffacture->libelle}}</td>
                    <td>{{round($facture_bonachat->poffacture->total_ttc, 2)}} €</td>
                    <td>{{round($facture_bonachat->montant, 2)}} €</td>
                    @if($facture_bonachat->poffacture->id_facture_statut == 2)
                    <td class="text-success font-weight-bold">Payée</td>
                    @else
                    <td class="text-warning font-weight-bold">À régler</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Annuler</button>
        </div>
    </div>
</div>