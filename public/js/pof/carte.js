
function carteAjoutQuantiteModal(id_carte) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('carteAjoutQuantiteModal'),
        type: 'GET',
        data: {
            id_carte: id_carte
        }
    })
    .done(function(response) {
        modalAfficher(response['view']);
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
    });
}

function carteAjoutQuantite(id_carte,quantite,id_tarif) {
    controlButton('desactive');
    
    if(quantite == 0) {
        quantite = $('input[name=carteAjoutQuantiteModal_autrequantite]').val();
    }
    
    console.log(quantite);
    
    $.ajax({
        url: $('#links').attr('carteAjoutQuantite'),
        type: 'GET',
        data: {
            id_carte: id_carte,
            quantite:quantite,
            id_tarif:id_tarif
        }
    })
    .done(function(response) {
        if(response['erreur']) {
            modalAfficher(response['view'],2);
        } else {
            updateVueClientDetails(response['view']);
            modalFermer();
        }
        controlButton('active');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        controlButton('active');
        modalFermer();
    });
}

function carteSupprimerModal(id_carte) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('carteSupprimerModal'),
        type: 'GET',
        data: {
            id_carte: id_carte
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

function carteSupprimer(id_carte) {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('carteSupprimer'),
        type: 'GET',
        data: {
            id_carte: id_carte
        }
    })
    .done(function(response) {
        modalFermer();
        updateVueClientDetails(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}