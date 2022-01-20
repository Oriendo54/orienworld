<div class="modal-dialog modal-dialog-centered" style="max-width:580px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="staticBackdropLabel">
                @if(!$cours)
                Ajouter un cours le {{ $date_cours }}
                @else
                Modifier le cours suivant : 
                <br>{{\Carbon\Carbon::parse($cours->date_cours)->format('d/m/Y')}}
                <br>{{$cours->heure_debut}} - {{$cours->heure_fin}}
                <br>{{$cours->pofmoniteur->nom}} {{$cours->pofmoniteur->prenom}}
                <br>{{$cours->pofcoursemplacement->libelle}}
                @endif
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            
            <label for="cours_id_cours_type">Type de cours</label>
            <select name="cours-type" id="cours_id_cours_type" class="form-control mb-2">
                    <option value="1" @if($cours) @if($cours->id_cours_type == 1) selected @endif @endif>Cours collectif</option>
                    <option value="2" @if($cours) @if($cours->id_cours_type == 2) selected @endif @endif>Cours particulier</option>
                    <option value="3" @if($cours) @if($cours->id_cours_type == 3) selected @endif @endif>Promenade</option>
                    <option value="4" @if($cours) @if($cours->id_cours_type == 4) selected @endif @endif>Stage</option>
                    <option value="5" @if($cours) @if($cours->id_cours_type == 5) selected @endif @endif>Randonnée</option>
            </select>

            <label for="cours_id_cours_emplacement">Emplacement</label>
            <select name="cours-emplacement" id="cours_id_cours_emplacement" class="form-control mb-2">
                    <option value="1" @if($cours) @if($cours->id_cours_emplacement == 1) selected @endif @endif>Grand Manège</option>
                    <option value="2" @if($cours) @if($cours->id_cours_emplacement == 2) selected @endif @endif>Petit Manège</option>
                    <option value="3" @if($cours) @if($cours->id_cours_emplacement == 3) selected @endif @endif>Carrière</option>
                    <option value="4" @if($cours) @if($cours->id_cours_emplacement == 4) selected @endif @endif>Promenade</option>
            </select>
            
            <section id="niveau-cavalier" class="mb-2">
                <h6 class="text-info">Niveau</h6>
                <div class="d-flex justify-content-center">
                    @foreach($client_niveaux as $client_niveau)   
                        <div class="input-group ml-2">
                            <input type="checkbox" name="niveau-client" id="{{'niveau-'.$client_niveau->id_client_niveau}}"
                                value="{{$client_niveau->id_client_niveau}}" class="mt-1 mr-2" 
                                @if(!$cours || POFCours::verifierCoursNiveau($cours, $client_niveau)) checked @endif/>
                            <label for="{{'niveau-'.$client_niveau->id_client_niveau}}">{{$client_niveau->libelle}}</label>
                        </div>
                    @endforeach
                </div>
            </section>
            
            <h6 class="text-info">Horaire</h6>
                
                <label for="cours-debut">Heure de début</label>
                <select id="cours-debut" name="cours-debut" class="form-control mb-2" 
                        @if(!$cours) onchange="updateHeureFinCoursModal()" @endif>
                    
                    <option value="08:00:00" @if($cours) @if($cours->heure_debut == "08:00:00") selected @endif @endif>8h00</option>
                    <option value="08:15:00" @if($cours) @if($cours->heure_debut == "08:15:00") selected @endif @endif>8h15</option>
                    <option value="08:30:00" @if($cours) @if($cours->heure_debut == "08:30:00") selected @endif @endif>8h30</option>
                    <option value="08:45:00" @if($cours) @if($cours->heure_debut == "08:45:00") selected @endif @endif>8h45</option>
                    <option value="09:00:00" @if($cours) @if($cours->heure_debut == "09:00:00") selected @endif @endif>9h00</option>
                    <option value="09:15:00" @if($cours) @if($cours->heure_debut == "09:15:00") selected @endif @endif>9h15</option>
                    <option value="09:30:00" @if($cours) @if($cours->heure_debut == "09:30:00") selected @endif @endif>9h30</option>
                    <option value="09:45:00" @if($cours) @if($cours->heure_debut == "09:45:00") selected @endif @endif>9h45</option>
                    <option value="10:00:00" @if($cours) @if($cours->heure_debut == "10:00:00") selected @endif @endif>10h00</option>
                    <option value="10:15:00" @if($cours) @if($cours->heure_debut == "10:15:00") selected @endif @endif>10h15</option>
                    <option value="10:30:00" @if($cours) @if($cours->heure_debut == "10:30:00") selected @endif @endif>10h30</option>
                    <option value="10:45:00" @if($cours) @if($cours->heure_debut == "10:45:00") selected @endif @endif>10h45</option>
                    <option value="11:00:00" @if($cours) @if($cours->heure_debut == "11:00:00") selected @endif @endif>11h00</option>
                    <option value="11:15:00" @if($cours) @if($cours->heure_debut == "11:15:00") selected @endif @endif>11h15</option>
                    <option value="11:30:00" @if($cours) @if($cours->heure_debut == "11:30:00") selected @endif @endif>11h30</option>
                    <option value="11:45:00" @if($cours) @if($cours->heure_debut == "11:45:00") selected @endif @endif>11h45</option>
                    <option value="12:00:00" @if($cours) @if($cours->heure_debut == "12:00:00") selected @endif @endif>12h00</option>
                    <option value="12:15:00" @if($cours) @if($cours->heure_debut == "12:15:00") selected @endif @endif>12h15</option>
                    <option value="12:30:00" @if($cours) @if($cours->heure_debut == "12:30:00") selected @endif @endif>12h30</option>
                    <option value="12:45:00" @if($cours) @if($cours->heure_debut == "12:45:00") selected @endif @endif>12h45</option>
                    <option value="13:00:00" @if($cours) @if($cours->heure_debut == "13:00:00") selected @endif @endif>13h00</option>
                    <option value="13:15:00" @if($cours) @if($cours->heure_debut == "13:15:00") selected @endif @endif>13h15</option>
                    <option value="13:30:00" @if($cours) @if($cours->heure_debut == "13:30:00") selected @endif @endif>13h30</option>
                    <option value="13:45:00" @if($cours) @if($cours->heure_debut == "13:45:00") selected @endif @endif>13h45</option>
                    <option value="14:00:00" @if($cours) @if($cours->heure_debut == "14:00:00") selected @endif @endif>14h00</option>
                    <option value="14:15:00" @if($cours) @if($cours->heure_debut == "14:15:00") selected @endif @endif>14h15</option>
                    <option value="14:30:00" @if($cours) @if($cours->heure_debut == "14:30:00") selected @endif @endif>14h30</option>
                    <option value="14:45:00" @if($cours) @if($cours->heure_debut == "14:45:00") selected @endif @endif>14h45</option>
                    <option value="15:00:00" @if($cours) @if($cours->heure_debut == "15:00:00") selected @endif @endif>15h00</option>
                    <option value="15:15:00" @if($cours) @if($cours->heure_debut == "15:15:00") selected @endif @endif>15h15</option>
                    <option value="15:30:00" @if($cours) @if($cours->heure_debut == "15:30:00") selected @endif @endif>15h30</option>
                    <option value="15:45:00" @if($cours) @if($cours->heure_debut == "15:45:00") selected @endif @endif>15h45</option>
                    <option value="16:00:00" @if($cours) @if($cours->heure_debut == "16:00:00") selected @endif @endif>16h00</option>
                    <option value="16:15:00" @if($cours) @if($cours->heure_debut == "16:15:00") selected @endif @endif>16h15</option>
                    <option value="16:30:00" @if($cours) @if($cours->heure_debut == "16:30:00") selected @endif @endif>16h30</option>
                    <option value="16:45:00" @if($cours) @if($cours->heure_debut == "16:45:00") selected @endif @endif>16h45</option>
                    <option value="17:00:00" @if($cours) @if($cours->heure_debut == "17:00:00") selected @endif @endif>17h00</option>
                    <option value="17:15:00" @if($cours) @if($cours->heure_debut == "17:15:00") selected @endif @endif>17h15</option>
                    <option value="17:30:00" @if($cours) @if($cours->heure_debut == "17:30:00") selected @endif @endif>17h30</option>
                    <option value="17:45:00" @if($cours) @if($cours->heure_debut == "17:45:00") selected @endif @endif>17h45</option>
                    <option value="18:00:00" @if($cours) @if($cours->heure_debut == "18:00:00") selected @endif @endif>18h00</option>
                    <option value="18:15:00" @if($cours) @if($cours->heure_debut == "18:15:00") selected @endif @endif>18h15</option>
                    <option value="18:30:00" @if($cours) @if($cours->heure_debut == "18:30:00") selected @endif @endif>18h30</option>
                    <option value="18:45:00" @if($cours) @if($cours->heure_debut == "18:45:00") selected @endif @endif>18h45</option>
                    <option value="19:00:00" @if($cours) @if($cours->heure_debut == "19:00:00") selected @endif @endif>19h00</option>
                    <option value="19:15:00" @if($cours) @if($cours->heure_debut == "19:15:00") selected @endif @endif>19h15</option>
                    <option value="19:30:00" @if($cours) @if($cours->heure_debut == "19:30:00") selected @endif @endif>19h30</option>
                    <option value="19:45:00" @if($cours) @if($cours->heure_debut == "19:45:00") selected @endif @endif>19h45</option>
                    <option value="20:00:00" @if($cours) @if($cours->heure_debut == "20:00:00") selected @endif @endif>20h00</option>
                </select>
                
                <label for="cours-fin">Heure de fin</label>
                <select id="cours-fin" name="cours-fin" class="form-control mb-2">
                    
                    <option value="08:00:00" @if($cours) @if($cours->heure_fin == "08:00:00") selected @endif @endif>8h00</option>
                    <option value="08:15:00" @if($cours) @if($cours->heure_fin == "08:15:00") selected @endif @endif>8h15</option>
                    <option value="08:30:00" @if($cours) @if($cours->heure_fin == "08:30:00") selected @endif @endif>8h30</option>
                    <option value="08:45:00" @if($cours) @if($cours->heure_fin == "08:45:00") selected @endif @endif>8h45</option>
                    <option value="09:00:00" @if($cours) @if($cours->heure_fin == "09:00:00") selected @endif @endif>9h00</option>
                    <option value="09:15:00" @if($cours) @if($cours->heure_fin == "09:15:00") selected @endif @endif>9h15</option>
                    <option value="09:30:00" @if($cours) @if($cours->heure_fin == "09:30:00") selected @endif @endif>9h30</option>
                    <option value="09:45:00" @if($cours) @if($cours->heure_fin == "09:45:00") selected @endif @endif>9h45</option>
                    <option value="10:00:00" @if($cours) @if($cours->heure_fin == "10:00:00") selected @endif @endif>10h00</option>
                    <option value="10:15:00" @if($cours) @if($cours->heure_fin == "10:15:00") selected @endif @endif>10h15</option>
                    <option value="10:30:00" @if($cours) @if($cours->heure_fin == "10:30:00") selected @endif @endif>10h30</option>
                    <option value="10:45:00" @if($cours) @if($cours->heure_fin == "10:45:00") selected @endif @endif>10h45</option>
                    <option value="11:00:00" @if($cours) @if($cours->heure_fin == "11:00:00") selected @endif @endif>11h00</option>
                    <option value="11:15:00" @if($cours) @if($cours->heure_fin == "11:15:00") selected @endif @endif>11h15</option>
                    <option value="11:30:00" @if($cours) @if($cours->heure_fin == "11:30:00") selected @endif @endif>11h30</option>
                    <option value="11:45:00" @if($cours) @if($cours->heure_fin == "11:45:00") selected @endif @endif>11h45</option>
                    <option value="12:00:00" @if($cours) @if($cours->heure_fin == "12:00:00") selected @endif @endif>12h00</option>
                    <option value="12:15:00" @if($cours) @if($cours->heure_fin == "12:15:00") selected @endif @endif>12h15</option>
                    <option value="12:30:00" @if($cours) @if($cours->heure_fin == "12:30:00") selected @endif @endif>12h30</option>
                    <option value="12:45:00" @if($cours) @if($cours->heure_fin == "12:45:00") selected @endif @endif>12h45</option>
                    <option value="13:00:00" @if($cours) @if($cours->heure_fin == "13:00:00") selected @endif @endif>13h00</option>
                    <option value="13:15:00" @if($cours) @if($cours->heure_fin == "13:15:00") selected @endif @endif>13h15</option>
                    <option value="13:30:00" @if($cours) @if($cours->heure_fin == "13:30:00") selected @endif @endif>13h30</option>
                    <option value="13:45:00" @if($cours) @if($cours->heure_fin == "13:45:00") selected @endif @endif>13h45</option>
                    <option value="14:00:00" @if($cours) @if($cours->heure_fin == "14:00:00") selected @endif @endif>14h00</option>
                    <option value="14:15:00" @if($cours) @if($cours->heure_fin == "14:15:00") selected @endif @endif>14h15</option>
                    <option value="14:30:00" @if($cours) @if($cours->heure_fin == "14:30:00") selected @endif @endif>14h30</option>
                    <option value="14:45:00" @if($cours) @if($cours->heure_fin == "14:45:00") selected @endif @endif>14h45</option>
                    <option value="15:00:00" @if($cours) @if($cours->heure_fin == "15:00:00") selected @endif @endif>15h00</option>
                    <option value="15:15:00" @if($cours) @if($cours->heure_fin == "15:15:00") selected @endif @endif>15h15</option>
                    <option value="15:30:00" @if($cours) @if($cours->heure_fin == "15:30:00") selected @endif @endif>15h30</option>
                    <option value="15:45:00" @if($cours) @if($cours->heure_fin == "15:45:00") selected @endif @endif>15h45</option>
                    <option value="16:00:00" @if($cours) @if($cours->heure_fin == "16:00:00") selected @endif @endif>16h00</option>
                    <option value="16:15:00" @if($cours) @if($cours->heure_fin == "16:15:00") selected @endif @endif>16h15</option>
                    <option value="16:30:00" @if($cours) @if($cours->heure_fin == "16:30:00") selected @endif @endif>16h30</option>
                    <option value="16:45:00" @if($cours) @if($cours->heure_fin == "16:45:00") selected @endif @endif>16h45</option>
                    <option value="17:00:00" @if($cours) @if($cours->heure_fin == "17:00:00") selected @endif @endif>17h00</option>
                    <option value="17:15:00" @if($cours) @if($cours->heure_fin == "17:15:00") selected @endif @endif>17h15</option>
                    <option value="17:30:00" @if($cours) @if($cours->heure_fin == "17:30:00") selected @endif @endif>17h30</option>
                    <option value="17:45:00" @if($cours) @if($cours->heure_fin == "17:45:00") selected @endif @endif>17h45</option>
                    <option value="18:00:00" @if($cours) @if($cours->heure_fin == "18:00:00") selected @endif @endif>18h00</option>
                    <option value="18:15:00" @if($cours) @if($cours->heure_fin == "18:15:00") selected @endif @endif>18h15</option>
                    <option value="18:30:00" @if($cours) @if($cours->heure_fin == "18:30:00") selected @endif @endif>18h30</option>
                    <option value="18:45:00" @if($cours) @if($cours->heure_fin == "18:45:00") selected @endif @endif>18h45</option>
                    <option value="19:00:00" @if($cours) @if($cours->heure_fin == "19:00:00") selected @endif @endif>19h00</option>
                    <option value="19:15:00" @if($cours) @if($cours->heure_fin == "19:15:00") selected @endif @endif>19h15</option>
                    <option value="19:30:00" @if($cours) @if($cours->heure_fin == "19:30:00") selected @endif @endif>19h30</option>
                    <option value="19:45:00" @if($cours) @if($cours->heure_fin == "19:45:00") selected @endif @endif>19h45</option>
                    <option value="20:00:00" @if($cours) @if($cours->heure_fin == "20:00:00") selected @endif @endif>20h00</option>
                    
                </select>
            </section>
            
            <h6 class="text-info">Details</h6>
            
            <label for="max-clients">Nombre max d'inscrits</label>
            <input type="text" name="max-clients" id="max-clients" class="form-control mb-2" 
                   value="@if($cours) {{$cours->nb_cavalier_max}} @else 1 @endif"/>

            <label for="choix-moniteur">Moniteur</label>
            <select id="choix-moniteur" name="choix-moniteur" class="form-control mb-3">
                @foreach($moniteurs as $moniteur)
                    <option value="{{$moniteur->id_moniteur}}"
                            @if($cours) @if($cours->id_moniteur == $moniteur->id_moniteur) selected @endif @endif
                            >{{$moniteur->prenom}} {{$moniteur->nom}}</option>
                @endforeach
            </select>

            <input type="text" name="libelle" id="libelle" class="form-control mb-4" placeholder="Libellé" @if($cours) value="{{$cours->libelle}}" @endif>
            
            @if(!$cours)
            <div class="form-check" class="">
                <input class="form-check-input" type="checkbox" value=""  name="CoursRepetitif" id="inputCoursRepetitif" checked>
                <label class="form-check-label" for="inputCoursRepetitif">
                Cours répétitif
                </label>
            </div>
            @endif
            
            <br>
            
            @if(!$cours)
            <button type="button" class="btn btn-success btn" id="bouton-ajout-cours" onclick="coursAjouter('{{ $date_cours }}',null)">
                Ajouter</button>
            @else
            <button type="button" class="btn btn-success btn" id="bouton-ajout-cours" onclick="coursAjouter(null,{{$cours->id_cours}})">
                Modifier</button>
            @endif
        </div>
        
        <div class="modal-footer">
            
        </div>
    </div>
</div>