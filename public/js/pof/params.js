function paramPrestationAjoutModal(id_prestation = 0) {
    controlButtonByClass('btn', 'desactive');
    $.ajax({
        url: $('#links').attr('paramPrestationAjoutModal'),
        type: 'GET',
        data: {
            id_prestation:id_prestation
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



function paramPrestationAjout(id_prestation = 0) {
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('paramPrestationAjout'),
        type:'GET',
        data: {
            id_prestation:id_prestation,
            prestation_libelle: $('#prestation_libelle').val(),
            prestation_id_tva: $('#prestation_id_tva').val(),
            prestation_id_prestation_type: $('#prestation_id_prestation_type').val(),
            prestation_id_cours_type: $('#prestation_id_cours_type').val(),
            prestation_id_client_statut: $('#prestation_id_client_statut').val(),
            prestation_age_min_client: $('#prestation_age_min_client').val(),
            prestation_age_max_client: $('#prestation_age_max_client').val(),
            prestation_duree: $('#prestation_duree').val()
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

        } else if(response['erreur']) {
            
            modalAfficher(response['view'],2);
            
        } else {
            modalFermer();
            $('#prestation').html(response);
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


function paramPrestationSupprModal(id_prestation) {
    controlButton('desactive');

    $.ajax({
        url: $('#links').attr('paramPrestationSupprModal'),
        type: 'GET',
        data: {
            id_prestation:id_prestation
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

    controlButton('active');
}


function paramPrestationSupprimer(id_prestation) {
    controlButton('desactive');

    $.ajax({
        url: $('#links').attr('paramPrestationSupprimer'),
        type: 'GET',
        data: {
            id_prestation:id_prestation
        }
    })
    .done(function(response){
        if(response['erreur']) {
            modalAfficher(response['view']);
        }
        else {
            modalFermer();
            window.location.reload();
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });

    controlButton('active');
}


function paramTarifSupprModal(id_tarif) {
    controlButton('desactive');

    $.ajax({
        url: $('#links').attr('paramTarifSupprModal'),
        type: 'GET',
        data: {
            id_tarif: id_tarif
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

    controlButton('active');
}


function paramTarifSupprimer(id_tarif) {
    controlButton('desactive');

    $.ajax({
        url: $('#links').attr('paramTarifSupprimer'),
        type: 'GET',
        data: {
            id_tarif: id_tarif
        }
    })
    .done(function(response){
        if(response['erreur']) {
            modalAfficher(response['view']);
        }
        else {
            modalFermer();
            window.location.reload();
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });

    controlButton('active');
}


function paramPrestationTarifButton(id_prestation) {
    
    controlButton('desactive');
    
    if($('button.paramPrestationTarif[id_prestation='+id_prestation+']').hasClass('btn-primary')) {
        
        $('button.paramPrestationTarif[id_prestation='+id_prestation+']').toggleClass('btn-primary').toggleClass('btn-success');
        
        paramPrestationTarif(id_prestation);
        
    } else {
        
        $('button.paramPrestationTarif[id_prestation='+id_prestation+']').toggleClass('btn-primary').toggleClass('btn-success');
        $('tr.ligne_prestation_tarif[id_prestation='+id_prestation+']').remove();
        
    }
    
    controlButton('active');
}


function paramPrestationTarif(id_prestation) {
        
    $.ajax({
        url: $('#links').attr('paramPrestationTarif'),
        type:'GET',
        data: {
            id_prestation:id_prestation
        }
    })
    .done(function(response) {

        $('tr.ligne_prestation[id_prestation='+id_prestation+']').after(response);

        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
}


function paramTarifAjoutModal(id_prestation,id_tarif=null) {
    controlButtonByClass('btn', 'desactive');
    $.ajax({
        url: $('#links').attr('paramTarifAjoutModal'),
        type: 'GET',
        data: {
            id_prestation:id_prestation,
            id_tarif:id_tarif
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


function paramTarifAjout(id_prestation,id_tarif = null) {
    
    controlButton('desactive');
    
    var tarif_prix_ttc = convertirEnNumeric($('#tarif_prix_ttc').val());
    var tarif_pourcentage = convertirEnNumeric($('#tarif_pourcentage').val());
    
    $.ajax({
        url: $('#links').attr('paramTarifAjout'),
        type:'GET',
        data: {
            id_prestation:id_prestation,
            id_tarif:id_tarif,
            tarif_libelle: $('#tarif_libelle').val(),
            tarif_prix_ttc: tarif_prix_ttc,
            tarif_pourcentage: tarif_pourcentage,
            tarif_quantite: $('#tarif_quantite').val(),
            tarif_date_fin: $('#tarif_date_fin').val(),
            tarif_date_debut: $('#tarif_date_debut').val()
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
            $('tr.ligne_prestation_tarif[id_prestation='+id_prestation+']').remove();
            paramPrestationTarif(id_prestation);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    
    controlButton('active');
}


function paramPrestationAssociationButton(id_prestation) {
    
    controlButton('desactive');
    
    if($('button.paramPrestationAssociation[id_prestation='+id_prestation+']').hasClass('btn-secondary')) {
        
        $('button.paramPrestationAssociation[id_prestation='+id_prestation+']').toggleClass('btn-secondary').toggleClass('btn-success');
        
        paramPrestationAssociation(id_prestation);
        
    } else {
        
        $('button.paramPrestationAssociation[id_prestation='+id_prestation+']').toggleClass('btn-secondary').toggleClass('btn-success');
        $('tr.ligne_prestation_association[id_prestation='+id_prestation+']').remove();
        
    }
    
    controlButton('active');
}


function paramPrestationAssociation(id_prestation) {
        
    $.ajax({
        url: $('#links').attr('paramPrestationAssociation'),
        type:'GET',
        data: {
            id_prestation:id_prestation
        }
    })
    .done(function(response) {

        $('tr.ligne_prestation[id_prestation='+id_prestation+']').after(response);

        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
}


function paramPrestationAssociationAjoutModal(id_prestation,id_prestation_association=null) {
    controlButtonByClass('btn', 'desactive');
    $.ajax({
        url: $('#links').attr('paramPrestationAssociationAjoutModal'),
        type: 'GET',
        data: {
            id_prestation:id_prestation,
            id_prestation_association:id_prestation_association
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


function paramPrestationAssociationAjout(id_prestation) {
    
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('paramPrestationAssociationAjout'),
        type:'GET',
        data: {
            id_prestation:id_prestation,
            prestationassociation_id_prestation: $('#prestationassociation_id_prestation').val(),
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
            $('tr.ligne_prestation_association[id_prestation='+id_prestation+']').remove();
            paramPrestationAssociation(id_prestation);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}


function paramPrestationAssociationSupprModal(id_prestation_association_lien) {
    
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('paramPrestationAssociationSupprModal'),
        type:'GET',
        data: {
            id_prestation_association_lien:id_prestation_association_lien
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
            $('tr.ligne_prestation_association[id_prestation='+response['id_prestation']+']').remove();
            paramPrestationAssociation(response['id_prestation']);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}


function paramPrestationGroupeAjoutModal(id_prestation_groupe=null) {
    controlButtonByClass('btn', 'desactive');
    $.ajax({
        url: $('#links').attr('paramPrestationGroupeAjoutModal'),
        type: 'GET',
        data: {
            id_prestation_groupe: id_prestation_groupe
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


function paramPrestationGroupeAjout(action, id_prestation_groupe) {
    controlButtonByClass('btn', 'desactive');
    $.ajax({
        url: $('#links').attr('paramPrestationGroupeAjout'),
        type: 'GET',
        data: {
            id_prestation1: $('#id_prestation1').val(),
            id_prestation2: $('#id_prestation2').val(),
            groupe_libelle: $('#groupe_libelle').val(),
            id_prestation_groupe: id_prestation_groupe,
            action: action
        }
    })
    .done(function(response) {
        if(response['erreur']) {
            modalAfficher(response['view'], 2);
        }
        else {
            $('.modal').modal('hide');
            if(response['creer']) {
                $('#prestation_groupe').html(response['view']);
            }
            else if(response['update']) {
                $('tr.ligne_prestation_groupe').remove();
                paramPrestationGroupe(id_prestation_groupe);
            }
            else {
                windows.location.reload();
            }
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButtonByClass('btn', 'active');
}


function paramPrestationGroupeButton(id_prestation_groupe) {
    
    controlButton('desactive');
    
    if($('button.paramPrestationGroupe[id_prestation_groupe='+id_prestation_groupe+']').hasClass('btn-secondary')) {
        
        $('button.paramPrestationGroupe[id_prestation_groupe='+id_prestation_groupe+']').toggleClass('btn-secondary').toggleClass('btn-success');
        
        paramPrestationGroupe(id_prestation_groupe);
        
    } else {
        
        $('button.paramPrestationGroupe[id_prestation_groupe='+id_prestation_groupe+']').toggleClass('btn-secondary').toggleClass('btn-success');
        $('tr.ligne_prestation_groupe[id_prestation_groupe='+id_prestation_groupe+']').remove();
        
    }
    
    controlButton('active');
}


function paramPrestationGroupe(id_prestation_groupe) {
        
    $.ajax({
        url: $('#links').attr('paramPrestationGroupe'),
        type:'GET',
        data: {
            id_prestation_groupe:id_prestation_groupe
        }
    })
    .done(function(response) {

        $('tr.ligne_groupe[id_prestation_groupe='+id_prestation_groupe+']').after(response);

        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
}


function paramPrestationGroupeSupprPrestation(id_prestation_groupe, id_prestation) {
    controlButtonByClass('btn', 'desactive');
    $.ajax({
        url: $('#links').attr('paramPrestationGroupeSupprPrestation'),
        type: 'GET',
        data: {
            id_prestation_groupe: id_prestation_groupe,
            id_prestation: id_prestation
        }
    })
    .done(function(response) {
        $('tr.ligne_prestation_groupe').remove();
        paramPrestationGroupe(id_prestation_groupe);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButtonByClass('btn', 'active');
}

function paramPrestationSupprGroupeModal(id_prestation_groupe) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('paramPrestationSupprGroupeModal'),
        type: 'GET',
        data: {
            id_prestation_groupe: id_prestation_groupe
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

function paramPrestationSupprGroupe(id_prestation_groupe) {
    controlButtonByClass('btn', 'desactive');
    $.ajax({
        url: $('#links').attr('paramPrestationSupprGroupe'),
        type: 'GET',
        data: {
            id_prestation_groupe: id_prestation_groupe
        }
    })
    .done(function(response) {
        $('#prestation_groupe').html(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButtonByClass('btn', 'active');
}


function paramPrestationGroupeTarifButton(id_prestation_groupe) {
    controlButton('desactive');
    
    if($('button.paramPrestationGroupeTarif[id_prestation_groupe='+id_prestation_groupe+']').hasClass('btn-primary')) {
        
        $('button.paramPrestationGroupeTarif[id_prestation_groupe='+id_prestation_groupe+']').toggleClass('btn-primary').toggleClass('btn-success');
        
        paramPrestationGroupeTarif(id_prestation_groupe);
        
    } else {
        
        $('button.paramPrestationGroupeTarif[id_prestation_groupe='+id_prestation_groupe+']').toggleClass('btn-primary').toggleClass('btn-success');
        $('tr.ligne_prestation_groupe_tarif[id_prestation_groupe='+id_prestation_groupe+']').remove();
        
    }
    
    controlButton('active');
}


function paramPrestationGroupeTarif(id_prestation_groupe) {
    $.ajax({
        url: $('#links').attr('paramPrestationGroupeTarif'),
        type:'GET',
        data: {
            id_prestation_groupe:id_prestation_groupe
        }
    })
    .done(function(response) {

        $('tr.ligne_groupe[id_prestation_groupe='+id_prestation_groupe+']').after(response);

        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
}


function paramPrestationGroupeTarifDefautModal(id_prestation_groupe_lien) {
    controlButton('desactive');
    
    $.ajax({
        url: $('#links').attr('paramPrestationGroupeTarifDefautModal'),
        type: 'GET',
        data: {
            id_prestation_groupe_lien: id_prestation_groupe_lien
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


function paramPrestationGroupeTarifDefaut(id_prestation_groupe_lien, id_prestation_groupe) {
    controlButton('desactive');

    $.ajax({
        url: $('#links').attr('paramPrestationGroupeTarifDefaut'),
        type: 'GET',
        data: {
            id_prestation_groupe_lien: id_prestation_groupe_lien,
            id_tarif: $('#choix_tarif_defaut').val()
        }
    })
    .done(function(response) {
        modalFermer();
        $('tr.ligne_prestation_groupe_tarif[id_prestation_groupe=' + id_prestation_groupe + ']').remove();
        $('tr.ligne_groupe[id_prestation_groupe=' + id_prestation_groupe + ']').after(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}


function paramCreerChargeModal(id_charge = null) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('paramCreerChargeModal'),
        type: 'GET',
        data: {
            id_charge: id_charge
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

function paramCreerCharge(id_charge = null) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('paramCreerCharge'),
        type: 'GET',
        data: {
            libelle: $('#charge_libelle').val(),
            periodicite: $('#charge_periodicite').val(),
            montant: $('#charge_montant').val(),
            id_charge: id_charge
        }
    })
    .done(function(response){
        $('#charges').html(response['view']);
        modalFermer();
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}

function paramSupprChargeModal(id_charge) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('paramSupprChargeModal'),
        type: 'GET',
        data: {
            id_charge: id_charge
        }
    })
    .done(function(response){
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

function paramSupprimerCharge(id_charge) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('paramSupprimerCharge'),
        type: 'GET',
        data: {
            id_charge: id_charge
        }
    })
    .done(function(response){
        $('#charges').html(response['view']);
        modalFermer();
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Création et affichage de l'erreur
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}