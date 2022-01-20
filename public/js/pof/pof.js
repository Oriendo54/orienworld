/* ==== FUNCTIONS ==== */


// Mise à jour des vues

function updateVueCoursDetails(view) {
    $('#display-cours-details').html(view);
}

function updateVueClientDetails(view) {
    $('#display-client-details').html(view);
}

    function index2() {
    $.ajax({
        url: $('#links').attr('index2'),
        type: 'GET',
        data: {
        }
    })
    .done(function(response) {
        $('#index2').html(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}


// Requêtes vers le controller

function getPlanning(date = null, decalage = null) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('getPlanning'),
        type: 'GET',
        data: {
            date: date,
            decalage: decalage
        }
    })
    .done(function(response) {
        if(response['erreur']) {
            modalAfficher(response['view']);
        }
        else {
            $('#display-planning-cours').html(response['view']);
            updatePlanning(response['listecours']);
        }
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log('erreur getPlanning');
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}


/*
* updatePlanning :
*   - Met à jour l'affichage des cours dans le planning
*/
function updatePlanning(listecours) {
    
    // console.log(listecours);
    
    // Vérifier que le tableau contient des cours
    if(listecours.length > 0) {
        for(let cours of listecours) {
            // Insertion du cours à l'heure où il commence
            let cell = $('td[x="' + cours.heure_debut + '"][y="' + cours.emplacement +'"]');
            cell.addClass('cursor_pointer');
            cell.attr("rowspan", cours.nombre_cases);
            cell.attr("onclick", "afficherCoursDetails(" + cours.id_cours + ")");
            
            // Mise à jour de l'affichage en fonction du type de cours
            cell.addClass('table-' + cours.couleur);
            cell.html(cours.libelle + ' ' + cours.nb_cavaliers_valides + '/' + cours.nb_cavalier_inscrits);
            cell.append('<div class="d-flex">' + cours.moniteur_prenom + '<div style="background-color:' + cours.moniteur_couleur +'; border-radius: 1rem; border: 1px solid black; width: 15px; height: 15px;" class="ml-2 mt-1"></div></div>')
            
            // Suppression des cellules inutiles
            for(let heure_occupee of cours.heures_occupees) {
                let othercell = $('td[x="' + heure_occupee + '"][y="' + cours.emplacement +'"]');
                othercell.remove();
            }
        }
        // console.log('mise à jour réussie');
    }
    else {
        console.log('tableau listecours vide');
    }
}


function selectionDatePlanning(date = null) {
    // console.log(date);
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('selectionDatePlanning'),
        type: 'GET',
        data: {
            date: date
        }
    })
    .done(function(response) {
        // console.log(response['semaine_planning']);

        $('#display-selection-planning').html(response['view']);
        $('#semaine-planning').append('<h4>Total semaine : ' + response["total_valides"] + '/' + response["total_inscrits"] + '</h4>');

        $('#semaine-planning').append('<div class="d-flex mt-4"><button class="btn btn-sm mt-2 h-50 btn-secondary" type="button" onclick="coursAjouterModal(\'' + response["semaine_planning"].lundi + '\')">+</button><div><p class="ml-2 mb-1 cursor_pointer" id="planning-lundi">Lundi ' + response["semaine_planning"].lundi + '</p><p class="ml-2 mt-1" id="compteur_lundi">' + response["semaine_planning"].lundi_valides + '/' + response["semaine_planning"].lundi_inscrits + ' validés</p></div></div>');
        $('#planning-lundi').attr('onclick', 'getPlanning(\'' + response["semaine_planning"].lundi + '\'); clearAffichage("cours-details")');
        // Si le nombre de cavaliers validés est plus faible que celui d'inscrits, on l'affiche en rouge
        if(response["semaine_planning"].lundi_valides < response["semaine_planning"].lundi_inscrits) {
            $('#compteur_lundi').addClass('font-weight-bold text-danger');
        }

        $('#semaine-planning').append('<div class="d-flex mt-4"><button class="btn btn-sm mt-2 h-50 btn-secondary" type="button" onclick="coursAjouterModal(\'' + response["semaine_planning"].mardi + '\')">+</button><div><p class="ml-2 mb-1 cursor_pointer" id="planning-mardi">Mardi ' + response["semaine_planning"].mardi + '</p><p class="ml-2 mt-1" id="compteur_mardi">' + response["semaine_planning"].mardi_valides + '/' + response["semaine_planning"].mardi_inscrits + ' validés</p><div></div>');
        $('#planning-mardi').attr('onclick', 'getPlanning(\'' + response["semaine_planning"].mardi + '\'); clearAffichage("cours-details")');
        // Si le nombre de cavaliers validés est plus faible que celui d'inscrits, on l'affiche en rouge
        if(response["semaine_planning"].mardi_valides < response["semaine_planning"].mardi_inscrits) {
            $('#compteur_mardi').addClass('font-weight-bold text-danger');
        }

        $('#semaine-planning').append('<div class="d-flex mt-4"><button class="btn btn-sm mt-2 h-50 btn-secondary" type="button" onclick="coursAjouterModal(\'' + response["semaine_planning"].mercredi + '\')">+</button><div><p class="ml-2 mb-1 cursor_pointer" id="planning-mercredi">Mercredi ' + response["semaine_planning"].mercredi + '</p><p class="ml-2 mt-1" id="compteur_mercredi">' + response["semaine_planning"].mercredi_valides + '/' + response["semaine_planning"].mercredi_inscrits + ' validés</p></div></div>');
        $('#planning-mercredi').attr('onclick', 'getPlanning(\'' + response["semaine_planning"].mercredi + '\'); clearAffichage("cours-details")');
        // Si le nombre de cavaliers validés est plus faible que celui d'inscrits, on l'affiche en rouge
        if(response["semaine_planning"].mercredi_valides < response["semaine_planning"].mercredi_inscrits) {
            $('#compteur_mercredi').addClass('font-weight-bold text-danger');
        }

        $('#semaine-planning').append('<div class="d-flex mt-4"><button class="btn btn-sm mt-2 h-50 btn-secondary" type="button" onclick="coursAjouterModal(\'' + response["semaine_planning"].jeudi + '\')">+</button><div><p class="ml-2 mb-1 cursor_pointer" id="planning-jeudi">Jeudi ' + response["semaine_planning"].jeudi + '</p><p class="ml-2 mt-1" id="compteur_jeudi">' + response["semaine_planning"].jeudi_valides + '/' + response["semaine_planning"].jeudi_inscrits + ' validés</p></div></div>');
        $('#planning-jeudi').attr('onclick', 'getPlanning(\'' + response["semaine_planning"].jeudi + '\'); clearAffichage("cours-details")');
        // Si le nombre de cavaliers validés est plus faible que celui d'inscrits, on l'affiche en rouge
        if(response["semaine_planning"].jeudi_valides < response["semaine_planning"].jeudi_inscrits) {
            $('#compteur_jeudi').addClass('font-weight-bold text-danger');
        }

        $('#semaine-planning').append('<div class="d-flex mt-4"><button class="btn btn-sm mt-2 h-50 btn-secondary" type="button" onclick="coursAjouterModal(\'' + response["semaine_planning"].vendredi + '\')">+</button><div><p class="ml-2 mb-1 cursor_pointer" id="planning-vendredi">Vendredi ' + response["semaine_planning"].vendredi + '</p><p class="ml-2 mt-1" id="compteur_vendredi">' + response["semaine_planning"].vendredi_valides + '/' + response["semaine_planning"].vendredi_inscrits + ' validés</p></div></div>');
        $('#planning-vendredi').attr('onclick', 'getPlanning(\'' + response["semaine_planning"].vendredi + '\'); clearAffichage("cours-details")');
        // Si le nombre de cavaliers validés est plus faible que celui d'inscrits, on l'affiche en rouge
        if(response["semaine_planning"].vendredi_valides < response["semaine_planning"].vendredi_inscrits) {
            $('#compteur_vendredi').addClass('font-weight-bold text-danger');
        }

        $('#semaine-planning').append('<div class="d-flex mt-4"><button class="btn btn-sm mt-2 h-50 btn-secondary" type="button" onclick="coursAjouterModal(\'' + response["semaine_planning"].samedi + '\')">+</button><div><p class="ml-2 mb-1 cursor_pointer" id="planning-samedi">Samedi ' + response["semaine_planning"].samedi + '</p><p class="ml-2 mt-1" id="compteur_samedi">' + response["semaine_planning"].samedi_valides + '/' + response["semaine_planning"].samedi_inscrits + ' validés</p></div></div>');
        $('#planning-samedi').attr('onclick', 'getPlanning(\'' + response["semaine_planning"].samedi + '\'); clearAffichage("cours-details")');
        // Si le nombre de cavaliers validés est plus faible que celui d'inscrits, on l'affiche en rouge
        if(response["semaine_planning"].samedi_valides < response["semaine_planning"].samedi_inscrits) {
            $('#compteur_samedi').addClass('font-weight-bold text-danger');
        }

        $('#semaine-planning').append('<div class="d-flex mt-4"><button class="btn btn-sm mt-2 h-50 btn-secondary" type="button" onclick="coursAjouterModal(\'' + response["semaine_planning"].dimanche + '\')">+</button><div><p class="ml-2 mb-1 cursor_pointer" id="planning-dimanche">Dimanche ' + response["semaine_planning"].dimanche + '</p><p class="ml-2 mt-1" id="compteur_dimanche">' + response["semaine_planning"].dimanche_valides + '/' + response["semaine_planning"].dimanche_inscrits + ' validés</p></div></div>');
        $('#planning-dimanche').attr('onclick', 'getPlanning(\'' + response["semaine_planning"].dimanche + '\'); clearAffichage("cours-details")');
        // Si le nombre de cavaliers validés est plus faible que celui d'inscrits, on l'affiche en rouge
        if(response["semaine_planning"].dimanche_valides < response["semaine_planning"].dimanche_inscrits) {
            $('#compteur_dimanche').addClass('font-weight-bold text-danger');
        }

        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log('erreur selectionDatePlanning');
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}


function changeDatePlanning(decalage) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('changeDatePlanning'),
        type: 'GET',
        data: {
            decalage: decalage,
            date: $('#display-date-planning').attr('date')
        }
    })
    .done(function(response) {
        if(response['erreur']) {
            modalAfficher(response['view']);
        }
        else if(response['nouvelle_date']) {
            selectionDatePlanning(response['nouvelle_date']);
            getPlanning(response['nouvelle_date']);
        }
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log('erreur changeDatePlanning');
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}


function afficherCoursDetails(id_cours) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('afficherCoursDetails'),
        type: 'GET',
        data: {
            id_cours: id_cours,
            date_planning: $('#display-date-planning').text()
        }
    })
    .done(function(response) {
        $('#display-cours-details').html(response['view']);
//        $('#display-infos-cours').html(response['infos_cours'].date_cours + ' <br/>' + response['infos_cours'].heure_debut + ' - ' + response['infos_cours'].heure_fin);
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log('erreur afficherCoursDetails');
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}


function afficherClientDetails(id_client) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('afficherClientDetails'),
        type: 'GET',
        data: {
            id_client: id_client
        }
    })
    .done(function(response) {
        if(response['erreur']) {
            modalAfficher(response['view']);
        }
        else {
            updateVueClientDetails(response['view']);
        }
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log('erreur afficherClientDetails');
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}


function rechercherClient(recherche_client) {
    
    $.ajax({
        url: $('#links').attr('rechercherClient'),
        type: 'GET',
        data: {
            recherche_client: recherche_client
        }
    })
    .done(function(response) {
        
        if(response['id_client']) {
            afficherClientDetails(response['id_client']);
        } else if(response['erreur']) {
            modalAfficher(response['view']);
        }

    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log('erreur afficherClientDetails');
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}


function rechercherCavalier(recherche_client) {
    
    $.ajax({
        url: $('#links').attr('rechercherClient'),
        type: 'GET',
        data: {
            recherche_client: recherche_client
        }
    })
    .done(function(response) {
        
        if(response['id_client']) {
            ajoutCavalier(response['id_client']);
        } else if(response['erreur']) {
            modalAfficher(response['view']);
        }

    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log('erreur afficherClientDetails');
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}


// Fonction qui vide le contenu de la balise dans la vue.
function clearAffichage(selecteur) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('clearAffichage'),
        type: 'GET',
    })
    .done(function(response) {
        $("#display-" + selecteur).empty();
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log('erreur clearAffichage');
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}


function coursAjouterModal(date,id_cours) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('coursAjouterModal'),
        type: 'GET',
        data: {
            date_cours: date,
            id_cours:id_cours
        }
    })
    .done(function(response) {
        modalAfficher(response);
//        updateHeureFinCoursModal();
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}


function coursAjouter(date_cours,id_cours) {
    controlButton('desactive');

    // Sélection de tous les niveaux choisis sous forme d'un TABLEAU (utilisation de .map)
    let cours_client_niveaux = $("input[name='niveau-client']:checked").map(function() {
        return $(this).val();
    }).get();
    
    var cours_repetitif = 0;
    if($("input[name=CoursRepetitif]").prop( "checked")) {
        cours_repetitif = 1;
    }
    
    $.ajax({
        url: $('#links').attr('coursAjouter'),
        type: 'GET',
        data: {
            id_cours:id_cours,
            id_cours_type: $("select[name=cours-type]").val(),
            id_cours_emplacement: $("select[name=cours-emplacement]").val(),
            cours_client_niveaux: cours_client_niveaux,
            date_cours: date_cours,
            heure_debut: $('#cours-debut').val(),
            heure_fin: $('#cours-fin').val(),
            nb_cavalier_max: parseInt($('#max-clients').val()),
            id_moniteur: parseInt($('#choix-moniteur').val()),
            libelle: $('#libelle').val(),
            cours_repetitif:cours_repetitif
        }
    })
    .done(function(response) {
        if(response['erreur']) {
            modalAfficher(response['view'],2);
        }
        else {
            modalFermer();
            if(!response['date_cours']) {
                getPlanning(date_cours);
            } else {
                getPlanning(response['date_cours']);
            }
            
            afficherCoursDetails(response['id_cours']);
        }
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}


//VERIF

// Fonction prenant en charge l'affichage dynamique des options pour l'heure de fin du cours
function updateHeureFinCoursModal() {
    // Récupération de l'heure sélectionnée pour le début du cours
    // et utilisation de .split() pour extraire l'heure et les minutes.
    let options_existantes = $('#cours-fin').children();
    for (let option_existante of options_existantes) {
        option_existante.remove();
    }

    let params = $('#cours-debut').val().split(':');
    let heure = parseInt(params[0]);
    let minutes = parseInt(params[1]);
    let heures_fin = [];

    let heure_parcourue = '';
    let minutes_parcourues = '';

    // Insertion de toutes les heures dans le tableau heures_fin avec un pas de 15mn
    while(heure != 23 || minutes != 0) {
        minutes += 15;
        if(minutes == 60) {
            heure += 1;
            minutes = 0;
        }

        if(heure == 8) {
            heure_parcourue = '08';
        }
        else if(heure == 9) {
            heure_parcourue = '09';
        }
        else if(heure > 9) {
            heure_parcourue = heure.toString();
        }
        if(minutes == 0) {
            minutes_parcourues = '00';
        }
        else if(minutes > 0) {
            minutes_parcourues = minutes.toString();
        }
        let horaire_parcouru = `${heure_parcourue}:${minutes_parcourues}:00`;
        heures_fin.push(horaire_parcouru);
    }

    // Création des options pour le select de l'heure de fin du cours
    for(let hf of heures_fin) {
        params = hf.split(':');
        heure_fin = params[0];
        minutes_fin = params[1];

        if(minutes_fin == '0') {
            minutes_fin = '00';
        }

        $('#cours-fin').append('<option value="' + hf + '">' + heure_fin + 'h' + minutes_fin + '</option>');
    }
}



function ajoutCavalier(id_client) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('ajoutCavalier'),
        type: 'GET',
        data: {
            id_client: id_client,
            id_cours: $('#titre-cours-details').attr('id_cours')
        }
    })
    .done(function(response) {
        if(response['erreur']){
            modalAfficher(response['view']);
        }
        else {
            $('#display-cours-details').html(response['view']);
            $('#display-infos-cours').html(response['infos_cours'].date_cours + ' <br/>' + response['infos_cours'].heure_debut + ' - ' + response['infos_cours'].heure_fin);
            getPlanning(response['infos_cours'].date_cours);
            afficherClientDetails(id_client);
            if(response['alerte_niveau']) {
                modalAfficher(response['alerte_niveau']);
            }
        }
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log('erreur ajoutCavalier');
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
    modalFermer();
}


function retirerCavalier(id_client, id_cours) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('retirerCavalier'),
        type: 'GET',
        data: {
            id_client: id_client,
            id_cours: id_cours
        }
    })
    .done(function(response) {
        $('#display-cours-details').html(response['view']);
        $('#display-infos-cours').html(response['infos_cours'].date_cours + ' <br/>' + response['infos_cours'].heure_debut + ' - ' + response['infos_cours'].heure_fin);
        getPlanning(response['infos_cours'].date_cours);
        afficherClientDetails(id_client);
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log('erreur retirerCavalier');
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}


function choixMontureModal(id_client, id_cours) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('choixMontureModal'),
        type: 'GET',
        data: {
            id_client: id_client,
            id_cours: id_cours
        }
    })
    .done(function(response) {
        afficherCoursDetails(id_cours);
        afficherClientDetails(id_client);
        modalAfficher(response['modalAfficher']);
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log('erreur choixMontureModal');
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}


function choixMonture(id_cheval, id_client, id_cours) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('choixMonture'),
        type: 'GET',
        data: {
            id_cheval: id_cheval,
            id_client: id_client,
            id_cours: id_cours
        }
    })
    .done(function(response) {
        if(response['erreur']) {
            modalAfficher(response['view']);
        }
        else {
            afficherCoursDetails(id_cours);
            afficherClientDetails(id_client);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    modalFermer();
    controlButton('active');
}


function validerCours(id_client, id_cours) { 
    controlButton('desactive');   
    $.ajax({
        url: $('#links').attr('validerCours'),
        type: 'GET',
        data: {
            id_cours: id_cours,
            id_client: id_client
        }
    })
    .done(function(response) {
        afficherCoursDetails(id_cours);
        afficherClientDetails(id_client);
        if(response['erreur']){
            modalAfficher(response['view']);
        }
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log('erreur validerCours');
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}


function invaliderCours(id_client, id_cours) { 
    controlButton('desactive');   
    $.ajax({
        url: $('#links').attr('invaliderCours'),
        type: 'GET',
        data: {
            id_cours: id_cours,
            id_client: id_client
        }
    })
    .done(function(response) {
        afficherCoursDetails(id_cours);
        afficherClientDetails(id_client);
        if(response['erreur']){
            modalAfficher(response['view']);
        }
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log('erreur validerCours');
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}


function coursSuppressionModal(id_cours) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('coursSuppressionModal'),
        type: 'GET',
        data: {
            id_cours: id_cours
        }
    })
    .done(function(response) {
        modalAfficher(response);
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log('erreur deleteCoursWarningModal');
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}


function coursSuppression(id_cours,flag_occurence) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('coursSuppression'),
        type: 'GET',
        data: {
            id_cours: id_cours,
            flag_occurence:flag_occurence
        }
    })
    .done(function(response) {
        controlButton('active');
        if(response['error'] == 1) {
            modalAfficher(response['view']);
        } else {
            modalFermer();
            $('#display-cours-details').empty();
            getPlanning(response['date_cours']);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log('erreur deleteCours');
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}


function factureAfficher(id_client) {
    $.ajax({
        url: $('#links').attr('factureAfficher'),
        type: 'GET',
        data: {
            id_client: id_client
        }
    })
    .done(function(response) {
        $('#index2').html(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
}


function clientCours(id_client) {
    $.ajax({
        url: $('#links').attr('clientCours'),
        type: 'GET',
        data: {
            id_client: id_client
        }
    })
    .done(function(response) {
        $('#display-planning').html(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
}



function coursReinscrireModal(id_cours,id_client,id_cours_client) {
    
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('coursReinscrireModal'),
        type:'GET',
        data: {
            id_cours_client:id_cours_client
        }
    })
    .done(function(response) {
        
        afficherCoursDetails(id_cours);
        afficherClientDetails(id_client);
        modalAfficher(response['view'],1);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    
    controlButton('active');
}



function coursReinscrire(id_cours,id_client,id_cours_client,nb_jour) {
    
    controlButton('desactive');
    modalFermer();
    
    $.ajax({
        url: $('#links').attr('coursReinscrire'),
        type:'GET',
        data: {
            id_cours_client:id_cours_client,
            nb_jour:nb_jour
        }
    })
    .done(function(response) {
        
        modalAfficher(response['view'],1);

        afficherCoursDetails(id_cours);
        afficherClientDetails(id_client);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    
    controlButton('active');
}



/* ==== MAIN CODE ==== */

$(function() {
    // Création du planning pour la date du jour au premier lancement de la page
    getPlanning();

    // Affichage de la semaine en cours dans la vue permettant de choisir la date du planning
    selectionDatePlanning();
    
    $('#recherche_client').on('keyup', function(e) {
        e.preventDefault;
        if(e.keyCode == 13) {
            if($(this).val() != '' && $(this).val().length > 2) {
                $(this).removeClass('is-invalid');
                rechercherClient($(this).val());
            }
            else {
                $(this).addClass('is-invalid');
            }
        }
    });
    
    
//    script();
});