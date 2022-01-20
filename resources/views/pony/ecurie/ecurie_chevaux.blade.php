<table class="table table-sm table-bordered table-hover">
    <thead>
        <tr class="table-warning">
            <th>Nom</th>
            <th>Type</th>
            <th>Statut</th>
            <th>Propriétaire</th>
            <th>Actif</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($chevaux as $cheval)
            <tr id_cheval="{{$cheval->id_cheval}}" class="cursor_pointer ligne_cheval">
                <td>{{$cheval->nom}}</td>
                <td>{{$cheval->pofchevaltype->libelle}}</td>
                <td>{{$cheval->pofchevalstatut->libelle}}</td>
                <td @if(!$cheval->pofclientcheval) class="table-secondary" @endif>
                    @if($cheval->pofclientcheval)
                        {{$cheval->pofclientcheval->pofclient->nom}} {{$cheval->pofclientcheval->pofclient->prenom}}
                    @endif
                </td>
                <td>
                    @if($cheval->actif) 
                    <span class="badge badge-success">Actif</span> 
                    @else 
                    <span class="badge badge-danger">Inactif</span> 
                    @endif
                </td>
                <td>
                    <button class="btn btn-sm btn-warning" type="button" 
                        onclick="ecurieChevalAjoutModal({{$cheval->id_cheval}})">
                    <i class="fas fa-edit"></i></button>

                    <button class="btn btn-sm btn-primary afficher_charges" type="button" id_cheval="{{$cheval->id_cheval}}"
                        onclick="ecurieChevalAfficherCharges({{$cheval->id_cheval}})">
                    <i class="fas fa-euro-sign"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

