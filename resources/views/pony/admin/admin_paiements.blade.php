<button type="button" class="btn btn-primary mb-3" onclick="moyenPaiementCreerModal()">Ajouter un moyen de paiement</button>

<table class="table table-sm table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Libelle</th>
            <th>Actif</th>
        </tr>
    </thead>
    <tbody>
        @foreach($moyens_paiement as $moyen_paiement)
    
        <tr class="ligne_moyen_paiement" id_moyen_paiement="{{ $moyen_paiement->id_moyen_paiement }}">
            <td>{{ $moyen_paiement->id_moyen_paiement }}</td>
            <td>{{ $moyen_paiement->libelle }}</td>
            <td>
                <button class="btn btn-sm @if($moyen_paiement->actif == 1) btn-success @else btn-danger @endif" id_moyen_paiement="{{$moyen_paiement->id_moyen_paiement}}" type="button" 
                    onclick="moyenPaiementActiver({{$moyen_paiement->id_moyen_paiement}})">
                @if($moyen_paiement->actif == 1)
                <i class="fas fa-check"></i>
                @else
                <i class="fas fa-ban"></i>
                @endif</button>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>