function contactMe() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: $('#links').attr('contactMe'),
        type: 'POST',
        data: {
            username: $('#username').val(),
            email: $('#usermail').val(),
            message: $('#messagecontent').val()
        }
    })
    .done(function (response) {
        if(!response) {
            $('.confirm-sending').html('Veuillez renseigner correctement votre nom d\'utilisateur et votre email !');
        }
        else {
            $('.confirm-sending').html('Votre message a correctement été envoyé !');
            $('.contact-btn').prop('disabled', true);
        }
    })
}

document.addEventListener('DOMContentLoaded', (function () {
    document.querySelector('.contact-btn').addEventListener('click', function (e) {
        e.preventDefault;
        contactMe();
    });
}));