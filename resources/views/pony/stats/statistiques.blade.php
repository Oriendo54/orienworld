@extends('pony.template_pony')

@section('content')
    <div id="links"
        chevalChargesBenefices="{{ route('chevalChargesBenefices') }}"></div>

    <div class="d-flex mb-3">
        <h2>Utilisation des chevaux</h2>
    </div>

    <div id="stats-chevaux">
        @include('pony.stats.stats_chevaux', ['chevaux' => $chevaux])
    </div>

    <div class="d-flex mt-4 mb-3">
        <h2>Charges et bénéfices</h2>
    </div>

    <div id="benefices-chevaux">
        <div id="parametres_benefices_chevaux" class="mb-3 row">
            <div class="col-3 d-flex justify-content-around">
                <button type="button" class="btn btn-primary" onclick="beneficesAjusterChoixDates('{{\Carbon\Carbon::now()->startOfMonth()->format('Y-m-d')}}', '{{\Carbon\Carbon::now()->endOfMonth()->format('Y-m-d')}}')">Ce mois-ci</button>

                <button type="button" class="btn btn-primary" onclick="beneficesAjusterChoixDates('{{\Carbon\Carbon::now()->startOfYear()->format('Y-m-d')}}', '{{\Carbon\Carbon::now()->endOfYear()->format('Y-m-d')}}')">Cette année</button>
            </div>
            <div class="col-9 d-flex">
                <div class="input-group mr-3 d-flex align-items-center">
                    <label for="benefices_date_debut" class="mr-2">Du</label>
                    <input type="date" id="benefices_date_debut" name="benefices_date_debut" class="form-control" 
                        value="{{\Carbon\Carbon::now()->startOfMonth()->format('Y-m-d')}}"/>
                </div>
                <div class="input-group mr-2 d-flex align-items-center">
                    <label for="benefices_date_fin" class="mr-2">Au</label>
                    <input type="date" id="benefices_date_fin" name="benefices_date_fin" class="form-control" 
                        value="{{\Carbon\Carbon::now()->endOfMonth()->format('Y-m-d')}}"/>
                </div>
                <button type="button" class="btn-sm btn-success" onclick="chevalChargesBenefices()"><i class="fas fa-check"></i></button>
            </div>
        </div>
        <div id="benefices_chevaux_tableau">
            @include('pony.stats.benefices_chevaux', ['chevaux' => $chevaux])
        </div>
    </div>

@endsection

@section('scriptjs')
    <script type="text/javascript" type="module" src="{{ URL::asset('js/pof/stats.js') }}"></script>
@endsection