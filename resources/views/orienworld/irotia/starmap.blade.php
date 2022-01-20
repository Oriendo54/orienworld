@extends('template')

@section('content')
<div class="irotia-starmap" id="starmap">
    @foreach($planets as $planet)
    <img src="{{'img/orienworld/planet-'.$planet->nom.'.png'}}" alt="{{$planet->nom}}" title="{{$planet->nom}}" class="starmap-planet"/>
    {{--
        <img src="img/planet-lugori.png" alt="lugori" title="Lugori" class="starmap-planet"/>
        <img src="img/planet-irotia.png" alt="irotia" title="Irotia" class="starmap-planet"/>
        <img src="img/planet-ashura.png" alt="ashura" title="Ashura" class="starmap-planet"/>
        <img src="img/planet-rosamund.png" alt="rosamund" title="Rosamund" class="starmap-planet"/>
        <img src="img/planet-polaria.png" alt="polaria" title="Polaria" class="starmap-planet"/>
        <img src="img/planet-edona.png" alt="edona" title="Edona" class="starmap-planet"/>
        <img src="img/planet-dortamund.png" alt="dortamund" title="Dortamund" class="starmap-planet"/> 
                                                                                                        --}}
    @endforeach
</div>

<button class="starmap-button"><a href="{{ route('displayNovel', ['id_roman' => 3]) }}">Retour aux chroniques</a></button>

@foreach($planets as $planet)
<div class="planet-details" id="{{$planet->nom.'-details'}}">
    <h3 class="planet-nom">{{$planet->nom}}</h3>
    <p class="planet-resume">{{$planet->resume}}</p>
    @if($planet->nom == "ashura")
        <p><strong>Principale colonie :</strong> la station Revitalis</p>
        <p><strong>Population :</strong> moins d'un million d'habitants</p>
    @elseif($planet->nom == "dortamund")
        <p><strong>Principales installations :</strong> Bagne Impérial, grandes mines de neutronium</p>
        <p><strong>Population :</strong> quelques millions d'habitants</p>
    @else
        <p><strong>Principales villes : </strong>
            @switch($planet->nom)
                @case('lugori')
                    Solaria, Stène
                    @break
                @case('irotia')
                    Irotia, Galatia
                    @break
                @case('rosamund')
                    Lentiane
                    @break
                @case('polaria')
                    Ethen
                    @break
                @case('edona')
                    Retalia, Anderale, Aspen
                    @break
            @endswitch
        </p>
        <p><strong>Population :</strong> {{$planet->population}} milliards d'habitants</p>
    @endif
    <p class="close-details"><i class="fas fa-times"></i></p>
</div>
@endforeach
@endsection

@section('scriptjs')
<script type="text/javascript" src="{{ URL::asset('js/orienworld.js') }}"></script>
@endsection