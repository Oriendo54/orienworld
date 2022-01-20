@extends('template')

@section('content')
<section id="morpion-game" class="morpion-game">
    <h1>Le jeu du Morpion</h1>
    
    <p></p>
    
    <div class="morpion-grid">
        <div class="morpion-cell" data-cellid="0"></div>
        <div class="morpion-cell" data-cellid="1"></div>
        <div class="morpion-cell" data-cellid="2"></div>
        <div class="morpion-cell" data-cellid="3"></div>
        <div class="morpion-cell" data-cellid="4"></div>
        <div class="morpion-cell" data-cellid="5"></div>
        <div class="morpion-cell" data-cellid="6"></div>
        <div class="morpion-cell" data-cellid="7"></div>
        <div class="morpion-cell" data-cellid="8"></div>
    </div>
    
    <div class="game-links">
        <button class="bouton">Recommencer la partie</button>
        <button class="bouton"><a href="{{ route('portfolio') }}">Retour au portfolio</a></button>
    </div>
</section>

@endsection

@section('scriptjs')
<script type="text/javascript" src="{{ URL::asset('js/games/tictactoe.js') }}"></script>
@endsection