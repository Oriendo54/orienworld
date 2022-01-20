<div class="modal-dialog modal-dialog-centered" style="max-width:800px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-primary" id="staticBackdropLabel">Abonnement n° {{$abonnement->id_abonnement}} 
                de {{$abonnement->pofabonnementclient->pofclient->nom}} {{$abonnement->pofabonnementclient->pofclient->prenom}}</h4>
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
        
        <h6>Détails de l'abonnement</h6>
        <table class="table table-sm table-striped table-bordered">
            <thead>
                <th>Id</th>
                <th>Abonnement</th>
                <th>Date de début</th>
                <th>Date d'expiration</th>
                <th>Prochaine échéance</th>
                <th>Montant</th>
                <th>Périodicité</th>
            </thead>

            <tbody>
                <tr>
                    <td>{{$abonnement->id_abonnement}}</td>
                    <td>{{$abonnement->libelle}}</td>
                    <td>{{\Carbon\Carbon::parse($abonnement->date_debut)->format('d-m-Y')}}</td>
                    <td>
                        {{\Carbon\Carbon::parse($abonnement->date_expiration)->format('d-m-Y')}}
                        @if(!isset($expiration))
                            <button class="btn btn-sm btn-primary ml-2" type="button" onclick="abonnementProlongerModal({{$abonnement->id_abonnement}})">
                                <i class="fas fa-pen"></i>
                            </button>
                        @endif
                    </td>
                    <td>{{\Carbon\Carbon::parse($abonnement->pofabonnementclient->echeance)->format('d-m-Y')}}</td>
                    <td>{{round($abonnement->total_ttc, 2)}} €</td>
                    <td>{{$abonnement->periodicite}}</td>
                </tr>
            </tbody>
        </table>

        <h6>Prestation(s)</h6>
        <table class="table table-sm table-striped table-bordered">
            <thead>
                <th>Id</th>
                <th>Libellé</th>
                <th>Quantité</th>
                <th>Prix TTC</th>
            </thead>

            <tbody>
                @foreach($abonnement->Pofabonnementprestations as $abonnementprestation)
                    <tr>
                        <td>{{$abonnementprestation->pofprestation->id_prestation}}</td>
                        <td>{{$abonnementprestation->pofprestation->libelle}}</td>
                        <td>1</td>
                        <td>{{round($abonnementprestation->poftarif->prix_ttc, 2)}} €</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        </div>
        <div class="modal-footer">
            @if(!isset($expiration))
            <button type="button" class="btn btn-danger" onclick="abonnementSupprimerModal({{ $abonnement->id_abonnement }})">Supprimer cet abonnement</button>
            @endif
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Annuler</button>
        </div>
    </div>
</div>