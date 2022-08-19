@extends('template')
@section('content')
<h1 class="novel-title">{{$roman->titre}}</h1>

<div class="div_link novel-nav" goToPage="{{ route('goToPage') }}">
    <button class="bouton"><a href="{{ route('orienworld') }}">Retour</a></button>
    @if($roman->id_roman == 3)
    <button class="bouton"><a href="{{ route('starmap') }}"><i class="fas fa-moon mr-2"></i>Carte</a></button>
    @endif
</div>

<div class="{{$roman->alias.'-container'}}">
    <iframe src="{{ asset('/documents/'.$roman->alias.'.pdf') }}" width="1100px" height="800px"></iframe>
</div>

<section class="novel-copyright">
    <p>Texte rédigé par Julien Ambroise, tous droits réservés.</p>
    @if($roman->alias == "colossus")
    <p>Les personnages et l'univers dans lequel ils évoluent sont issus du jeu vidéo <a href="https://www.dofus.com/fr">Dofus</a>.<br/>
	<a href="https://www.dofus.com/fr">Dofus</a> et l'ensemble de son univers sont la propriété exclusive d'<a href="https://www.ankama.com/fr">Ankama</a><sup>&#169;</sup>.</p>
    @endif
    <p>Retrouvez-moi sur <a href="https://www.plumedargent.fr/membre/mroriendo" target="_blank">Plume d'Argent</a> pour me laisser un commentaire !</p>
</section>

<section class="novel-comments-display">
    @if(count($comments) > 0)
        @foreach($comments as $comment)
            <article>
                <header>
                    Posté le {{\Carbon\Carbon::parse($comment->created_at)->format('d-m-Y')}} par {{$comment->pseudo}}
                </header>
                <p>{{$comment->content}}</p>
            </article>
        @endforeach
        <button class="bouton"><a href="{{ route('getComments', ['id_roman' => $roman->id_roman]) }}">Tout afficher</a></button>
    @endif
</section>

@endsection('content')

@section('scriptjs')
<script type="text/javascript" src="{{ URL::asset('js/orienworld.js') }}"></script>
@endsection('scriptjs')
