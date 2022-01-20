@extends('template')

@section('content')
<section id="memory-game" class="memory-game-section">
    <h1>Le jeu du Memory</h1>
    <div class="memory-game-container">
        <div class="memory-game-info">
            <p>Essais <span id="memory-tries"></span></p>
        </div>
    </div>
    <div class="memory-card-container">
        <div class="memory-card">
            <div class="memory-card-front">
                
            </div>
            <div class="memory-card-back">
                <img src="{{ asset('img/games/memory/logo_colossus.png') }}" alt="logo_colossus"/>
            </div>
        </div>
        <div class="memory-card">
            <div class="memory-card-front">

            </div>
            <div class="memory-card-back">
                <img src="{{ asset('img/games/memory/logo_colossus.png') }}" alt="logo_colossus"/>
            </div>
        </div>
        <div class="memory-card">
            <div class="memory-card-front">

            </div>
            <div class="memory-card-back">
                <img src="{{ asset('img/games/memory/logo_colossus.png') }}" alt="logo_colossus"/>
            </div>
        </div>
        <div class="memory-card">
            <div class="memory-card-front">

            </div>
            <div class="memory-card-back">
                <img src="{{ asset('img/games/memory/logo_colossus.png') }}" alt="logo_colossus"/>
            </div>
        </div>
        <div class="memory-card">
            <div class="memory-card-front">

            </div>
            <div class="memory-card-back">
                <img src="{{ asset('img/games/memory/logo_colossus.png') }}" alt="logo_colossus"/>
            </div>
        </div>
        <div class="memory-card">
            <div class="memory-card-front">

            </div>
            <div class="memory-card-back">
                <img src="{{ asset('img/games/memory/logo_colossus.png') }}" alt="logo_colossus"/>
            </div>
        </div>
        <div class="memory-card">
            <div class="memory-card-front">

            </div>
            <div class="memory-card-back">
                <img src="{{ asset('img/games/memory/logo_colossus.png') }}" alt="logo_colossus"/>
            </div>
        </div>
        <div class="memory-card">
            <div class="memory-card-front">

            </div>
            <div class="memory-card-back">
                <img src="{{ asset('img/games/memory/logo_colossus.png') }}" alt="logo_colossus"/>
            </div>
        </div>
        <div class="memory-card">
            <div class="memory-card-front">

            </div>
            <div class="memory-card-back">
                <img src="{{ asset('img/games/memory/logo_colossus.png') }}" alt="logo_colossus"/>
            </div>
        </div>
        <div class="memory-card">
            <div class="memory-card-front">

            </div>
            <div class="memory-card-back">
                <img src="{{ asset('img/games/memory/logo_colossus.png') }}" alt="logo_colossus"/>
            </div>
        </div>
        <div class="memory-card">
            <div class="memory-card-front">

            </div>
            <div class="memory-card-back">
                <img src="{{ asset('img/games/memory/logo_colossus.png') }}" alt="logo_colossus"/>
            </div>
        </div>
        <div class="memory-card">
            <div class="memory-card-front">

            </div>
            <div class="memory-card-back">
                <img src="{{ asset('img/games/memory/logo_colossus.png') }}" alt="logo_colossus"/>
            </div>
        </div>     
    </div>
    <div class="game-links">
        <button class="bouton retour-portfolio"><a href="{{ route('portfolio') }}">Retour au portfolio</a></button>
    </div>
</section>
@endsection

@section('scriptjs')
<script type="text/javascript" src="{{ asset('js/games/memory.js') }}"></script>
@endsection