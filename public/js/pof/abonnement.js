function abonnementCreerModal(id_client, type) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('abonnementCreerModal'),
        type: 'GET',
        data: {
            id_client: id_client
        }
    })
    .done(function(response) {
        if(response['erreur']) {
            modalAfficher(response['view'], 2);
        }
        else {
            modalAfficher(response['view']);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}


function abonnementChoixTarifModal(id_client) {
    controlButton('desactive');

    $.ajax({
        url: $('#links').attr('abonnementChoixTarifModal'),
        type: 'GET',
        data: {
            id_client: id_client,
            id_prestation_groupe: $('#abonnement_prestation_groupe').val(),
            id_prestation: $('#abonnement_prestation').val(),
            date_expiration: $('#abonnement_date_expiration').val(),
            libelle: $('#abonnement_libelle').val()
        }
    })
    .done(function(response) {
        if(response['erreur']) {
            modalAfficher(response['view'], 2);
        }
        else {
            modalAfficher(response['view']);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });

    controlButton('active');
}


function abonnementCreer(id_client) {
    controlButton('desactive');

    let id_tarifs = [];

    // On récupère les tarifs choisis
    for(let select of $('.select_tarif')) {
        id_tarifs.push($(select).val());
    }

    $.ajax({
        url: $('#links').attr('abonnementCreer'),
        type: 'GET',
        data: {
            id_client: id_client,
            date_expiration: $('.choix_utilisateur').attr('date_expiration'),
            libelle: $('.choix_utilisateur').attr('libelle'),
            periodicite: $('#abonnement_periodicite').val(),
            id_prestation: $('#id_prestation').attr('id_prestation'),
            id_prestation_groupe: $('#id_prestation_groupe').attr('id_prestation_groupe'),
            id_tarifs: id_tarifs
        }
    })
    .done(function(response) {
        if(response['erreur']) {
            modalAfficher(response['view'], 2);
        }
        else {
            modalFermer();
            $('#abonnements').html(response['view']);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}


function abonnementGetDetails(id_abonnement, expiration = null) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('abonnementGetDetails'),
        type: 'GET',
        data: {
            id_abonnement: id_abonnement,
            expiration: expiration
        }
    })
    .done(function(response) {
        if(response['expiration']) {
            modalAfficher(response['view'], 2);
        }
        else {
            modalAfficher(response['view']);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}


function abonnementSupprimerModal(id_abonnement) {
    controlButton('desactive');

    $.ajax({
        url: $('#links').attr('abonnementSupprimerModal'),
        type: 'GET',
        data: {
            id_abonnement: id_abonnement
        }
    })
    .done(function(response) {
        modalAfficher(response['view'], 2);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}


function abonnementSupprimer(id_abonnement) {
    controlButton('desactive');

    $.ajax({
        url: $('#links').attr('abonnementSupprimer'),
        type: 'GET',
        data: {
            id_abonnement: id_abonnement
        }
    })
    .done(function(response) {
        window.location.reload();
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}


function abonnementVerifierEcheance() {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('abonnementVerifierEcheance'),
        type: 'GET'
    })
    .done(function(response) {
        if(response['erreur'] || response['message']) {
            modalAfficher(response['view']);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}


function abonnementProlongerModal(id_abonnement, expiration = null) {
    controlButton('desactive');

    $.ajax({
        url: $('#links').attr('abonnementProlongerModal'),
        type: 'GET',
        data: {
            id_abonnement: id_abonnement,
            expiration: expiration
        }
    })
    .done(function(response) {
        modalAfficher(response['view'], 2);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}


function abonnementProlonger(id_abonnement, expiration = null) {
    controlButton('desactive');

    $.ajax({
        url: $('#links').attr('abonnementProlonger'),
        type: 'GET',
        data: {
            id_abonnement: id_abonnement,
            date_expiration: $('#date_expiration').val(),
            expiration: expiration
        }
    })
    .done(function(response) {
        modalFermer();
        // On recharge la page pour poursuivre la vérification des abonnements
        window.location.reload();
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}

$(function() {
    // Verification des dates d'échéance des abonnements au lancement de l'application
    abonnementVerifierEcheance();
});