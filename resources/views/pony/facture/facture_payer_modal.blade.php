<div class="modal-dialog modal-dialog-centered" style="max-width:600px;">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title text-danger" id="staticBackdropLabel">Payer la facture</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <p>Payer la facture {{ $facture->id_facture }} ?</p>
            
            <div class="d-flex justify-content-between">
                <div>
                    <div class="d-flex justify-content-between ml-1 mr-1">
                        <p>Restant à payer : {{ round($facture->total_bonachat_deduis, 2) }} €</p>
                    </div>
                </div>

                <div>
                    @if($facture->total_ttc != $facture->total_bonachat_deduis)
                    <div class="d-flex justify-content-between ml-1 mr-1">
                        <p>Total facture : {{ round($facture->total_ttc, 2) }} € TTC</p>
                    </div>
                    @endif

                    <div class="d-flex justify-content-between ml-1 mr-1" style="color:red">
                        <p class="h6 d-none" id="restant_a_renseigner">Restant à renseigner : 
                            {{ POFFacture::factureResteARenseigner($facture->id_facture) }} €</p>
                    </div>
                </div>
            </div>
            
            @foreach($moyens_paiement as $moyen_paiement)
                @if($moyen_paiement->actif === 1)
                    <div class="input-group d-flex flex-column mb-3">
                        <label for="paiement-cb" class="mt-3">{{$moyen_paiement->libelle}} :</label>
                        <div class="d-flex">
                            <input class="form-control paiement-input" type="number" id_moyen_paiement="{{$moyen_paiement->id_moyen_paiement}}"
                                id="{{'paiement-'.$moyen_paiement->id_moyen_paiement}}" name="{{'paiement-'.$moyen_paiement->id_moyen_paiement}}" 
                                value="{{ POFFacture::factureMoyenPaiementMontant($facture->id_facture, $moyen_paiement->id_moyen_paiement) }}" 
                                min="0" max="{{$facture->total_bonachat_deduis}}" autocomplete="off"/>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary ml-2" 
                                        onclick="factureSetPaiementMode({{ $facture->id_facture }}, {{$moyen_paiement->id_moyen_paiement}}, 'totally')">Intégralité</button>
                                <button type="button" class="btn btn-secondary ml-2" 
                                        onclick="factureSetPaiementMode({{ $facture->id_facture }}, {{$moyen_paiement->id_moyen_paiement}}, 'leftover')">Reste</button>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="modal-footer">
            @if($facture->total_ttc != $facture->total_bonachat_deduis)
            <button type="button" class="btn btn-warning" 
                    onclick="factureBonachatModal({{ $facture->id_facture }})">Retour bon d'achat</button>
            @endif
            <button class="btn btn-success" type="button" id="payer_facture" onclick="facturePayer({{ $facture->id_facture }},{{ $facture->id_client }})">
                Payer</button>
            <a class="btn btn-success d-none" id="generer_tickets" href="{{ route('factureGenererTickets', ['id_facture' => $facture->id_facture]) }}">Imprimer le reçu</a>
            <button type="button" class="btn btn-secondary" id="fermer_paiement" data-dismiss="modal" aria-label="close">Annuler</button>
        </div>
    </div>
</div>