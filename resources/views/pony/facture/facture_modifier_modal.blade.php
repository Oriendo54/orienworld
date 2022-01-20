<div class="modal-dialog modal-dialog-centered" style="max-width:900px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-primary" id="staticBackdropLabel">Modifier la facture {{ $facture->id_facture }}</h4>
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            
            <p><b>Client : {{$facture->pofclient->nom}} {{$facture->pofclient->prenom}}</b></p>
            <p><b>Date création : {{$facture->created_at->format('d-m-Y H:i:s')}}</b></p>
            <p><b>Date modification : {{$facture->updated_at->format('d-m-Y H:i:s')}}</b></p>
            <p><b>Total TTC : {{round($facture->total_ttc,2)}}€</b></p>
            
            <table class="table table-sm table-bordered text-center">
                <thead>
                <tr class="text-center">
                    <th>Numéro</td>
                    <th>Libelle</td>
                    <th>Montant</td>
                    <th>% TVA</td>
                </tr>
                </thead>
                <tbody>
                    @foreach($facture->poffacturedetails as $facturedetail) 
                    <tr class="facturedetail" id_facture_detail="{{$facturedetail->id_facture_detail}}">
                        <td>{{$facturedetail->id_facture_detail}}</td>
                        <td>
                            @if($facturedetail->pofprestation->pofprestationassociationliensecondaire)
                            {{$facturedetail->pofprestation->libelle}}
                            @else
                            <input type="text" class="form-control" id="facturedetail_libelle_{{$facturedetail->id_facture_detail}}" 
                                   aria-describedby="facturedetail_libelle" 
                                   placeholder="Libellé"
                                value="{{$facturedetail->libelle}}">
                            @endif
                        </td>
                        <td>
                            @if(!$facturedetail->id_facture_detail_pere)
                            {{round($facturedetail->total_ttc,2)}} €
                            
                            @php
                            $total_ttc = $facturedetail->total_ttc
                            @endphp
                            
                            @if($facturedetail->poffacturedetailenfant)
                            @php $total_ttc += $facturedetail->poffacturedetailenfant->total_ttc @endphp
                            @endif
                            
                            <input type="text" class="form-control" id="facturedetail_total_ttc_{{$facturedetail->id_facture_detail}}" 
                                   aria-describedby="facturedetail_total_ttc" 
                                   placeholder="TTC"
                                value="{{round($total_ttc,2)}}">
                            @else
                            {{round($facturedetail->total_ttc,2)}} €
                            @endif
                        </td>
                        <td>{{round($facturedetail->pofprestation->poftva->taux,2)}}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" onclick="factureModifier({{ $facture->id_facture }},{{ $facture->id_client }})">
                Enregistrer</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Annuler</button>
        </div>
    </div>
</div>