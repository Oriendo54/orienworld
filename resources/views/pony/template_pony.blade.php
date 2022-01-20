<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	
	<!-- FAVICON -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('favicons/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('favicons/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('favicons/favicon-16x16.png') }}">
	<link rel="manifest" href="{{ URL::asset('favicons/site.webmanifest') }}">
	<link rel="mask-icon" href="{{ URL::asset('favicons/safari-pinned-tab.svg') }}" color="#2b5797">

	<meta name="msapplication-TileColor" content="#2b5797">
	<meta name="theme-color" content="#ffffff">
	<meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	
	<link rel="stylesheet" href="{{ URL::asset('css/normalize.css') }}"/>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous"> 
    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" integrity="sha384-XVHNoSVVnIfu4RRRsj+h8t6p+8o+eq87kb7Abav9bxpX9nNibXFocxhyLbi8/g1U" crossorigin="anonymous">
    <!-- JQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css" integrity="sha384-12hbHS5VUYVLOm/mmt5zrO3NnhEuXiIwdj3TMACB//xJmJi1lS9lIS89Hwp4E972" crossorigin="anonymous"> 
    <!-- CSS -->
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
	@yield('stylecss')

	<title>Les mondes d'Oriendo</title>
</head>
<body>
	<header>
		<nav class="main-nav">
			<ul class="main-nav-links">
				<li><a href="{{ route('index') }}"><i class="fas fa-home"></i> Accueil</a></li>
				@can('back-access')
					<li><a href="{{ route('pof') }}"><i class="far fa-calendar-alt"></i> Planning</a></li>
					<li><a href="{{ route('client') }}"><i class="fas fa-users"></i> Clients</a></li>
					<li><a href="{{ route('ecurie') }}"><i class="fas fa-horse"></i> Ecurie</a></li>
					<li><a href="{{ route('param') }}"><i class="fas fa-sliders-h"></i> Paramètres</a></li>
					@can('admin')
						<li><a href="{{ route('paramAdmin') }}"><i class="fas fa-user-lock"></i> Admin</a></li>
						<li><a href="{{ route('stats') }}"><i class="fas fa-percent"></i> Statistiques</a></li>
						<li><a href="{{ route('erreurs') }}"><i class="fas fa-exclamation-triangle"></i>Logs</a></li>
					@endcan
				@endcan
				<li><a href="{{ route('profile.show') }}"><i class="fas fa-user-cog h4 mr-1"></i>Mon profil</a></li>
				<li>
					<form method="POST" action="{{ route('logout') }}">
						@csrf
							<a href="{{ route('logout') }}"
									onclick="event.preventDefault();
									this.closest('form').submit();">
								@can('back-access')
								<i class="fas fa-user-times ml-2" title="Déconnexion"></i>
								@endcan
								@can('client')
								Se déconnecter
								@endcan
							</a>
					</form>
            	</li>
			</ul>
		</nav>
		<div class="mobile-header"><h1 class="mobile-title">Pony On Fire</h1></div>
		<img src="{{ URL::asset('img/orimage.png') }}" alt="orimage" class="nav-ori"/>
		<div class="main-nav-sidebar">
			<div class="sidebar-header"><p>Pony On Fire</p></div>
			<div class="sidebar-body"></div>
		</div>
		<div class="sidebar-overlay"></div>
	</header>

	<div class="pony-container">
		<main class="main">

			@yield('content')

		</main>
	</div>

	<footer class="footer">
		<h1 class="footer-title">Contact et réseaux sociaux</h1>
		<div class="follow">
			<a href="https://www.facebook.com/jambroise2" target="_blank"><i class="fab fa-facebook"></i></a>
			<a href="https://www.linkedin.com/in/julien-ambroise-508331202/" target="_blank"><i class="fab fa-linkedin"></i></a>
			<a href="https://discord.gg/gCScyfRM6g" target="_blank"><i class="fab fa-discord"></i></a>
			<a href="https://twitter.com/MrOriendo" target="_blank"><i class="fab fa-twitter"></i></a>
			<a href="https://www.plumedargent.fr/membre/mroriendo" target="_blank"><i class="fas fa-feather-alt"></i></a>
			<a href="{{ route('contact') }}"><i class="fas fa-envelope"></i></a>
		</div>
		<div class="copyright">
			<p><a mailto="julien.ambroise@wanadoo.fr">julien.ambroise@3wa.io</a><br/>
			06-84-87-50-31</p>
			<div>
				<img src="{{ URL::asset('img/orimage.png') }}" alt="orimage"/>
				<p>Site réalisé par Julien Ambroise<br/>
				Janvier 2020</p>
			</div>
		</div>

	</footer>
	<div class="modal" id_modal="1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    </div>
    <div class="modal" id_modal="2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    </div>
        
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha384-ZvpUoO/+PpLXR1lu4jmpXWu80pZlYUAfxl5NsBMWOEPSjUn/6Z/hRTt8+pR6L4N2" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha384-C/LoS0Y+QiLvc/pkrxB48hGurivhosqjvaTeRH7YLTf2a6Ecg7yMdQqTD3bdFmMO" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0" integrity="sha384-WGUMQV9YTj6eWnTy9WlaYjv9RGoM4ATMJTqF4GU8LVnVqpqeUOtowQPvWHIWdaMW" crossorigin="anonymous"></script>

        @yield('scriptjs')

		<script type="text/javascript" src="{{ URL::asset('js/sidebar.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/pof/script.js') }}"></script>
</body>
</html>