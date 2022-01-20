function moniteurCreerModal(id_moniteur = null) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('moniteurCreerModal'),
        type: 'GET',
        data: {
            id_moniteur: id_moniteur
        }
    })
    .done(function(response) {
        modalAfficher(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}

function moniteurCreer(id_moniteur = null) {
    console.log($('#couleur').val());
    
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('moniteurCreer'),
        type: 'GET',
        data: {
            id_moniteur: id_moniteur,
            nom: $('#nom').val(),
            prenom: $('#prenom').val(),
            email: $('#email').val(),
            id_role: $('#moniteur_role').val(),
            couleur: $('#couleur').val()
        }
    })
    .done(function(response) {
        if(response['modal']) {
            modalAfficher(response['modal']);
        }
        else {
            modalFermer();
            modalFermer(2);
        }
        $('#moniteurs').html(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    
    controlButton('active');
}

function moniteurVerifierRole(id_moniteur) {
    if($('#moniteur_role')) {
        if($('#moniteur_role').val() != $('#moniteur_role').attr('actuel_role')) {
            moniteurChangerRoleModal(id_moniteur);
            return;
        }
    }
    moniteurCreer(id_moniteur);
}

function moniteurChangerRoleModal(id_moniteur) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('moniteurChangerRoleModal'),
        type:'GET',
        data: {
            id_moniteur:id_moniteur,
            id_role: $('#moniteur_role').val(),
            ancien_role: $('#moniteur_role').attr('actuel_role')
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

function moniteurChangerCouleur(id_moniteur) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('moniteurChangerCouleur'),
        type: 'GET',
        data: {
            id_moniteur: id_moniteur,
            couleur_moniteur: $('#couleur_moniteur' + id_moniteur).val()
        }
    })
    .done(function(response) {
        $('#moniteurs').html(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}


function moniteurSupprModal(id_moniteur) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('moniteurSupprModal'),
        type: 'GET',
        data: {
            id_moniteur: id_moniteur
        }
    })
    .done(function(response) {
        modalAfficher(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}


function moniteurSupprimer(id_moniteur) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('moniteurSupprimer'),
        type: 'GET',
        data: {
            id_moniteur: id_moniteur
        }
    })
    .done(function(response) {
        modalFermer();
        window.location.reload();
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}

function moyenPaiementCreerModal() {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('moyenPaiementCreerModal'),
        type: 'GET',
    })
    .done(function(response) {
        modalAfficher(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}

function moyenPaiementCreer() {
    controlButton('desactive');

    $.ajax({
        url: $('#links').attr('moyenPaiementCreer'),
        type: 'GET',
        data: {
            libelle: $('#libelle').val()
        }
    })
    .done(function(response) {
        modalFermer();
        $('#paiements').html(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    
    controlButton('active');
}

function moyenPaiementActiver(id_moyen_paiement) {
    controlButton('desactive');

    $.ajax({
        url: $('#links').attr('moyenPaiementActiver'),
        type: 'GET',
        data: {
            id_moyen_paiement: id_moyen_paiement
        }
    })
    .done(function(response) {
        modalFermer();
        $('#paiements').html(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    
    controlButton('active');
}