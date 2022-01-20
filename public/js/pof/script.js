/* global function */

function showLog(logs) {
    var message = ""; 
    if(Array.isArray(logs)) {
        logs.forEach(function(log, key) {
            if(key>0) {
                message += "\r\n";
            }
            message += log.message;
        });
    } else {
        message = logs;
    }
    alert(message);
}

/* Gestion des boutons */

/*
* controlButton :
*   - Permet d'activer ou de désactiver tous les boutons de la page simultanément
*/
function controlButton(action) {
    let buttons = $('.btn');
    if(action == 'desactive') {
        for (let button of buttons) {
            $(button).prop('disabled', true);
        }
    }
    if(action == 'active') {
        for (let button of buttons) {
            $(button).prop('disabled', false);
        }
    }
}

/*
* controlButtonById :
*   - Permet d'activer ou de désactiver un bouton de la page en le sélectionnant par son id
*/
function controlButtonById(selector, action) {
    if(action == 'desactive') {
        $('#' + selector).prop('disabled', true);
    }

    if(action == 'active') {
        $('#' + selector).prop('disabled', false);
    }
}

/*
* controlButtonByClass :
*   - Permet d'activer ou de désactiver certains boutons de la page simultanément en les sélectionnant par une class spécifique
*/
function controlButtonByClass(selector, action) {
    let buttons = $('.' + selector);

    if(action == 'desactive') {
        for (let button of buttons) {
            $(button).prop('disabled', true);
        }
    }
    if(action == 'active') {
        for (let button of buttons) {
            $(button).prop('disabled', false);
        }
    }
}

function modalAfficher(view,id_modal = 1) {
    $('.modal[id_modal='+id_modal+']').html(view).modal({backdrop: 'static', keyboard: false, show: true});
}

function modalFermer(id_modal = 1) {
    $('.modal[id_modal='+id_modal+']').modal('hide');
}

function erreurValidationFormulaire(response) {
    
    var error = response['error'];

    Object.keys(error).forEach(function(key) {

        $('input[name='+key+']').addClass('is-invalid');
        $('input[name='+key+']').after('<div class="invalid-feedback">'+error[key]+'</div>')

    });
}

function convertirEnNumeric(string) {
    if(!$.isNumeric( string ) && string != "") {
        var n = string.indexOf(',');
        num = string.substring(0, n) + '.' + string.substring(n + 1);
    } else if(string == "") {
        num = 0;
    } else {
        num = string;
    }
    return num;
}

function script() {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('script'),
        type: 'GET',
        data: {
        }
    })
    .done(function(response) {
        
        modalAfficher(response['view'],1);

    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
        
    });
    controlButton('active');
}

$(function() {
    $('body').css('background', '#ffffff');
});