function beneficesAjusterChoixDates(date_debut, date_fin) {
    $('#benefices_date_debut').val(date_debut);
    $('#benefices_date_fin').val(date_fin);
    chevalChargesBenefices();
}

function chevalChargesBenefices() {
    controlButton('desactive');
    $.ajax({
        url: $('#links').attr('chevalChargesBenefices'),
        type: 'GET',
        data: {
            date_debut: $('#benefices_date_debut').val(),
            date_fin: $('#benefices_date_fin').val()
        }
    })
    .done(function(response) {
        $('#benefices_chevaux_tableau').html(response['view']);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        let err = eval("(" + jqXHR.responseText + ")");
        showLog(err.message+"\r\n"+'file : '+err.file+"\r\n"+'line : '+err.line);
    });
    controlButton('active');
}

$(function() {
    chevalChargesBenefices();
});