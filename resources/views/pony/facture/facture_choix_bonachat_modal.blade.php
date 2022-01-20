<div class="modal-dialog modal-dialog-centered" style="max-width:800px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-danger" id="staticBackdropLabel">Payer la facture</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <p class="h5">Souhaitez-vous utiliser un bon d'achat ?</p>
            <p class="h6">
                Total : {{round($facture->total_ttc,2)}} € TTC
            </p>
            @if($facture->total_ttc > $facture->total_bonachat_deduis)
            <p class="h6 mt-2 text-danger">
                Reste à payer : {{round($facture->total_bonachat_deduis, 2)}} € TTC
            </p>
            @endif
            <form>
                <table class="table table-sm table-striped mt-2">
                    <thead>
                        <tr>
                            <th>Valeur</th>
                            <th>Restant</th>
                            <th>Expire le</th>
                            <th></th>
                        </tr>
                    </thead>
                @foreach($bonachats as $bonachat)
                    <tr>
                        <td>{{round($bonachat->valeur, 2)}} €</td>
                        <td>{{round($bonachat->restant, 2)}} €</td>
                        <td>{{ \Carbon\Carbon::parse($bonachat->date_expiration)->format('d-m-Y') }}</td>
                        <td>
                            <div class="input-group mr-2 w-75">
                            @if($bonachat->restant > 0)
                                <input class="form-control" type="number" id="{{'utiliser_bonachat_'.$bonachat->id_bonachat}}" 
                                    name="{{'utiliser_bonachat_'.$bonachat->id_bonachat}}" min="0" max="{{$bonachat->restant}}"
                                    value="{{ POFFacture::factureBonachatMontantUtilise($facture->id_facture, $bonachat->id_bonachat) }}"/>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-sm btn-success" onclick="factureBonachatUtiliser({{$facture->id_facture}}, {{$bonachat->id_bonachat}}, false)">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                                <button type="button" class="btn btn-sm btn-primary ml-2" id="{{'utiliser_bonachat_complet_'.$bonachat->id_bonachat}}"
                                    restant="{{$bonachat->restant + POFFacture::factureBonachatMontantUtilise($facture->id_facture, $bonachat->id_bonachat)}}" 
                                    onclick="factureBonachatUtiliser({{$facture->id_facture}}, {{$bonachat->id_bonachat}}, true)">
                                    Totalité
                                </button>
                            @endif
                            
                            @if(POFFacture::factureBonachatMontantUtilise($facture->id_facture, $bonachat->id_bonachat) > 0)
                                <button type="button" class="btn btn-sm btn-danger ml-2" 
                                    onclick="factureBonachatAnnuler({{$facture->id_facture}}, {{$bonachat->id_bonachat}})">
                                    <i class="fas fa-times"></i>
                                </button>
                            @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </table>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success" type="button" id="delete-element" onclick="facturePayerModal({{ $facture->id_facture }})">
                Payer</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Annuler</button>
        </div>
    </div>
</div>