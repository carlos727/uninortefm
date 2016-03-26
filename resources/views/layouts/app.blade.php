<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Uninorte FM Dashboard</title>
		<meta name="author" content="Carlos Beleño, Gaspar Villafañe"/>
		<meta name="description" content="Aplicación web para la administración de contenidos de la aplicación móvil Uninorte FM">
		<meta name="keywords" content="uninorte emisora">
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="{{ HTML::style('css/materialize.css') }}"  media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="{{ URL::asset('css/screen.css') }}"  media="screen,projection"/>
		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>

	<body>
		<div class="row">
			<aside>
				<ul class="side-nav fixed">
					<header>
						<img src="" alt="Logo Uninorte FM">
						<div class="row">
							<div class="col s6"><p>Usuario</p></div>
							<div class="col s4">
								<a class='dropdown-button' href='#' data-activates='dropdown1'>
									<i class="material-icons">arrow_drop_down</i>
								</a>
								<ul id='dropdown1' class='dropdown-content'>
									<li><a href="#!">Salir</a></li>
								</ul>
							</div>
						</div>
					</header>
					<li class="">
						<i class="material-icons">supervisor_account</i>
						<p>Usuarios</p>
					</li>
					<li class="">
						<i class="material-icons">playlist_play</i>
						<p>Programacion</p>
					</li>
				</ul>
			</aside>

			<section class="col s10 offset-s2">
				@yield('content')
			</section>

			<footer class="page-footer col s10 offset-s2">
				<div class="container">
					<div class="row">
						<div class="col l6 s12">
							<h5 class="white-text">Footer Content</h5>
							<p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
						</div>
						<div class="col l4 offset-l2 s12">
							<h5 class="white-text">Links</h5>
							<ul>
								<li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
								<li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="footer-copyright">
					<div class="container">
						© 2014 Copyright Text
						<a class="grey-text text-lighten-4 right" href="#!">More Links</a>
					</div>
				</div>
			</footer>
		</div>

		<!--Import jQuery before materialize.js-->
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="{{ URL::asset('js/bin/materialize.min.js') }}"></script>
		<script type="text/javascript">
			$(document).ready(function(){
			// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
				$('.modal-trigger').leanModal();
				$('.tooltipped').tooltip({delay: 50});
			});
		</script>
	</body>
</html>