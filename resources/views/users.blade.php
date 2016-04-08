@extends('layouts.app')

@section('content')

	<header id="headuser">
		<div class="row">
			<h2 class="center">Gestor de Usuarios Uninorte FM</h2>
			<div class="divider"></div>
		</div>
	</header>

	<div class="row center">
		<a class="waves-effect waves-light btn modal-trigger" href="#modal-user">Nuevo Usuario</a>
		<div id="modal-user" class="modal">
			<div class="modal-content">
				<h4>Nuevo Usuario</h4>
				<div class="row">
					<form class="col s12">
						<div class="row">
							<div class="input-field col s10 offset-s1">
								<i class="material-icons prefix">account_circle</i>
								<input id="icon_prefix" type="text" name="username">
								<label for="icon_prefix">Nombre de usuario</label>
							</div>
						</div>
						<div class="row dv-rol">
							<label for="rol">Rol del Usuario</label>
							<div id="rol" class="col s10 offset-s1">
								<select name="rol">
									<option value="" disabled selected>Seleccione un rol</option>
									<option value="admin">Usuario DTIC</option>
									<option value="emisora">Usuario Emisora</option>
								</select>
							</div>
						</div>
						<div class="row">
							<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Habilitar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<section class="row">
		<div class="col s5">
			<h4 class="center">Usuarios Habilitados</h4>
			<table>
				<thead>
					<tr>
						<td>Nombre de Usuario</td>
						<td>Rol</td>
						<td>Acciones</td>
					</tr>
				</thead>

				<tbody>
					<tr>
						<td>Username</td>
						<td>Usuario DTIC</td>
						<td>
							<button type="submit" class="btn waves-effect waves-green tooltipped" data-position="left" data-delay="50" data-tooltip="Inhabilitar"><i class="material-icons">lock_outline</i></button>
							<button id="btndlt" type="submit" class="btn waves-effect waves-green tooltipped" data-position="right" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">delete_forever</i></button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="col s5 offset-s1">
			<h4 class="center">Usuarios Inhabilitados</h4>
			<table>
				<thead>
					<tr>
						<td>Nombre de Usuario</td>
						<td>Rol</td>
						<td>Acciones</td>
					</tr>
				</thead>

				<tbody>
					<tr>
						<td>Username</td>
						<td>Usuario Emisora</td>
						<td>
							<button type="submit" class="btn waves-effect waves-green tooltipped" data-position="left" data-delay="50" data-tooltip="Habilitar"><i class="material-icons">lock_open</i></button>
							<button id="btndlt" type="submit" class="btn waves-effect waves-green tooltipped" data-position="right" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">delete_forever</i></button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</section>

@endsection