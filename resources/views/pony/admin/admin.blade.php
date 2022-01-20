@extends('pony.template_pony')

@section('content')

<div id="links"
    moniteurCreer="{{ route('moniteurCreer') }}"
    moniteurCreerModal="{{ route('moniteurCreerModal') }}"
    moniteurChangerRoleModal="{{ route('moniteurChangerRoleModal') }}"
    moniteurSupprModal="{{ route('moniteurSupprModal') }}"
    moniteurSupprimer="{{ route('moniteurSupprimer') }}"
    moniteurChangerCouleur="{{ route('moniteurChangerCouleur') }}"
    moyenPaiementCreerModal="{{ route('moyenPaiementCreerModal') }}"
    moyenPaiementCreer="{{ route('moyenPaiementCreer') }}"
    moyenPaiementActiver="{{ route('moyenPaiementActiver') }}"
></div>

<div id="moniteurs">
    @include('pony.admin.admin_moniteur', ['moniteurs => $moniteurs'])
</div>

<div id="paiements" class="mt-4">
    @include('pony.admin.admin_paiements', ['moyens_paiement => $moyens_paiement'])
</div>

@endsection

@section('scriptjs')
    <script type="text/javascript" src="{{ URL::asset('js/pof/admin.js') }}"></script>
@endsection