<table class="table table-sm table-striped table-bordered" id="tableauChevauxBenefices">
    <thead class="table-warning">
        <tr class="text-center">
            <th rowspan="2" class="align-middle">Nom</th>
            <th rowspan="2" class="align-middle">Coût total</th>
            <th colspan="4">Bénéfices</th>
            <th rowspan="2" class="align-middle">Marge</th>
        </tr>
        <tr class="text-center">
            <th>Cours</th>
            <th>Travail</th>
            <th>Pension</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <!-- Version avec le controller -->
        @if(isset($charges_benefices))
            @foreach($charges_benefices as $charge_benefice)
            <tr>
                <th>{{$charge_benefice['nom']}}</th>
                <td>{{round($charge_benefice['charges'], 1)}}</td>
                <td>{{round($charge_benefice['cours'], 1)}}</td>
                <td>{{round($charge_benefice['travail'], 1)}}</td>
                <td>{{round($charge_benefice['pension'], 1)}}</td>
                <td>{{round($charge_benefice['benefices'], 1)}}</td>
                <td 
                    @if($charge_benefice['benefices'] - $charge_benefice['charges'] < 0)
                        class="table-danger"
                    @elseif($charge_benefice['benefices'] - $charge_benefice['charges'] > 0)
                        class="table-success"
                    @endif
                    >{{round($charge_benefice['benefices'] - $charge_benefice['charges'], 1)}}</td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>