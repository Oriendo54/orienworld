
function ecurieChevalAjoutModal(id_cheval = 0) {
    controlButtonByClass('btn', 'desactive');
    $.ajax({
        url: $('#links').attr('ecurieChevalAjoutModal'),
        type: 'GET',
        data: {
            id_cheval:id_cheval
        }
    })
    .done(function(response){
        modalAfficher(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButtonByClass('btn', 'active');
}


function ecurieChevalAjout(id_cheval = 0) {
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('ecurieChevalAjout'),
        type:'GET',
        data: {
            id_cheval:id_cheval,
            cheval_nom: $('#cheval_nom').val(),
            cheval_date_naissance: $('#cheval_date_naissance').val(),
            cheval_id_cheval_type: $('#cheval_id_cheval_type').val(),
            cheval_actif: $('.cheval_actif:checked').val()
        }
    })
    .done(function(response) {
        
        $('input').removeClass('is-invalid'); 
        $('div.invalid-feedback').remove(); 

        if(response['return']==0) {

            var error = response['error'];

            Object.keys(error).forEach(function(key) {

                $('input[name='+key+']').addClass('is-invalid');
                $('input[name='+key+']').after('<div class="invalid-feedback">'+error[key]+'</div>')

            });

        } else {
            modalFermer();
            $('#chevaux').html(response);
        }
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
    
}


function ecurieClientChevalStatutAjoutModal(id_client_cheval_statut=null) {
    controlButtonByClass('btn', 'desactive');
    $.ajax({
        url: $('#links').attr('ecurieClientChevalStatutAjoutModal'),
        type: 'GET',
        data: {
            id_client_cheval_statut:id_client_cheval_statut
        }
    })
    .done(function(response){
        modalAfficher(response['view']);
        controlButtonByClass('btn', 'active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButtonByClass('btn', 'active');
    });
}

function ecurieClientChevalStatutAjout(id_client_cheval_statut = null) {
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('ecurieClientChevalStatutAjout'),
        type:'GET',
        data: {
            id_client_cheval_statut:id_client_cheval_statut,
            clientchevalstatut_libelle: $('#clientchevalstatut_libelle').val()
        }
    })
    .done(function(response) {
        
        $('input').removeClass('is-invalid'); 
        $('div.invalid-feedback').remove(); 

        if(response['return']==0) {
            
            erreurValidationFormulaire(response);

        } else if(response['erreur']) {
            
            modalAfficher(response['view'],2);
            
        } else {
            modalFermer();
            $('#client_cheval_statut').html(response);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    
    controlButton('active');
}


function ecurieChevalAfficherCharges(id_cheval) {
    controlButton('desactive');
    if($('.afficher_charges[id_cheval=' + id_cheval + ']').hasClass('btn-primary')) {
        $.ajax({
            url: $('#links').attr('ecurieChevalAfficherCharges'),
            type: 'GET',
            data: {
                id_cheval: id_cheval
            }
        })
        .done(function(response){
            $('tr.ligne_cheval[id_cheval=' + id_cheval + ']').after(response['view']);
            $('.afficher_charges[id_cheval=' + id_cheval + ']').toggleClass('btn-primary').toggleClass('btn-success');
            controlButton('active');
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            // Création et affichage de l'erreur
            let err = eval("(" + jqXHR.responseText + ")");
            showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
            controlButton('active');
        });
    }
    else {
        $('.tableau_cheval_charges[id_cheval=' + id_cheval + ']').remove();
        $('.afficher_charges[id_cheval=' + id_cheval + ']').toggleClass('btn-success').toggleClass('btn-primary');
        controlButton('active');
    }
}


function ecurieChargeAttribuerChevauxModal(id_cheval_charge = null) {
    controlButton('desactive');

    $.ajax({
        url: $('#links').attr('ecurieChargeAttribuerChevauxModal'),
        type: 'GET',
        data: {
            id_cheval_charge: id_cheval_charge
        }
    })
    .done(function(response) {
        modalAfficher(response['view']);
        ecurieChargeAjusterParams(id_cheval_charge);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });

    controlButton('active');
}


function ecurieChargeAttribuerChevaux(id_cheval_charge = null) {
    controlButton('desactive');

    let id_chevaux = $("input[name='choix_chevaux']:checked").map(function() {
        return $(this).val();
    }).get();

    $.ajax({
        url: $('#links').attr('ecurieChargeAttribuerChevaux'),
        type: 'GET',
        data: {
            id_cheval_charge: id_cheval_charge,
            id_charge: $('#charge_selectionner').val(),
            id_chevaux: id_chevaux,
            date_debut: $('#charge_date_debut').val(),
            date_fin: $('#charge_date_fin').val(),
            date_facturation: $('#charge_date_facturation').val(),
            montant: parseFloat($('#charge_montant').val()),
            precision: $('#cheval_charge_precision').val()
        }
    })
    .done(function(response) {
        if(response['edit']) {
            modalFermer();
            $('.tableau_cheval_charges[id_cheval=' + response['id_cheval'] + ']').remove();
            $('tr.ligne_cheval[id_cheval=' + response['id_cheval'] + ']').after(response['view']);
        }
        else {
            modalAfficher(response['view']);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });

    controlButton('active');
}


function ecurieChargeAjusterParams(id_cheval_charge = null) {
    let periodicite = $('#charge_selectionner option:selected').attr('periodicite');
    let montant = $('#charge_selectionner option:selected').attr('montant');
    
    if(periodicite == 'mensuel') {
        $('#div_date_debut').removeClass('d-none').addClass('d-flex');
        $('#div_date_fin').removeClass('d-none').addClass('d-flex');
    }
    if(periodicite == 'unitaire') {
        $('#div_date_debut').addClass('d-none').removeClass('d-flex');
        $('#div_date_fin').addClass('d-none').removeClass('d-flex');
    }

    if(!id_cheval_charge) {
        $('#charge_montant').val(montant);
    }
}


function ecurieSupprChevalChargeModal(id_cheval_charge) {
    controlButton('desactive');

    $.ajax({
        url: $('#links').attr('ecurieSupprChevalChargeModal'),
        type: 'GET',
        data: {
            id_cheval_charge: id_cheval_charge
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


function ecurieSupprimerChevalCharge(id_cheval_charge, id_cheval) {
    controlButton('desactive');

    $.ajax({
        url: $('#links').attr('ecurieSupprimerChevalCharge'),
        type: 'GET',
        data: {
            id_cheval_charge: id_cheval_charge
        }
    })
    .done(function(response) {
        modalFermer();
        $('.tableau_cheval_charges[id_cheval=' + id_cheval + ']').remove();
        $('tr.ligne_cheval[id_cheval=' + id_cheval + ']').after(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });

    controlButton('active');
}

function ecurieAppliquerChargesMensuelles() {
    controlButton('desactive');

    $.ajax({
        url: $('#links').attr('ecurieAppliquerChargesMensuelles'),
        type: 'GET'
    })
    .done(function(response) {
        console.log('Vérification des charges mensuelles effectuée');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });

    controlButton('active');
}

$(function() {
    ecurieAppliquerChargesMensuelles();
});