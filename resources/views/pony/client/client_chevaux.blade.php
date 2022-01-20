<tr class="ligne_client_cheval" id_client="{{ $client->id_client }}">
    <td>{{ $client->id_client }}</td>
    <td colspan="6">
        
        <button class="btn btn-primary btn-sm" onclick="clientChevalAjoutModal({{ $client->id_client }})" id="">
            Nouveau cheval pour {{ $client->nom }} {{ $client->prenom }}</button>
        
        <table class="table table-sm table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($client->pofclientchevaux as $client_cheval)

                <tr>
                    <td>{{ $client_cheval->pofcheval->id_cheval }}</td>
                    <td>{{ $client_cheval->pofcheval->nom }}</td>
                    <td>{{ $client_cheval->pofclientchevalstatut->libelle }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" type="button" 
                            onclick="clientChevalAjoutModal({{ $client->id_client }},{{$client_cheval->id_client_cheval}})">
                        <i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger" type="button" 
                            onclick="clientChevalSupprModal({{$client_cheval->id_client_cheval}})">
                        <i class="fas fa-times"></i></button>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>

    </td>
</tr>
