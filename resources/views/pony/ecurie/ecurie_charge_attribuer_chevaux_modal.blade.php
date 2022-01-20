<div class="modal-dialog modal-dialog-centered" @if(!$cheval_charge) style="max-width:600px;" @endif>
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-info" id="staticBackdropLabel">
                @if(!$cheval_charge)
                Ajouter une charge
                @else
                Modifier une charge pour {{$cheval_charge->pofcheval->nom}}
                @endif
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="modal-body">
            <div @if(!$cheval_charge) class="ml-2 mr-2 mb-4" @endif>
                <label for="charge_selectionner">
                @if(!$cheval_charge)
                    Choisissez une charge :
                @else
                    Type de charge :
                @endif
                </label>
                <select class="form-control" id="charge_selectionner" onchange="ecurieChargeAjusterParams()">
                    @foreach($charges as $charge)
                        @if($cheval_charge)
                            @if($charge->id_charge == $cheval_charge->id_charge)
                            <option value="{{$charge->id_charge}}" periodicite="{{$charge->periodicite}}" montant="{{ round($charge->montant, 2) }}" selected>
                                {{$charge->libelle}}
                            </option>
                            @else
                            <option value="{{$charge->id_charge}}" periodicite="{{$charge->periodicite}}" montant="{{ round($charge->montant, 2) }}">
                                {{$charge->libelle}}
                            </option>
                            @endif
                        @else
                            <option value="{{$charge->id_charge}}" periodicite="{{$charge->periodicite}}" montant="{{ round($charge->montant, 2) }}">
                                {{$charge->libelle}}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            @if(!$cheval_charge)
            <div class="row">
                <div class="col-3 d-flex justify-content-center">
                    <div class="d-flex flex-column justify-content-center">
                        @foreach($chevaux as $cheval)
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="{{$cheval->id_cheval}}" id="{{'choix_chevaux_'.$cheval->id_cheval}}" name="choix_chevaux">
                            <label class="form-check-label" for="{{'choix_chevaux_'.$cheval->id_cheval}}">
                                {{$cheval->nom}}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-9">
                    <div class="mt-2 input-group" id="div_precision">
                        <input type="text" id="cheval_charge_precision" name="cheval_charge_precision" placeholder="Infos complémentaires" class="form-control"/>
                    </div>
                    <div class="mt-3 flex-column" id="div_date_facturation">
                        <label for="charge_date_debut">Date de facturation :</label>
                        <input type="date" id="charge_date_facturation" name="charge_date_facturation" class="form-control" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}"/>
                    </div>
                    <div class="mt-3 flex-column d-none" id="div_date_debut">
                        <label for="charge_date_debut">Date de début :</label>
                        <input type="date" id="charge_date_debut" name="charge_date_debut" class="form-control" value="{{\Carbon\Carbon::now()->startOfMonth()->format('Y-m-d')}}"/>
                    </div>
                    <div class="mt-3 flex-column d-none" id="div_date_fin">
                        <label for="charge_date_fin">Date de fin :</label>
                        <input type="date" id="charge_date_fin" name="charge_date_fin" class="form-control" value="{{\Carbon\Carbon::now()->endOfMonth()->format('Y-m-d')}}"/>
                    </div>
                    <div class="d-flex flex-column mt-3">
                        <label for="charge_montant">Montant</label>
                        <input type="text" id="charge_montant" name="charge_montant" class="form-control" required/>
                    </div>
                </div>
            </div>
            @else
            <div class="d-flex flex-column">
                <div class="mt-2 input-group" id="div_precision">
                    <input type="text" id="cheval_charge_precision" name="cheval_charge_precision" placeholder="Infos complémentaires" 
                        @if($cheval_charge->precision) value="{{$cheval_charge->precision}}" @endif 
                        class="form-control"/>
                </div>
                <div class="mt-3 flex-column" id="div_date_facturation">
                    <label for="charge_date_debut">Date de facturation :</label>
                    <input type="date" id="charge_date_facturation" name="charge_date_facturation" class="form-control" value="{{\Carbon\Carbon::parse($cheval_charge->date_facturation)->format('Y-m-d')}}"/>
                </div>
                <div class="mt-3 flex-column d-none" id="div_date_debut">
                    <label for="charge_date_debut">Date de début :</label>
                    <input type="date" id="charge_date_debut" name="charge_date_debut" class="form-control" value="{{\Carbon\Carbon::parse($cheval_charge->date_debut)->format('Y-m-d')}}"/>
                </div>
                <div class="mt-3 flex-column d-none" id="div_date_fin">
                    <label for="charge_date_fin">Date de fin :</label>
                    <input type="date" id="charge_date_fin" name="charge_date_fin" class="form-control" value="{{\Carbon\Carbon::parse($cheval_charge->date_fin)->format('Y-m-d')}}"/>
                </div>
                <div class="d-flex flex-column mt-3">
                    <label for="charge_montant">Montant</label>
                    <input type="text" id="charge_montant" name="charge_montant" class="form-control" value="{{$cheval_charge->montant}}" required/>
                </div>
            </div>
            @endif
        </div>

        <div class="modal-footer">
            <button class="btn btn-success" type="button"
             onclick="ecurieChargeAttribuerChevaux(@if($cheval_charge){{$cheval_charge->id_cheval_charge}}@endif)">
             Valider</button>

            <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">Annuler</button>
        </div>
    </div>
</div>