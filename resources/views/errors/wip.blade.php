@extends('template')

@section('content')
<section id="work-in-progress">
    <img src="{{ asset('img/work-in-progress-blue.png') }}" alt="work-in-progress" class="wip-pic"/>
    <h1 class="wip-title">Work In Progress</h1>
    
    <p>Désolé ! Cette partie du site est en construction.<br/>
    Revenez un peu plus tard pour visiter cette page !</p>
    
    <button class="bouton"><a href="{{ route($route) }}">Retour</a></button>
</section>
@endsection