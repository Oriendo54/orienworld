<table class="table table-sm table-striped table-bordered" id="tableauChevauxUtilisations">
    <thead>
        <tr class="text-center table-warning">
            <th class="align-middle">Nom</th>
            @for($i = 0; $i <= 10; $i++)
            <th>
                Semaine {{\Carbon\Carbon::now()->subWeeks($i)->weekOfYear}}<br/>
                <span class="font-italic font-weight-light">Du {{\Carbon\Carbon::now()->subWeeks($i)->subDays(\Carbon\Carbon::now()->dayOfWeek - 1)->format('d-m-Y')}}<br/>
                au {{\Carbon\Carbon::now()->subWeeks($i)->addDays(7 - \Carbon\Carbon::now()->dayOfWeek)->format('d-m-Y')}}</span>
                {{--<i class="fas fa-info-circle text-info ml-2"
                    title="du {{\Carbon\Carbon::now()->subWeeks($i)->subDays(\Carbon\Carbon::now()->dayOfWeek - 1)->format('d-m-Y')}} au {{\Carbon\Carbon::now()->subWeeks($i)->addDays(7 - \Carbon\Carbon::now()->dayOfWeek)->format('d-m-Y')}}"></i>--}}
            </th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @foreach($chevaux as $cheval)
        <tr>
            <th>{{$cheval->nom}}</th>
            @for($i = 0; $i <= 10; $i++)
            <td>
            {{POFStats::chevalCalculerUtilisations(
                $cheval,
                \Carbon\Carbon::now()->subWeeks($i)->subDays(\Carbon\Carbon::now()->dayOfWeek - 1)->format('Y-m-d'), 
                \Carbon\Carbon::now()->subWeeks($i)->addDays(7 - \Carbon\Carbon::now()->dayOfWeek)->format('Y-m-d')
            )}}
            </td>
            @endfor
        </tr>
        @endforeach
    </tbody>
</table>

<canvas id="graphChevauxUtilisations" height="100px" class="d-none"></canvas>