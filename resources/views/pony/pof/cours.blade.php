<div id="display-selection-planning" class="col">
</div>
<div id="display-planning-cours" class="col-8">
</div>

<div id="facture" class="col">
    <div class="row">

        <div class="col">
            <button class="btn btn-sm btn-danger" onclick="factureVider(); changeDatePlanning(0)">
                <i class="fas fa-times"></i></button>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col">
            <table class="mt-3 mb-3 table table-sm table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type de cours</th>
                        <th>Durée</th>
                        <th>Cheval</th>
                        <th>Validé</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($listecours as $cours)
                    <tr class="cursor_pointer" id="lccd-{{$cours->id_cours}}" 
                            onclick="selectionDatePlanning('{{$cours->date_cours}}'); 
                                getPlanning('{{$cours->date_cours}}'); 
                                afficherCoursDetails({{$cours->id_cours}})">
                        <td>
                            {{ POFDate::dateJourdelasemaine($cours->date_cours) }}
                            {{ $cours->date_cours }} 
                            {{ \Carbon\Carbon::parse($cours->heure_debut)->format('H:i') }}
                        </td>
                        <td>{{ $cours->pofcourstype->libelle }}</td>
                        <td>{{ POFCours::dureeCours($cours->id_cours) }}</td>
                        <td>
                            @if(POFCours::coursClientGetCheval($cours, $client))
                                {{ POFCours::coursClientGetCheval($cours, $client)->nom }}
                            @else
                            Pas de monture
                            @endif
                        </td>
                        <td>
                            @if(POFCours::getCoursClient($cours, $client)->id_cours_client_statut == 2)
                            <span class="text-success ml-2 mb-1 font-weight-bold">Validé</span>
                            <button class="btn btn-sm ml-2 h-50 btn-danger" onclick="invaliderCours({{$client->id_client}}, {{$cours->id_cours}})">
                                <i class="fas fa-times"></i></button>
                            @else
                                @if(POFCours::coursClientGetCheval($cours, $client))
                                A valider
                                <button class="btn btn-sm ml-2 h-50 btn-success" type="button" onclick="validerCours({{$client->id_client}}, {{$cours->id_cours}})">
                                    <i class="fas fa-check"></i></button>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
                
                </tbody>
            </table>
        </div>
    </div>
</div>