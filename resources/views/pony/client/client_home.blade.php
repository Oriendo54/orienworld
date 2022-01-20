@extends('template')

@section('content')
<div class="d-flex justify-content-center mb-3">
    <img src="{{ asset('img/logo_pony.png') }}" alt="logo_pony" width="25%"/>
</div>
<div class="row">
    <div class="col-6">
        <h6 class="mb-3">Vos cours</h6>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Durée</th>
                    <th>Lieu</th>
                    <th>Cheval</th>
                </tr>
            </thead>
            <tbody>
                @foreach(POFCours::clientCours($client) as $cours)
                <tr class="ligne-cours">
                    <td>{{\Carbon\Carbon::parse($cours->date_cours)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($cours->heure_debut)->format('H:i')}}</td>
                    <td>{{POFCours::dureeCours($cours->id_cours)}}</td>
                    <td>{{$cours->pofcoursemplacement->libelle}}</td>
                    <td>
                        @if(POFCours::coursClientGetCheval($cours, $client))
                        {{ POFCours::coursClientGetCheval($cours, $client)->nom }}
                        @else
                        Pas de monture
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if(count($enfants) > 0)
            @foreach($enfants as $enfant)
            <h6 class="mb-3">Cours de {{$enfant->prenom}}</h6>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Durée</th>
                        <th>Lieu</th>
                        <th>Cheval</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(POFCours::clientCours($enfant) as $cours)
                    <tr class="ligne-cours-enfant">
                        <td>{{\Carbon\Carbon::parse($cours->date_cours)->format('d-m-Y')}}</td>
                        <td>{{\Carbon\Carbon::parse($cours->heure_debut)->format('H:i')}}</td>
                        <td>{{POFCours::dureeCours($cours->id_cours)}}</td>
                        <td>{{$cours->pofcoursemplacement->libelle}}</td>
                        <td>
                            @if(POFCours::coursClientGetCheval($cours, $enfant))
                            {{ POFCours::coursClientGetCheval($cours, $enfant)->nom }}
                            @else
                            Pas de monture
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endforeach
        @endif
    </div>

    <div class="col-6">
        <h6 class="mb-3">Vos cartes</h6>

        @if(count($client->pofcartes) > 0)
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Prestation</th>
                    <th>Solde</th>
                </tr>
            </thead>
            <tbody>
                @foreach($client->pofcartes as $carte)
                <tr class="ligne-carte">
                    <td>{{$carte->pofprestation->libelle}}</td>
                    <td @if($carte->solde < 0) class="text-danger font-weight-bold" @endif)>{{round($carte->solde)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Vous n'avez aucune carte de cours à disposition.</p>
        @endif
    </div>
</div>
@endsection

@section('scriptjs')
@endsection