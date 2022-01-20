<div class="modal-dialog modal-dialog-centered" 
     @if(count($cheval_types)==2) style="max-width:600px;" @endif
     @if(count($cheval_types)==3) style="max-width:800px;" @endif
     @if(count($cheval_types)==4) style="max-width:1000px;" @endif
     >
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-info" id="staticBackdropLabel">Sélectionner une monture pour {{$coursclient->pofclient->prenom}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="row">
                
                <!--TODO : foreach sur le type de cheval pour les chevaux de clubs-->
                
                @foreach($cheval_types as $cheval_type)
                <div class="col">
                    <h5>{{ $cheval_type->libelle }}</h5>
                    <ul class="list-group">
                        @foreach($chevaux as $cheval)
                            @if($cheval->id_cheval_type == $cheval_type->id_cheval_type)
                            <li onclick="choixMonture({{ $cheval->id_cheval }}, {{$coursclient->id_client}}, {{$coursclient->id_cours}})" 
                                class="list-group-item cursor_pointer mb-1">
                                {{ $cheval->nom }} 
                                {{ POFCours::chevalNombreUtilisation($cheval->id_cheval,$coursclient->id_cours) }}
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                @endforeach
                
                <div class="col">
                    <h5>Propriétaires</h5>
                    <ul class="list-group">
                        @foreach($chevaux_proprietaires as $cheval_proprietaire)
                            <li onclick="choixMonture({{ $cheval_proprietaire->id_cheval }}, {{$coursclient->id_client}}, {{$coursclient->id_cours}})" 
                                class="list-group-item cursor_pointer mb-1">
                                {{ $cheval_proprietaire->nom }} 
                                {{ POFCours::chevalNombreUtilisation($cheval_proprietaire->id_cheval,$coursclient->id_cours) }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" onclick="choixMonture(null, {{$coursclient->id_client}}, {{$coursclient->id_cours}})">Pas de monture</button>
        </div>
    </div>
</div>