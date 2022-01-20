@extends('pony.template_pony')

@section('content')
    <div id="links"
        coursAjouterModal="{{ route('coursAjouterModal') }}"
        coursAjouter="{{ route('coursAjouter') }}"
        coursSuppressionModal="{{ route('coursSuppressionModal') }}"
        coursSuppression="{{ route('coursSuppression') }}"
        pofNettoyerLogs="{{ route('pofNettoyerLogs') }}"
        pofViderLogs="{{ route('pofViderLogs') }}">
    </div>

    {{--
    <h3>Superpositions de cours</h3>
    
    <table class="table table-striped table-bordered pony-table mt-3">
        <thead>
            <tr>
                <th>Id</th>
                <th>Type</th>
                <th>Date</th>
                <th>Heure de début</th>
                <th>Durée</th>
                <th>Moniteur</th>
                <th>Emplacement</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cours_superposes as $cours)
                <tr id_cours="{{$cours->id_cours}}">
                    <td>{{ $cours->id_cours }}</td>
                    <td>{{ $cours->pofcourstype->libelle }}</td>
                    <td>{{ \Carbon\Carbon::parse($cours->date_cours)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($cours->heure_debut)->format('H:i') }}</td>
                    <td>{{ POFCours::dureeCours($cours->id_cours) }}</td>
                    <td>{{ $cours->pofmoniteur->prenom }}</td>
                    <td>{{ $cours->pofcoursemplacement->libelle }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning ml-1" type="button" onclick="coursAjouterModal(null,{{$cours->id_cours}})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger ml-1" type="button" onclick="coursSuppressionModal({{$cours->id_cours}})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    --}}

    <div class="d-flex justify-content-between">
        <h3 class="mt-4 mb-3">Logs</h3>
        <div class="d-flex justify-content-around align-items-center">
            <button class="btn btn-warning mr-2" onclick="pofNettoyerLogs()">Nettoyer</button>
            <button class="btn btn-danger" onclick="pofViderLogs()">Vider les logs</button>
        </div>
    </div>

    <table class="table table-striped table-bordered pony-table mt-3">
        <thead>
            <th>Date</th>
            <th>Catégorie</th>
            <th>Log</th>
        </thead>
        @if(isset($logs))
        <tbody>
            @foreach($logs as $log)
                @if($log->couleur && $log->couleur != '')
                <tr style="{{'background-color:'.$log->couleur}}">
                @else
                <tr>
                @endif
                    <td>{{\Carbon\Carbon::parse($log->created_at)->format('d-m-Y H:i:s')}}</td>
                    <td>{{$log->category}}</td>
                    <td>{{$log->message}}</td>
                </tr>
            @endforeach
        </tbody>
        @endif
    </table>
@endsection

@section('scriptjs')
    <script type="text/javascript" src="{{ URL::asset('js/pof/erreurs.js') }}"></script>
@endsection