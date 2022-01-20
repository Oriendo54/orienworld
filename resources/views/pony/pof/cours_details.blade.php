<div id_cours="{{$cours->id_cours}}" id="titre-cours-details" class="mb-3 d-flex justify-content-between">
    <div>
        <h4 id="display-infos-cours">
            <br>{{POFDate::dateJourdelasemaineComplet($cours->date_cours)}} {{\Carbon\Carbon::parse($cours->date_cours)->format('d-m-Y')}}
            <br>{{\Carbon\Carbon::parse($cours->heure_debut)->format('H:i')}} - {{\Carbon\Carbon::parse($cours->heure_fin)->format('H:i')}}
            @if($cours->libelle != '')<br>{{$cours->libelle}}@endif {{'('.$cours->pofcourstype->libelle.')'}}
        </h4>
        <h4>
            {{$cours->pofmoniteur->prenom}} {{$cours->pofmoniteur->nom}} - {{$cours->pofcoursemplacement->libelle}}
        </h4>
    </div>
    <div class="ml-2 mr-2">
        <button class="btn btn-warning" type="button" onclick="coursAjouterModal(null,{{$cours->id_cours}})"><i class="fas fa-edit"></i></button>
        <button class="btn btn-danger" type="button" onclick="coursSuppressionModal({{$cours->id_cours}})"><i class="fas fa-trash-alt"></i></button>
    </div>
</div>

<input class="form-control" list="datalistOptions" id="recherche_cavalier" placeholder="rechercher un cavalier">
<div class="invalid-feedback">3 lettres minimum</div>
<datalist id="datalistOptions">

    @foreach($clients as $client)

    <option value="{{ $client->id_client }}# {{ $client->nom }} {{ $client->prenom }}">

    @endforeach

</datalist>

@if($cavaliers)

    <table class="table">
        <tbody>
        
        @foreach($cavaliers as $cavalier)
        <tr>
            <td class="font-weight-bold mb-1 cursor_pointer" onclick="afficherClientDetails({{$cavalier->id_client}})">
                {{$cavalier->pofclient->nom}} {{$cavalier->pofclient->prenom}}
            </td>

            <td class="text-primary ml-1 mb-1 font-weight-bold cursor_pointer" onclick="choixMontureModal({{$cavalier->id_client}}, {{$cours->id_cours}})">
            @if(!$cavalier->pofcheval or $cavalier->id_cheval == 0)
            Pas de monture
            @else 
            {{$cavalier->pofcheval->nom}}
            @endif
            </td>

            <td>
                
            @if($cavalier->id_cours_client_statut == 1)
            
                @if(isset($cavalier->id_cheval))
                <button class="btn btn-sm ml-2 h-50 btn-success" type="button" onclick="validerCours({{$cavalier->id_client}}, {{$cours->id_cours}})">
                    <i class="fas fa-check"></i></button>
                @endif
                <button class="btn btn-sm ml-2 h-50 btn-danger" onclick="retirerCavalier({{$cavalier->id_client}}, {{$cours->id_cours}})">
                    <i class="fas fa-times"></i></button>

                @elseif($cavalier->id_cours_client_statut == 2)

                <span class="text-success ml-2 mb-1 font-weight-bold">Validé</span>
                <button class="btn btn-sm ml-2 h-50 btn-danger" onclick="invaliderCours({{$cavalier->id_client}}, {{$cours->id_cours}})">
                    <i class="fas fa-times"></i></button>
                    
            @endif
            
            <button class="btn btn-sm h-50 btn-primary" onclick="coursReinscrireModal({{$cavalier->id_cours}},{{$cavalier->id_client}},
                    {{$cavalier->id_cours_client}})">
                R</button>
                
            </td>
        </tr>
        @endforeach
        
        </tbody>
    </table>
@endif

<script>

    $('#recherche_cavalier').on('keyup', function(e) {
        e.preventDefault;
        if(e.keyCode == 13) {
            if($(this).val() != '' && $(this).val().length > 2) {
                $(this).removeClass('is-invalid');
                rechercherCavalier($(this).val());
            }
            else {
                $(this).addClass('is-invalid');
            }
        }
    });

</script>