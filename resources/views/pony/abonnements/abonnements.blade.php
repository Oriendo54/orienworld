<table class="table table-sm table-bordered text-center">
    <thead>
        <tr class="text-center">
            <th>Abonnement</th>
            <th>Echeance</th>
            <th>Montant</th>
        </tr>
    </thead>
    <tbody>
    @if($client->pofabonnementclient)
        @foreach($client->pofabonnementclient as $abonnement)
            <tr>
                <td>
                <button class="btn btn-info btn-sm mr-2" onclick="abonnementGetDetails({{$abonnement->pofabonnement->id_abonnement}})">?</button>
                    {{$abonnement->pofabonnement->libelle}}
                </td>
                <td>{{ \Carbon\Carbon::parse($abonnement->echeance)->format('d-m-Y') }}</td>
                <td>{{$abonnement->pofabonnement->total_ttc}} €</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>