@extends('template')

@section('content')
<section id="snakegame" class="snakegame">
    <h1>Snakes and Ladders</h1>
    
    <p>Bienvenue dans le célèbre jeu de Snakes and Ladders !</p>
    <p>L'objectif est de parvenir à atteindre l'autre extrémité du plateau avant votre adversaire. Lancez le dé pour connaître le nombre de cases que votre pion peut parcourir à chaque tour. Mais prenez garde aux serpents qui vous feront glisser en direction de leur queue !</p>
    
    <div class="dice"></div>
    
    <div class="snakeboard">
        <div class="snake-player" id="snake-player-red"></div>
        <div class="snake-player" id="snake-player-blue"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>

        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>

        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>

        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>

        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>

        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>

        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>

        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>

        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>

        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
        <div class="snakecell"></div>
    </div>

    <div id="snake-aside" class="snake-aside">
        <p id="player-turn">C'est au tour du joueur 1</p>
        <div id="snake-outer-dice" class="snake-outer-dice">
            <div id="snake-inner-dice" class="snake-inner-dice">
                <div id="front-dice" class="front-dice"><img src="{{ asset('img/games/face-one.png') }}" alt="dé-face-un"/></div>
                <div id="back-dice" class="back-dice"><img src="{{ asset('img/games/face-two.png') }}" alt="dé-face-deux"/></div>
                <div id="left-dice" class="left-dice"><img src="{{ asset('img/games/face-three.png') }}" alt="dé-face-trois"/></div>
                <div id="right-dice" class="right-dice"><img src="{{ asset('img/games/face-four.png') }}" alt="dé-face-quatre"/></div>
                <div id="top-dice" class="top-dice"><img src="{{ asset('img/games/face-five.png') }}" alt="dé-face-cinq"/></div>
                <div id="under-dice" class="under-dice"><img src="{{ asset('img/games/face-six.png') }}" alt="dé-face-six"/></div>
            </div>
        </div>
    </div>
    
    <button class="bouton">Recommencer</button>
    <div class="game-links">
        <button class="bouton retour-portfolio"><a href="{{ route('portfolio') }}">Retour au portfolio</a></button>
    </div>
</section>
@endsection

@section('scriptjs')
<script type="text/javascript" src="{{ asset('js/games/snake.js') }}"></script>
@endsection