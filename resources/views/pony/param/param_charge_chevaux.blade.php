<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Libellé</th>
            <th>Périodicité</th>
            <th>Montant par défaut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($charges as $charge)
        <tr>
            <td>{{$charge->libelle}}</td>
            <td>{{$charge->periodicite}}</td>
            <td>{{round($charge->montant, 2)}} €</td>
            <td>
                <button type="button" class="btn btn-warning btn-sm mr-2" onclick="paramCreerChargeModal({{$charge->id_charge}})">
                    <i class="fas fa-edit"></i>
                </button>
                <button type="button" class="btn btn-danger btn-sm" onclick="paramSupprChargeModal({{$charge->id_charge}})">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>