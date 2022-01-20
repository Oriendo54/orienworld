@extends('template')

@section('content')
<div class="pong-game">
    <h1>Pong</h1>
    <div class="pong-buttons">
        <button class="bouton" type="button"><a href="{{ route('portfolio') }}">Retour au portfolio</a></button>
        <button class="bouton" type="button" id="button-start">Commencer la partie</button>
    </div>

    <div class="contain-canvas">
        <div class="joueur1">
            <h2 class="score1">Score du Joueur 1 : <em></em></h2>
            <p>Contrôle à la souris</p>
        </div>
        <canvas width="600" height="400" id="board"></canvas>
        <div class="joueur2">
            <h2 class="score2">Score du Joueur 2 : <em></em></h2>
            <p>Contrôle avec les touches directionnelles</p>
        </div>
    </div>
</div>
@endsection

@section('scriptjs')
<script type="module" src="{{ asset('js/games/pong.js') }}"></script>
@endsection