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
            window.location.reload();
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
    let cours_client_niveau = $("input[name='niveau-client']:checked").map(function() {
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
            cours_client_niveau: cours_client_niveau,
            date_cours: date_cours,
            heure_debut: $('#cours-debut').val(),
            heure_fin: $('#cours-fin').val(),
            nb_cavalier_max: parseInt($('#max-clients').val()),
            id_moniteur: parseInt($('#choix-moniteur').val()),
            cours_repetitif:cours_repetitif
        }
    })
    .done(function(response) {
        if(response['erreur']) {
            modalAfficher(response['view'],2);
        }
        else {
            modalFermer();
            window.location.reload();
        }
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}

function pofNettoyerLogs() {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('pofNettoyerLogs'),
        type: 'GET'
    })
    .done(function(response) {
        window.location.reload();
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}

function pofViderLogs() {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('pofViderLogs'),
        type: 'GET'
    })
    .done(function(response) {
        window.location.reload();
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}