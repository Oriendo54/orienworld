<tr class="tableau_cheval_charges" id_cheval="{{$cheval->id_cheval}}">
    <td colspan="6">
        <table class="table table-sm table-striped mt-2 mb-2">
            <thead>
                <tr>
                    <th>Libellé</th>
                    <th>Date</th>
                    <th>Périodicité</th>
                    <th>Montant</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cheval_charges as $cheval_charge)
                <tr>
                    <td>{{$cheval_charge->pofcharge->libelle}} 
                        @if($cheval_charge->precision)
                            ({{$cheval_charge->precision}})
                        @endif
                    </td>
                    @if($cheval_charge->pofcharge->periodicite == 'mensuel')
                    <td>Du {{\Carbon\Carbon::parse($cheval_charge->date_debut)->format('d-m-Y')}} au {{\Carbon\Carbon::parse($cheval_charge->date_fin)->format('d-m-Y')}}</td>
                    @else
                    <td>{{\Carbon\Carbon::parse($cheval_charge->date_facturation)->format('d-m-Y')}}</td>
                    @endif
                    <td>{{$cheval_charge->pofcharge->periodicite}}</td>
                    <td>{{ round($cheval_charge->montant, 2) }} €</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning mr-1" onclick="ecurieChargeAttribuerChevauxModal({{$cheval_charge->id_cheval_charge}})"><i class="fas fa-edit"></i></button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="ecurieSupprChevalChargeModal({{$cheval_charge->id_cheval_charge}})"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </td>
</tr>