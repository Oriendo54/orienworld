<table class="table table-bordered table-striped table-hover pony-table">
    <thead>
        <tr class="table-warning">
            <th>Id</th>
            <th>Libelle</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($client_cheval_statuts as $client_cheval_statut)
            <tr class="ligne_client_cheval_statut" id_client_cheval_statut="{{$client_cheval_statut->id_client_cheval_statut}}" class="cursor_pointer">
                <td>{{$client_cheval_statut->id_client_cheval_statut}}</td>
                <td>{{$client_cheval_statut->libelle}}</td>
                <td>
                    <button class="btn btn-warning" type="button" 
                        onclick="ecurieClientChevalStatutAjoutModal({{$client_cheval_statut->id_client_cheval_statut}})">
                    <i class="fas fa-edit"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

