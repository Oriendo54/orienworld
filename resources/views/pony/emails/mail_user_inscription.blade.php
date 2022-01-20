@component('mail::message')
# Inscription client

Bonjour {{ $user->name }} !
Votre compte a été créé sur l'application {{ config('app.name') }}. 
Pour pouvoir y accéder, veuillez cliquer sur le lien ci-dessous afin de définir votre mot-de-passe :

@component('mail::button', ['url' => $url])
S'inscrire
@endcomponent

Si le lien ne fonctionne pas, vous pouvez également vous rendre directement sur la page de connexion de l'application {{ config('app.name') }}
et cliquer sur le lien "mot de passe oublié".<br/>

À bientôt,<br>
L'équipe de la Sellerie des Nacres

<div class="d-flex mt-3">
    <img src="{{ asset('img/logo_sellerie.jpg') }}" alt="logo_sellerie" width="50%"/>
</div>

<p class="mt-3 font-italic font-weight-light">
    Ceci est un message généré automatiquement par l'application. Merci de ne pas répondre directement à cet email.<br/>
    En cas de besoin, contactez-nous directement sur <a href="https://www.selleriedesnacres.fr/nous-contacter">notre site internet</a> ou par téléphone
    au <a href="0656676730">+33 6 56 67 67 30</a>.
</p>
@endcomponent
