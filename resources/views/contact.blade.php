@extends('template')
@section('content')
<section id="contact-section">
	<div id="links"
		contactMe="{{ route('contactMe') }}">

		<h1 class="contact-prompt">Une question, envie de me laisser un message ?</h1>
		<img src="img/plum.png" alt="plume" class="contact-plum"/>
		<p class="confirm-sending"></p>
	</div>
	
	<!-- Lien pour tester la page 404 du site -->
	{{-- <a href="index.php?action=error404">Error 404</a> --}}
	
	<form method="post" action="controllers/contact.php" class="form-contact">
		{{ csrf_field() }}
		<input placeholder="Nom" id="username" name="username" required/>
		<input placeholder="Email" id="usermail" name="usermail" required/>
		<textarea placeholder="Votre message" id="messagecontent" name="messagecontent" class="form-contact-message" required></textarea>
	
		<button class="contact-btn" type="button">Envoyer</button>
	</form>
</section>
@endsection

@section('scriptjs')
<script type="text/javascript" src="{{ URL::asset('js/contact.js') }}"></script>
@endsection