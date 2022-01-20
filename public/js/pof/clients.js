
function clientMAJ(id_client) {
    $.ajax({
        url: $('#links').attr('clientMAJ'),
        type: 'GET',
        data: {
            id_client:id_client
        }
    })
    .done(function(response){
        $('tr.ligne_client[id_client='+id_client+']').html(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
}


function clientAjoutModal(id_client = 0) {
    controlButtonByClass('btn', 'desactive');
    
    $.ajax({
        url: $('#links').attr('clientAjoutModal'),
        type: 'GET',
        data: {
            id_client:id_client
        }
    })
    .done(function(response){
        modalAfficher(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        console.log('erreur ajoutClientModal');
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });

    controlButtonByClass('btn', 'active');
}


function clientAjout(id_client_param = 0) {
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('clientAjout'),
        type:'GET',
        data: {
            id_client:id_client_param,
            client_nom: $('#client_nom').val(),
            client_prenom: $('#client_prenom').val(),
            client_date_naissance: $('#client_date_naissance').val(),
            client_email: $('#client_email').val(),
            client_telephone: $('#client_telephone').val(),
            client_rue: $('#client_rue').val(),
            client_code_postal: $('#client_code_postal').val(),
            client_ville: $('#client_ville').val(),
            client_id_niveau_client: $('#client_id_niveau_client').val(),
            client_id_client_statut: $('#client_id_client_statut').val(),
            id_role: $('#client_role').val()
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
            modalFermer(2);
            var id_client = response['id_client'];
            if(id_client_param == 0) {
                var html = '<tr class="ligne_client" id_client="'+id_client+'"></tr>'
                $('table.clients > tbody').prepend(html)
            }
            clientMAJ(id_client);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        console.log('erreur ajoutClient');
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}

function clientVerifierRole(id_client) {
    if($('#client_role')) {
        if($('#client_role').val() != $('#client_role').attr('actuel_role')) {
            clientChangerRoleModal(id_client);
            return;
        }
    }
    clientAjout(id_client);
}

function clientChangerRoleModal(id_client) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('clientChangerRoleModal'),
        type:'GET',
        data: {
            id_client:id_client,
            id_role: $('#client_role').val(),
            ancien_role: $('#client_role').attr('actuel_role')
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

function clientChevalButton(id_client) {
    
    controlButton('desactive');
    
    if($('button.client_cheval[id_client='+id_client+']').hasClass('btn-primary')) {
        
        $('button.client_cheval[id_client='+id_client+']').toggleClass('btn-primary').toggleClass('btn-success');
        
        clientCheval(id_client);
        
    } else {
        
        $('button.client_cheval[id_client='+id_client+']').toggleClass('btn-primary').toggleClass('btn-success');
        $('tr.ligne_client_cheval[id_client='+id_client+']').remove();
        
    }
    
    controlButton('active');
}



function clientCheval(id_client) {
        
    $.ajax({
        url: $('#links').attr('clientCheval'),
        type:'GET',
        data: {
            id_client:id_client
        }
    })
    .done(function(response) {

        $('tr.ligne_client[id_client='+id_client+']').after(response);
        $('button.client_cheval[id_client='+id_client+']').removeClass('btn-primary').addClass('btn-success');

        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
}


function clientChevalAjoutModal(id_client,id_client_cheval = null) {
    controlButtonByClass('btn', 'desactive');
    $.ajax({
        url: $('#links').attr('clientChevalAjoutModal'),
        type: 'GET',
        data: {
            id_client:id_client,
            id_client_cheval:id_client_cheval
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


function clientChevalAjout(id_client,id_client_cheval = null) {
    
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('clientChevalAjout'),
        type:'GET',
        data: {
            id_client:id_client,
            id_client_cheval:id_client_cheval,
            clientcheval_id_client_cheval_statut: $('#clientcheval_id_client_cheval_statut').val(),
            clientcheval_id_cheval: $('#clientcheval_id_cheval').val()
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
            $('tr.ligne_client_cheval[id_client='+id_client+']').remove();
            clientMAJ(id_client) 
            clientCheval(id_client);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    
    controlButton('active');
}


function clientChevalSupprModal(id_client_cheval) {
    controlButtonByClass('btn', 'desactive');
    $.ajax({
        url: $('#links').attr('clientChevalSupprModal'),
        type: 'GET',
        data: {
            id_client_cheval:id_client_cheval
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

function clientChevalSuppr(id_client_cheval,id_client) {
    
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('clientChevalSuppr'),
        type:'GET',
        data: {
            id_client_cheval:id_client_cheval
        }
    })
    .done(function(response) {
        
        modalFermer();
        $('tr.ligne_client_cheval[id_client='+id_client+']').remove();
        clientMAJ(id_client) 
        clientCheval(id_client);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    
    controlButton('active');
}


function clientAdresseAjoutModal(id_client, id_client_adresse = null) {
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('clientAdresseAjoutModal'),
        type:'GET',
        data: {
            id_client: id_client,
            id_client_adresse: id_client_adresse
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


function clientAdresseAjout(id_client) {
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('clientAdresseAjout'),
        type:'GET',
        data: {
            id_client: id_client,
            client_rue: $('#client_rue').val(),
            client_code_postal: $('#client_code_postal').val(),
            client_ville: $('#client_ville').val()
        }
    })
    .done(function(response) {
        modalFermer();
        $('.ligne_client[id_client=' + id_client + ']').html(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    
    controlButton('active');
}


function updateClientAdresse(id_client_adresse) {
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('updateClientAdresse'),
        type:'GET',
        data: {
            id_client_adresse: id_client_adresse,
            client_rue: $('#client_rue').val(),
            client_code_postal: $('#client_code_postal').val(),
            client_ville: $('#client_ville').val()
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


function clientAdresseSupprModal(id_client_adresse) {
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('clientAdresseSupprModal'),
        type:'GET',
        data: {
            id_client_adresse: id_client_adresse
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


function clientAdresseSupprimer(id_client_adresse) {
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('clientAdresseSupprimer'),
        type:'GET',
        data: {
            id_client_adresse: id_client_adresse
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


function clientTelephoneAjoutModal(id_client) {
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('clientTelephoneAjoutModal'),
        type:'GET',
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


function clientTelephoneAjout(id_client) {
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('clientTelephoneAjout'),
        type:'GET',
        data: {
            id_client: id_client,
            client_telephone: $('#client_telephone').val()
        }
    })
    .done(function(response) {
        modalFermer();
        $('.ligne_client[id_client=' + id_client + ']').html(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    
    controlButton('active');
}


function updateClientTelephone(id_client_telephone) {
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('updateClientTelephone'),
        type:'GET',
        data: {
            id_client_telephone: id_client_telephone,
            client_telephone: $('#client_telephone' + id_client_telephone).val()
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


function clientTelephoneSupprModal(id_client_telephone) {
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('clientTelephoneSupprModal'),
        type:'GET',
        data: {
            id_client_telephone: id_client_telephone
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

function clientTelephoneSupprimer(id_client_telephone) {
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('clientTelephoneSupprimer'),
        type:'GET',
        data: {
            id_client_telephone: id_client_telephone
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

function clientBonachats(id_client) {
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('clientBonachats'),
        type:'GET',
        data: {
            id_client: id_client
        }
    })
    .done(function(response) {
        $('.tableau_bonachat[id_client=' + id_client + ']').remove();
        $('tr.ligne_client[id_client=' + id_client + ']').after(response['view']);

        if($('.fermer_bonachats[id_client=' + id_client + ']').hasClass('d-none')) {
            $('.afficher_bonachats[id_client=' + id_client + ']').toggleClass('d-none');
            $('.fermer_bonachats[id_client=' + id_client + ']').toggleClass('d-none');
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    
    controlButton('active');
}

function clientFermerBonachats(id_client) {
    $('.tableau_bonachat[id_client=' + id_client + ']').remove();
    
    if($('.afficher_bonachats[id_client=' + id_client + ']').hasClass('d-none')) {
        $('.afficher_bonachats[id_client=' + id_client + ']').toggleClass('d-none');
        $('.fermer_bonachats[id_client=' + id_client + ']').toggleClass('d-none');
    }
}

function clientBonachatsEpuises(id_client) {
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('clientBonachatsEpuises'),
        type:'GET',
        data: {
            id_client: id_client
        }
    })
    .done(function(response) {
        $('.tableau_bonachat[id_client=' + id_client + ']').remove();
        $('tr.ligne_client[id_client=' + id_client + ']').after(response['view']);
        $('#bons-epuises').toggleClass('d-none');
        $('#retour-bonactifs').toggleClass('d-none');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    
    controlButton('active');
}

function clientBonachatFactures(id_bonachat) {
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('clientBonachatFactures'),
        type:'GET',
        data: {
            id_bonachat: id_bonachat
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

function clientBonachatCreerModal(id_client, id_bonachat = null) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('clientBonachatCreerModal'),
        type:'GET',
        data: {
            id_client: id_client,
            id_bonachat: id_bonachat
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

function clientBonachatCreer(id_client, id_bonachat = null) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('clientBonachatCreer'),
        type:'GET',
        data: {
            id_client: id_client,
            id_bonachat: id_bonachat,
            date_expiration: $('#date_expiration').val(),
            valeur: $('#valeur').val(),
            minimum: $('#minimum').val()
        }
    })
    .done(function(response) {
        modalFermer();
        $('.tableau_bonachat[id_client=' + id_client + ']').remove();
        $('tr.ligne_client[id_client=' + id_client + ']').after(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}

function clientBonachatMaj(id_client, id_bonachat) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('clientBonachatMaj'),
        type:'GET',
        data: {
            id_client: id_client,
            id_bonachat: id_bonachat,
            date_expiration: $('#date_expiration').val()
        }
    })
    .done(function(response) {
        modalFermer();
        $('.tableau_bonachat[id_client=' + id_client + ']').remove();
        $('tr.ligne_client[id_client=' + id_client + ']').after(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}

function clientBonachatSupprModal(id_client, id_bonachat) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('clientBonachatSupprModal'),
        type:'GET',
        data: {
            id_client: id_client,
            id_bonachat: id_bonachat
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

function clientBonachatSupprimer(id_client, id_bonachat) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('clientBonachatSupprimer'),
        type:'GET',
        data: {
            id_client: id_client,
            id_bonachat: id_bonachat
        }
    })
    .done(function(response) {
        modalFermer();
        $('.tableau_bonachat[id_client=' + id_client + ']').remove();
        $('tr.ligne_client[id_client=' + id_client + ']').after(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}


function clientEnvoyerMailInscriptionModal(id_client) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('clientEnvoyerMailInscriptionModal'),
        type:'GET',
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


function clientEnvoyerMailInscription(id_client) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('clientEnvoyerMailInscription'),
        type:'GET',
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