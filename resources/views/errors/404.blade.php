@extends('template')

@section('content')
<section class="error">
    <div>
        <img src="{{ asset('img/oricryemote.png') }}" alt="ori-cry"/>
        <h1>ERREUR 404</h1>
        <p>Désolé ! La page demandée n'a pas pu être chargée. Nous vous invitons à réessayer plus tard !</p>
        <button class="bouton"><a href="{{ route('/') }}">Revenir à l'accueil</a></button>
    </div>
</section>
@endsection