
function factureVider() {
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
    });
}

function factureSupprimerModal(id_facture) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('factureSupprimerModal'),
        type: 'GET',
        data: {
            id_facture: id_facture
        }
    })
    .done(function(response) {
        modalAfficher(response['view']);
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

function factureSupprimer(id_facture,id_client) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('factureSupprimer'),
        type: 'GET',
        data: {
            id_facture: id_facture
        }
    })
    .done(function(response) {
        modalFermer();
        factureAfficher(id_client);
        afficherClientDetails(id_client)
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

function factureBonachatModal(id_facture) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('factureBonachatModal'),
        type: 'GET',
        data: {
            id_facture: id_facture
        }
    })
    .done(function(response) {
        modalAfficher(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log('erreur factureChoixBonachatModal');
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}

function factureBonachatUtiliser(id_facture, id_bonachat, totalite = true) {
    controlButton('desactive');
    let montant;
    if(!totalite) {
        montant = $('#utiliser_bonachat_' + id_bonachat).val();
    }
    else {
        montant = $('#utiliser_bonachat_complet_' + id_bonachat).attr('restant');
    }
    // console.log(montant);
    
    $.ajax({
        url: $('#links').attr('factureBonachatUtiliser'),
        type: 'GET',
        data: {
            id_facture: id_facture,
            id_bonachat: id_bonachat,
            montant: montant
        }
    })
    .done(function(response) {
        if(response['erreur']) {
            modalAfficher(response['view'], 2);
        } else {
            modalAfficher(response['view']);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log('erreur factureChoixBonachatModal');
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}

function factureBonachatAnnuler(id_facture, id_bonachat) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('factureBonachatAnnuler'),
        type: 'GET',
        data: {
            id_facture: id_facture,
            id_bonachat: id_bonachat
        }
    })
    .done(function(response) {
        modalAfficher(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log('erreur factureChoixBonachatModal');
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}

function facturePayerModal(id_facture) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('facturePayerModal'),
        type: 'GET',
        data: {
            id_facture: id_facture
        }
    })
    .done(function(response) {
        modalAfficher(response['view']);
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log('erreur facturePayerModal');
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}

function factureSetPaiementMode(id_facture, id_moyen_paiement, action) {
    let montant = convertirEnNumeric($('#paiement-' + id_moyen_paiement).val());
    let autres_inputs = $('.paiement-input').not($('#paiement-' + id_moyen_paiement));
    let autres_montants = [];

    for(let autre_input of autres_inputs) {
        autres_montants.push([$(autre_input).attr('id_moyen_paiement'), $(autre_input).val()]);
    }

    console.log(autres_montants);

    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('factureSetPaiementMode'),
        type: 'GET',
        data: {
            id_facture: id_facture,
            id_moyen_paiement: id_moyen_paiement,
            action: action,
            montant: montant,
            autres_montants: autres_montants
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

function facturePayer(id_facture,id_client) {
    let montant_inputs = $('.paiement-input');
    let montants = [];

    for(let input of montant_inputs) {
        montants.push([$(input).attr('id_moyen_paiement'), $(input).val()])
    }

    // console.log(montants);
    
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('facturePayer'),
        type: 'GET',
        data: {
            id_facture: id_facture,
            montants: montants
        }
    })
    .done(function(response) {
        if(response['valid'] == 0) {
            modalAfficher(response['view']);
            $('#restant_a_renseigner').toggleClass('d-none');
        }
        else {
            factureAfficher(id_client);
            afficherClientDetails(id_client);
            window.location.replace($('#generer_tickets').attr('href'));
            $('#payer_facture').toggleClass('d-none');
            $('#generer_tickets').toggleClass('d-none');
            $('#fermer_paiement').html('Fermer').removeClass('btn-secondary').addClass('btn-danger');
            controlButton('active');
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log('erreur facturePayer');
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}

function factureModifierModal(id_facture) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('factureModifierModal'),
        type: 'GET',
        data: {
            id_facture: id_facture
        }
    })
    .done(function(response) {
        modalAfficher(response['view']);
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log('erreur factureModifierModal');
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}

function factureModifier(id_facture,id_client) {

    facturedetail = [];

    $('tr.facturedetail').each(function() {

        item = {};
        item ["id_facture_detail"] = $(this).attr('id_facture_detail');
        item ["facturedetail_libelle"] = $('#facturedetail_libelle_'+$(this).attr('id_facture_detail')).val();
        item ["facturedetail_total_ttc"] = $('#facturedetail_total_ttc_'+$(this).attr('id_facture_detail')).val();

        facturedetail.push(item);
    });

    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('factureModifier'),
        type: 'GET',
        data: {
            id_facture: id_facture,
            facturedetail:facturedetail
        }
    })
    .done(function(response) {

        modalFermer();
        factureAfficher(id_client);
        afficherClientDetails(id_client)
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}

function factureImpayerModal(id_facture) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('factureImpayerModal'),
        type: 'GET',
        data: {
            id_facture: id_facture
        }
    })
    .done(function(response) {
        modalAfficher(response['view']);
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}

function factureImpayer(id_facture,id_client) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('factureImpayer'),
        type: 'GET',
        data: {
            id_facture: id_facture
        }
    })
    .done(function(response) {
        modalFermer();
        factureAfficher(id_client);
        afficherClientDetails(id_client)
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}



function factureLierModal(id_client) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('factureLierModal'),
        type: 'GET',
        data: {
            id_client: id_client
        }
    })
    .done(function(response) {
        modalAfficher(response['view']);
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}

function factureLier(id_client) {

    let ids_facture = $("input[name='facture_lier']:checked").map(function() {
        return $(this).val();
    }).get();

    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('factureLier'),
        type: 'GET',
        data: {
            ids_facture:ids_facture
        }
    })
    .done(function(response) {
        modalFermer();
        factureAfficher(id_client);
        afficherClientDetails(id_client)
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}



function factureDelierModal(id_facture) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('factureDelierModal'),
        type: 'GET',
        data: {
            id_facture: id_facture
        }
    })
    .done(function(response) {
        modalAfficher(response['view']);
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}

function factureDelier(id_facture,id_client) {

    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('factureDelier'),
        type: 'GET',
        data: {
            id_facture:id_facture
        }
    })
    .done(function(response) {
        modalFermer();
        factureAfficher(id_client);
        afficherClientDetails(id_client)
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}


function factureAjouterSelectionTypeAjoutModal(id_client) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('factureAjouterSelectionTypeAjoutModal'),
        type: 'GET',
        data: {
            id_client: id_client
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


function factureAjouterChoixPrestationModal(id_client) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('factureAjouterChoixPrestationModal'),
        type: 'GET',
        data: {
            id_client: id_client
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


function factureAjouterChoixPrestationgroupeModal(id_client) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('factureAjouterChoixPrestationgroupeModal'),
        type: 'GET',
        data: {
            id_client: id_client
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


function factureAjouterChoixTarifModal(id_client) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('factureAjouterChoixTarifModal'),
        type: 'GET',
        data: {
            id_client: id_client,
            id_prestation:$('#facture_id_prestation').val(),
            id_prestation_groupe:$('#facture_id_groupe_prestation').val()
        }
    })
    .done(function(response) {
        modalFermer();
        modalAfficher(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        modalFermer();
    });
    controlButton('active');
}


function factureAjouter(id_client, id_prestation_groupe = null) {
    let tarifs = [];

    // On récupère les tarifs choisis
    for(let select of $('.select_tarif')) {
        tarifs.push($(select).val());
    }

    // Remarque : il est indispensable de vérifier la longueur de la sélection et non la sélection elle-même
    // Car lorsqu'il ne trouve rien, JQuery renvoie le prototype du sélecteur, ce qui valide la condition
    if($('#facture_id_groupe_prestation').length > 0) {
        id_prestation_groupe = $('#facture_id_groupe_prestation').val();
    }

    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('factureAjouter'),
        type: 'GET',
        data: {
            id_client: id_client,
            tarifs: tarifs,
            id_tarif: $('#facture_id_tarif').val(),
            id_prestation_groupe: id_prestation_groupe
        }
    })
    .done(function(response) {
        if(response['erreur']) {
            modalAfficher(response['view'],2);
        } else {
            updateVueClientDetails(response['view']);
            factureAfficher(id_client);
            modalFermer();
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}


// Facture sans prestation (ancienne facture)


function factureAnciennePrestationPayerModal(id_facture) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('factureAnciennePrestationPayerModal'),
        type: 'GET',
        data: {
            id_facture: id_facture
        }
    })
    .done(function(response) {
        modalAfficher(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}

function factureAnciennePrestationPayer(id_facture,id_client) {
    controlButton('desactive');

    facture_total_ttc = $('#facture_total_ttc').val();

    $.ajax({
        url: $('#links').attr('factureAnciennePrestationPayer'),
        type: 'GET',
        data: {
            id_facture: id_facture,
            facture_total_ttc:facture_total_ttc
        }
    })
    .done(function(response) {
        modalFermer();
        factureAfficher(id_client);
        afficherClientDetails(id_client)
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}


function factureAnciennePrestationModifierModal(id_facture) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('factureAnciennePrestationModifierModal'),
        type: 'GET',
        data: {
            id_facture: id_facture
        }
    })
    .done(function(response) {
        modalAfficher(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}

function factureAnciennePrestationModifier(id_facture,id_client) {
    controlButton('desactive');

    facture_total_ttc = $('#facture_total_ttc').val();

    $.ajax({
        url: $('#links').attr('factureAnciennePrestationModifier'),
        type: 'GET',
        data: {
            id_facture: id_facture,
            facture_total_ttc:facture_total_ttc
        }
    })
    .done(function(response) {
        modalFermer();
        factureAfficher(id_client);
        afficherClientDetails(id_client)
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}


// Affichage des factures payées

function facturePayeesButton() {
    controlButton('desactive');
    if($('#factures_payees_button').hasClass('btn-secondary')) {

        $('#factures_payees_button').toggleClass('btn-secondary').toggleClass('btn-warning');
        facturePayeesAfficher();
    }
    else {
        $('#factures_payees_button').toggleClass('btn-warning').toggleClass('btn-secondary');
        facturePayeesAfficher();
    }
    controlButton('active');
}


function facturePayeesAfficher() {
    let factures_payees = $('.facture_payee');

    for(let facture_payee of factures_payees) {
        $(facture_payee).toggleClass('d-none');
    }
}