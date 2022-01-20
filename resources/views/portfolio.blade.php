@extends('template')

@section('content')
<section id="my-projects">
    <h1>Mes projets</h1>
    
    <h2 class="portfolio-category-title">Mini-jeux</h2>
    <div class="portfolio-card-container">
        @foreach($cards_game as $card)
        <div class="portfolio-card">
            <div class="card-front">
                <h2 class="portfolio-card-title">{{$card->titre}}</h2>
                <img src="{{ asset($card->src) }}" alt="{{ $card->alt }}"/>
            </div>
            <div class="card-back">
                <p>{{ $card->resume }}</p>
                <p>{{ $card->addendum }}</p>
                <button class="bouton"><a href="{{ route($card->route) }}">{{$card->titre}}</a></button>
            </div>
        </div>
        @endforeach
    </div>

    <h2 class="portfolio-category-title">Projets professionnels</h2>
    <div class="portfolio-card-container">
        @foreach($cards_pro as $card)
        <div class="portfolio-card">
            <div class="card-front">
                <h2 class="portfolio-card-title">{{$card->titre}}</h2>
                <img src="{{ asset($card->src) }}" alt="{{ $card->alt }}"/>
            </div>
            <div class="card-back">
                <p>{{ $card->resume }}</p>
                <p>{{ $card->addendum }}</p>
                <button class="bouton"><a href="{{ route($card->route) }}">{{$card->titre}}</a></button>
            </div>
        </div>
        @endforeach
    </div>

    <h2 class="portfolio-category-title">Autres</h2>
    <div class="portfolio-card-container">
        @foreach($cards_autre as $card)
        <div class="portfolio-card">
            <div class="card-front">
                <h2 class="portfolio-card-title">{{$card->titre}}</h2>
                <img src="{{ asset($card->src) }}" alt="{{ $card->alt }}"/>
            </div>
            <div class="card-back">
                <p>{{ $card->resume }}</p>
                <p>{{ $card->addendum }}</p>
                <button class="bouton"><a href="{{ route($card->route) }}">{{$card->titre}}</a></button>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection

@section('scriptjs')
    <script type="text/javascript" src="{{ URL::asset('js/portfolio.js') }}"></script>
@endsection