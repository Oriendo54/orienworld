@extends('template')

@section('content')
<div class="sliders-container">
	@foreach($romans as $roman)
	<section class="{{ 'slider-'.$roman->alias.'-container slider-resume' }}">
		<i class="fas fa-arrow-circle-left slider-arrow-left"></i>
		<div class="display-resume">
			<h1 class="novel-title">{{$roman->titre}}</h1>
			
			<p>{{$roman->resume}}</p>
			@if($roman->alias == "colossus")
				<p>Colossus - Le Royaume de Misère est une fan-fiction se déroulant dans l'univers du jeu vidéo <a href="https://www.dofus.com/fr">Dofus</a>. Dofus ainsi que tous ses personnages
				sont la propriété exclusive de la société <a href="https://www.ankama.com/fr">Ankama Games</a>.</p>
			@endif
				<button class="bouton read-story"><a href="{{ route('displayNovel', ['id_roman' => $roman->id_roman]) }}">Lire le début du roman</a></button>
		</div>
		<i class="fas fa-arrow-circle-right slider-arrow-right"></i>
	</section>
	@endforeach
	
</div>
@endsection

@section('scriptjs')
    <script type="text/javascript" src="{{ URL::asset('js/orienworld.js') }}"></script>
@endsection