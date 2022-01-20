<tr class="tableau_bonachat" id_client="{{$client->id_client}}">
    <td colspan="8">
        <button type="button" class="btn btn-sm btn-primary mt-2 mb-2" onclick="clientBonachatCreerModal({{$client->id_client}})">
            Créer un bon d'achat
        </button>
        <button type="button" class="btn btn-sm btn-secondary mt-2 mb-2 ml-2" id="bons-epuises" onclick="clientBonachatsEpuises({{$client->id_client}})">
            Bons épuisés
        </button>
        <button type="button" class="btn btn-sm btn-warning mt-2 mb-2 ml-2 d-none" id="retour-bonactifs" onclick="clientBonachats({{$client->id_client}})">
            Bons actifs
        </button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Minimum</th>
                    <th>Montant</th>
                    <th>Restant</th>
                    <th>Date d'expiration</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bonachats as $bonachat)
                <tr class="ligne-bonachat" id_bonachat="{{$bonachat->id_bonachat}}">
                    <td>{{$bonachat->id_bonachat}}</td>
                    <td>{{round($bonachat->minimum, 2)}} €</td>
                    <td>{{round($bonachat->valeur, 2)}} €</td>
                    <td @if($bonachat->restant == 0) class="text-danger font-weight-bold" @endif>
                        {{round($bonachat->restant, 2)}} €
                    </td>
                    <td @if(\Carbon\Carbon::parse($bonachat->date_expiration) < \Carbon\Carbon::now()) class="text-danger font-weight-bold" @endif>
                        {{\Carbon\Carbon::parse($bonachat->date_expiration)->format('d-m-Y')}}
                    </td>
                    <td>
                        @if(count($bonachat->poffacturebonachats) > 0)
                        <button type="button" class="btn btn-sm btn-primary" onclick="clientBonachatFactures({{$bonachat->id_bonachat}})" title="Factures associées">
                            <i class="fas fa-file-invoice"></i>
                        </button>
                        @endif
                        @if(!isset($epuises))
                        <button type="button" class="btn btn-sm btn-warning" onclick="clientBonachatCreerModal({{$client->id_client}}, {{$bonachat->id_bonachat}})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="clientBonachatSupprModal({{$client->id_client}}, {{$bonachat->id_bonachat}})">
                            <i class="fas fa-trash"></i>
                        </button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </td>
</tr>