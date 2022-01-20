<button type="button" class="btn btn-primary mb-3" onclick="moniteurCreerModal()">Ajouter un moniteur</button>

<table class="table table-sm table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Rôle</th>
            <th>Couleur</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($moniteurs as $moniteur)
    
        <tr class="ligne_moniteur" id_moniteur="{{ $moniteur->id_moniteur }}">
            <td>{{ $moniteur->id_moniteur }}</td>
            <td>{{ $moniteur->nom }}</td>
            <td>{{ $moniteur->prenom }} </td>
            <td>
                @if($moniteur->pofuserrole)
                {{ $moniteur->pofuserrole->pofrole->libelle }}
                @else 
                <span class="text-danger font-weight-bold">non inscrit</span>
                @endif
            </td>
            <td>
                <form>
                    <div class="input-group">
                        <input type="color" class="form-control w-50" name="couleur_moniteur" id="{{'couleur_moniteur'.$moniteur->id_moniteur}}" value="{{$moniteur->couleur}}">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-sm btn-success" onclick="moniteurChangerCouleur({{$moniteur->id_moniteur}})"><i class="fas fa-check"></i></button>
                        </div>
                    </div>
                </form>
            </td>
            <td>
                <button class="btn btn-sm btn-warning ml-2" type="button" 
                    onclick="moniteurCreerModal({{$moniteur->id_moniteur}})">
                <i class="fas fa-edit"></i></button>
                <button class="btn btn-sm btn-danger paramMoniteurSupprimer" id_moniteur="{{$moniteur->id_moniteur}}" type="button" 
                    onclick="moniteurSupprModal({{$moniteur->id_moniteur}})">
                <i class="fas fa-trash"></i></button>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

