@component('mail::message')
# Message d'un utilisateur

Bonjour MrOriendo !
{{ $username }} vous a contacté via votre site Les Mondes d'Oriendo.

@component('mail::panel')
{{ $message }}
@endcomponent

@component('mail::button', ['url' => $email])
Répondre
@endcomponent

Vous pouvez également lui répondre à l'adresse {{ $email }}.

<div class="d-flex mt-3">
    <img src="{{ asset('img/orimage.png') }}" alt="orimage" width="15%"/>
    <div class="ml-3">
    À bientôt,<br>
    Les Mondes d'Oriendo
    </div>
</div>

<p class="mt-4 font-italic font-weight-light">
    Ceci est un message généré automatiquement par l'application. Merci de ne pas répondre directement à cet email.<br/>
    Utilisez le bouton "répondre" contenu dans cet email pour répondre directement à l'utilisateur.
</p>
@endcomponent