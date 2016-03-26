@extends('layouts.app')

@section('content')
	
	<header>
		<div class="row">
			<h2>Gestor de Contenidos Uninorte FM</h2>
			<div class="divider"></div>
		</div>
	</header>

	<div class="row">
		<div class="col s12">
			<ul class="tabs">
				<li class="tab col s1"><a class="active" href="#lunes">Lunes</a></li>
				<li class="tab col s1"><a href="#martes">Martes</a></li>
				<li class="tab col s1"><a href="#miercoles">Miercoles</a></li>
				<li class="tab col s1"><a href="#jueves">Jueves</a></li>
				<li class="tab col s1"><a href="#viernes">Viernes</a></li>
				<li class="tab col s1"><a href="#sabado">Sabado</a></li>
				<li class="tab col s1"><a href="#domingo">Domingo</a></li>
			</ul>
			<div class="divider"></div>
		</div>
		<div id="lunes" class="col s12">
			<div class="row center">
				<a class="waves-effect waves-light btn modal-trigger" href="#modal1">Nuevo Contenido</a>
				<div id="modal1" class="modal">
					<div class="modal-content">
						<h4>Nuevo Contenido</h4>
						<div class="row">
							<form action="{{ url('event') }}" method="POST" class="col s12">
								{!! csrf_field() !!}
								<div class="row">
									<div class="input-field col s12">
										<i class="material-icons prefix">radio</i>
										<input name="name" id="event-name" type="text">
										<label for="event-name">Nombre del Contenido</label>
									</div>
								</div>
								<div class="row">
									<div class="col s6">
										<label for="event-start-at">Hora de Inicio</label>
										<div id="event-start-at" class="input-field">
											<i class="material-icons prefix">alarm</i>
											<input name="start_at" type="time">
										</div>
									</div>
									<div class="col s6">
										<label for="event-end-at">Hora de Finalizacion</label>
										<div id="event-end-at" class="input-field">
											<i class="material-icons prefix">alarm</i>
											<input name="end_at" type="time">
										</div>
									</div>
								</div>
								<input type="text" name="day" value="1" class="hide">
								<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Crear</button>
							</form>
						</div>
					</div>
				</div>
				@include('common.errors')
			</div>
			@if (count($events) > 0)
				<table class="striped">
					<thead>
						<tr>
							<th data-field="name">Nombre</th>
							<th data-field="start_at">Inicio</th>
							<th data-field="end_at">Fin</th>
							<th data-field="actions">Acciones</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($events as $event)
							@if ($event->day == 1)
								<tr>
									<td><div>{{ $event->name }}</div></td>
									<td><div>{{ $event->start_at }}</div></td>
									<td><div>{{ $event->end_at }}</div></td>
									<td>
										<a class="waves-effect waves-light btn modal-trigger tooltipped" href="#modal2" data-position="left" data-delay="50" data-tooltip="Editar"><i class="material-icons">edit</i></a>
										<div id="modal2" class="modal">
											<div class="modal-content center">
												<h4>Editar Contenido</h4>
												<div class="row">
													<form class="col s12" action="{{ url('event/'.$event->id) }}" method="POST">
														{!! csrf_field() !!}
														{!! method_field('PUT') !!}
														<div class="row">
															<div class="input-field col s12">
																<i class="material-icons prefix">radio</i>
																<input name="name" id="event-name" type="text" class="" value="{{ $event->name }}">
																<label for="event-name">Nombre del Contenido</label>
															</div>
														</div>
														<div class="row">
															<div class="col s6">
																<label for="event-start-at">Hora de Inicio</label>
																<div id="event-start-at" class="input-field">
																	<i class="material-icons prefix">alarm</i>
																	<input name="start_at" type="time" value="{{ $event->start_at }}">
																</div>
															</div>
															<div class="col s6">
																<label for="event-end-at">Hora de Finalizacion</label>
																<div id="event-end-at" class="input-field">
																	<i class="material-icons prefix">alarm</i>
																	<input name="end_at" type="time" value="{{ $event->end_at }}">
																</div>
															</div>
														</div>
														<input type="text" name="day" value="{{ $event->day }}" class="hide">
														<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Guardar</button>
													</form>
												</div>
											</div>
										</div>
										<form action="{{ url('event/'.$event->id) }}" method="POST" style="display:inline-block">
											{!! csrf_field() !!}
											{!! method_field('DELETE') !!}
											<button type="submit" class="btn tooltipped" href="#" data-position="right" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">delete_forever</i></button>
										</form>
									</td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			@endif
		</div>
		<div id="martes" class="col s12">
			<div class="row center">
				<a class="waves-effect waves-light btn modal-trigger" href="#modal3">Nuevo Contenido</a>
				<div id="modal3" class="modal">
					<div class="modal-content">
						<h4>Nuevo Contenido</h4>
						<div class="row">
							<form action="{{ url('event') }}" method="POST" class="col s12">
								{!! csrf_field() !!}
								<div class="row">
									<div class="input-field col s12">
										<i class="material-icons prefix">radio</i>
										<input name="name" id="event-name" type="text">
										<label for="event-name">Nombre del Contenido</label>
									</div>
								</div>
								<div class="row">
									<div class="col s6">
										<label for="event-start-at">Hora de Inicio</label>
										<div id="event-start-at" class="input-field">
											<i class="material-icons prefix">alarm</i>
											<input name="start_at" type="time">
										</div>
									</div>
									<div class="col s6">
										<label for="event-end-at">Hora de Finalizacion</label>
										<div id="event-end-at" class="input-field">
											<i class="material-icons prefix">alarm</i>
											<input name="end_at" type="time">
										</div>
									</div>
								</div>
								<input type="text" name="day" value="2" class="hide">
								<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Crear</button>
							</form>
						</div>
					</div>
				</div>
				@include('common.errors')
			</div>
			@if (count($events) > 0)
				<table class="striped">
					<thead>
						<tr>
							<th data-field="name">Nombre</th>
							<th data-field="start_at">Inicio</th>
							<th data-field="end_at">Fin</th>
							<th data-field="actions">Acciones</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($events as $event)
							@if ($event->day == 2)
								<tr>
									<td><div>{{ $event->name }}</div></td>
									<td><div>{{ $event->start_at }}</div></td>
									<td><div>{{ $event->end_at }}</div></td>
									<td>
										<a class="waves-effect waves-light btn modal-trigger tooltipped" href="#modal4" data-position="left" data-delay="50" data-tooltip="Editar"><i class="material-icons">edit</i></a>
										<div id="modal4" class="modal">
											<div class="modal-content center">
												<h4>Editar Contenido</h4>
												<div class="row">
													<form class="col s12" action="{{ url('event/'.$event->id) }}" method="POST">
														{!! csrf_field() !!}
														{!! method_field('PUT') !!}
														<div class="row">
															<div class="input-field col s12">
																<i class="material-icons prefix">radio</i>
																<input name="name" id="event-name" type="text" class="" value="{{ $event->name }}">
																<label for="event-name">Nombre del Contenido</label>
															</div>
														</div>
														<div class="row">
															<div class="col s6">
																<label for="event-start-at">Hora de Inicio</label>
																<div id="event-start-at" class="input-field">
																	<i class="material-icons prefix">alarm</i>
																	<input name="start_at" type="time" value="{{ $event->start_at }}">
																</div>
															</div>
															<div class="col s6">
																<label for="event-end-at">Hora de Finalizacion</label>
																<div id="event-end-at" class="input-field">
																	<i class="material-icons prefix">alarm</i>
																	<input name="end_at" type="time" value="{{ $event->end_at }}">
																</div>
															</div>
														</div>
														<input type="text" name="day" value="{{ $event->day }}" class="hide">
														<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Guardar</button>
													</form>
												</div>
											</div>
										</div>
										<form action="{{ url('event/'.$event->id) }}" method="POST" style="display:inline-block">
											{!! csrf_field() !!}
											{!! method_field('DELETE') !!}
											<button type="submit" class="btn tooltipped" href="#" data-position="right" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">delete_forever</i></button>
										</form>
									</td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			@endif
		</div>
		<div id="miercoles" class="col s12">
			<div class="row center">
				<a class="waves-effect waves-light btn modal-trigger" href="#modal5">Nuevo Contenido</a>
				<div id="modal5" class="modal">
					<div class="modal-content">
						<h4>Nuevo Contenido</h4>
						<div class="row">
							<form action="{{ url('event') }}" method="POST" class="col s12">
								{!! csrf_field() !!}
								<div class="row">
									<div class="input-field col s12">
										<i class="material-icons prefix">radio</i>
										<input name="name" id="event-name" type="text">
										<label for="event-name">Nombre del Contenido</label>
									</div>
								</div>
								<div class="row">
									<div class="col s6">
										<label for="event-start-at">Hora de Inicio</label>
										<div id="event-start-at" class="input-field">
											<i class="material-icons prefix">alarm</i>
											<input name="start_at" type="time">
										</div>
									</div>
									<div class="col s6">
										<label for="event-end-at">Hora de Finalizacion</label>
										<div id="event-end-at" class="input-field">
											<i class="material-icons prefix">alarm</i>
											<input name="end_at" type="time">
										</div>
									</div>
								</div>
								<input type="text" name="day" value="3" class="hide">
								<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Crear</button>
							</form>
						</div>
					</div>
				</div>
				@include('common.errors')
			</div>
			@if (count($events) > 0)
				<table class="striped">
					<thead>
						<tr>
							<th data-field="name">Nombre</th>
							<th data-field="start_at">Inicio</th>
							<th data-field="end_at">Fin</th>
							<th data-field="actions">Acciones</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($events as $event)
							@if ($event->day == 3)
								<tr>
									<td><div>{{ $event->name }}</div></td>
									<td><div>{{ $event->start_at }}</div></td>
									<td><div>{{ $event->end_at }}</div></td>
									<td>
										<a class="waves-effect waves-light btn modal-trigger tooltipped" href="#modal6" data-position="left" data-delay="50" data-tooltip="Editar"><i class="material-icons">edit</i></a>
										<div id="modal6" class="modal">
											<div class="modal-content center">
												<h4>Editar Contenido</h4>
												<div class="row">
													<form class="col s12" action="{{ url('event/'.$event->id) }}" method="POST">
														{!! csrf_field() !!}
														{!! method_field('PUT') !!}
														<div class="row">
															<div class="input-field col s12">
																<i class="material-icons prefix">radio</i>
																<input name="name" id="event-name" type="text" class="" value="{{ $event->name }}">
																<label for="event-name">Nombre del Contenido</label>
															</div>
														</div>
														<div class="row">
															<div class="col s6">
																<label for="event-start-at">Hora de Inicio</label>
																<div id="event-start-at" class="input-field">
																	<i class="material-icons prefix">alarm</i>
																	<input name="start_at" type="time" value="{{ $event->start_at }}">
																</div>
															</div>
															<div class="col s6">
																<label for="event-end-at">Hora de Finalizacion</label>
																<div id="event-end-at" class="input-field">
																	<i class="material-icons prefix">alarm</i>
																	<input name="end_at" type="time" value="{{ $event->end_at }}">
																</div>
															</div>
														</div>
														<input type="text" name="day" value="{{ $event->day }}" class="hide">
														<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Guardar</button>
													</form>
												</div>
											</div>
										</div>
										<form action="{{ url('event/'.$event->id) }}" method="POST" style="display:inline-block">
											{!! csrf_field() !!}
											{!! method_field('DELETE') !!}
											<button type="submit" class="btn tooltipped" href="#" data-position="right" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">delete_forever</i></button>
										</form>
									</td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			@endif
		</div>
		<div id="jueves" class="col s12">
			<div class="row center">
				<a class="waves-effect waves-light btn modal-trigger" href="#modal7">Nuevo Contenido</a>
				<div id="modal7" class="modal">
					<div class="modal-content">
						<h4>Nuevo Contenido</h4>
						<div class="row">
							<form action="{{ url('event') }}" method="POST" class="col s12">
								{!! csrf_field() !!}
								<div class="row">
									<div class="input-field col s12">
										<i class="material-icons prefix">radio</i>
										<input name="name" id="event-name" type="text">
										<label for="event-name">Nombre del Contenido</label>
									</div>
								</div>
								<div class="row">
									<div class="col s6">
										<label for="event-start-at">Hora de Inicio</label>
										<div id="event-start-at" class="input-field">
											<i class="material-icons prefix">alarm</i>
											<input name="start_at" type="time">
										</div>
									</div>
									<div class="col s6">
										<label for="event-end-at">Hora de Finalizacion</label>
										<div id="event-end-at" class="input-field">
											<i class="material-icons prefix">alarm</i>
											<input name="end_at" type="time">
										</div>
									</div>
								</div>
								<input type="text" name="day" value="4" class="hide">
								<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Crear</button>
							</form>
						</div>
					</div>
				</div>
				@include('common.errors')
			</div>
			@if (count($events) > 0)
				<table class="striped">
					<thead>
						<tr>
							<th data-field="name">Nombre</th>
							<th data-field="start_at">Inicio</th>
							<th data-field="end_at">Fin</th>
							<th data-field="actions">Acciones</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($events as $event)
							@if ($event->day == 4)
								<tr>
									<td><div>{{ $event->name }}</div></td>
									<td><div>{{ $event->start_at }}</div></td>
									<td><div>{{ $event->end_at }}</div></td>
									<td>
										<a class="waves-effect waves-light btn modal-trigger tooltipped" href="#modal8" data-position="left" data-delay="50" data-tooltip="Editar"><i class="material-icons">edit</i></a>
										<div id="modal8" class="modal">
											<div class="modal-content center">
												<h4>Editar Contenido</h4>
												<div class="row">
													<form class="col s12" action="{{ url('event/'.$event->id) }}" method="POST">
														{!! csrf_field() !!}
														{!! method_field('PUT') !!}
														<div class="row">
															<div class="input-field col s12">
																<i class="material-icons prefix">radio</i>
																<input name="name" id="event-name" type="text" class="" value="{{ $event->name }}">
																<label for="event-name">Nombre del Contenido</label>
															</div>
														</div>
														<div class="row">
															<div class="col s6">
																<label for="event-start-at">Hora de Inicio</label>
																<div id="event-start-at" class="input-field">
																	<i class="material-icons prefix">alarm</i>
																	<input name="start_at" type="time" value="{{ $event->start_at }}">
																</div>
															</div>
															<div class="col s6">
																<label for="event-end-at">Hora de Finalizacion</label>
																<div id="event-end-at" class="input-field">
																	<i class="material-icons prefix">alarm</i>
																	<input name="end_at" type="time" value="{{ $event->end_at }}">
																</div>
															</div>
														</div>
														<input type="text" name="day" value="{{ $event->day }}" class="hide">
														<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Guardar</button>
													</form>
												</div>
											</div>
										</div>
										<form action="{{ url('event/'.$event->id) }}" method="POST" style="display:inline-block">
											{!! csrf_field() !!}
											{!! method_field('DELETE') !!}
											<button type="submit" class="btn tooltipped" href="#" data-position="right" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">delete_forever</i></button>
										</form>
									</td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			@endif
		</div>
		<div id="viernes" class="col s12">
			<div class="row center">
				<a class="waves-effect waves-light btn modal-trigger" href="#modal9">Nuevo Contenido</a>
				<div id="modal9" class="modal">
					<div class="modal-content">
						<h4>Nuevo Contenido</h4>
						<div class="row">
							<form action="{{ url('event') }}" method="POST" class="col s12">
								{!! csrf_field() !!}
								<div class="row">
									<div class="input-field col s12">
										<i class="material-icons prefix">radio</i>
										<input name="name" id="event-name" type="text">
										<label for="event-name">Nombre del Contenido</label>
									</div>
								</div>
								<div class="row">
									<div class="col s6">
										<label for="event-start-at">Hora de Inicio</label>
										<div id="event-start-at" class="input-field">
											<i class="material-icons prefix">alarm</i>
											<input name="start_at" type="time">
										</div>
									</div>
									<div class="col s6">
										<label for="event-end-at">Hora de Finalizacion</label>
										<div id="event-end-at" class="input-field">
											<i class="material-icons prefix">alarm</i>
											<input name="end_at" type="time">
										</div>
									</div>
								</div>
								<input type="text" name="day" value="5" class="hide">
								<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Crear</button>
							</form>
						</div>
					</div>
				</div>
				@include('common.errors')
			</div>
			@if (count($events) > 0)
				<table class="striped">
					<thead>
						<tr>
							<th data-field="name">Nombre</th>
							<th data-field="start_at">Inicio</th>
							<th data-field="end_at">Fin</th>
							<th data-field="actions">Acciones</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($events as $event)
							@if ($event->day == 5)
								<tr>
									<td><div>{{ $event->name }}</div></td>
									<td><div>{{ $event->start_at }}</div></td>
									<td><div>{{ $event->end_at }}</div></td>
									<td>
										<a class="waves-effect waves-light btn modal-trigger tooltipped" href="#modal10" data-position="left" data-delay="50" data-tooltip="Editar"><i class="material-icons">edit</i></a>
										<div id="modal10" class="modal">
											<div class="modal-content center">
												<h4>Editar Contenido</h4>
												<div class="row">
													<form class="col s12" action="{{ url('event/'.$event->id) }}" method="POST">
														{!! csrf_field() !!}
														{!! method_field('PUT') !!}
														<div class="row">
															<div class="input-field col s12">
																<i class="material-icons prefix">radio</i>
																<input name="name" id="event-name" type="text" class="" value="{{ $event->name }}">
																<label for="event-name">Nombre del Contenido</label>
															</div>
														</div>
														<div class="row">
															<div class="col s6">
																<label for="event-start-at">Hora de Inicio</label>
																<div id="event-start-at" class="input-field">
																	<i class="material-icons prefix">alarm</i>
																	<input name="start_at" type="time" value="{{ $event->start_at }}">
																</div>
															</div>
															<div class="col s6">
																<label for="event-end-at">Hora de Finalizacion</label>
																<div id="event-end-at" class="input-field">
																	<i class="material-icons prefix">alarm</i>
																	<input name="end_at" type="time" value="{{ $event->end_at }}">
																</div>
															</div>
														</div>
														<input type="text" name="day" value="{{ $event->day }}" class="hide">
														<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Guardar</button>
													</form>
												</div>
											</div>
										</div>
										<form action="{{ url('event/'.$event->id) }}" method="POST" style="display:inline-block">
											{!! csrf_field() !!}
											{!! method_field('DELETE') !!}
											<button type="submit" class="btn tooltipped" href="#" data-position="right" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">delete_forever</i></button>
										</form>
									</td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			@endif
		</div>
		<div id="sabado" class="col s12">
			<div class="row center">
				<a class="waves-effect waves-light btn modal-trigger" href="#modal11">Nuevo Contenido</a>
				<div id="modal11" class="modal">
					<div class="modal-content">
						<h4>Nuevo Contenido</h4>
						<div class="row">
							<form action="{{ url('event') }}" method="POST" class="col s12">
								{!! csrf_field() !!}
								<div class="row">
									<div class="input-field col s12">
										<i class="material-icons prefix">radio</i>
										<input name="name" id="event-name" type="text">
										<label for="event-name">Nombre del Contenido</label>
									</div>
								</div>
								<div class="row">
									<div class="col s6">
										<label for="event-start-at">Hora de Inicio</label>
										<div id="event-start-at" class="input-field">
											<i class="material-icons prefix">alarm</i>
											<input name="start_at" type="time">
										</div>
									</div>
									<div class="col s6">
										<label for="event-end-at">Hora de Finalizacion</label>
										<div id="event-end-at" class="input-field">
											<i class="material-icons prefix">alarm</i>
											<input name="end_at" type="time">
										</div>
									</div>
								</div>
								<input type="text" name="day" value="6" class="hide">
								<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Crear</button>
							</form>
						</div>
					</div>
				</div>
				@include('common.errors')
			</div>
			@if (count($events) > 0)
				<table class="striped">
					<thead>
						<tr>
							<th data-field="name">Nombre</th>
							<th data-field="start_at">Inicio</th>
							<th data-field="end_at">Fin</th>
							<th data-field="actions">Acciones</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($events as $event)
							@if ($event->day == 6)
								<tr>
									<td><div>{{ $event->name }}</div></td>
									<td><div>{{ $event->start_at }}</div></td>
									<td><div>{{ $event->end_at }}</div></td>
									<td>
										<a class="waves-effect waves-light btn modal-trigger tooltipped" href="#modal12" data-position="left" data-delay="50" data-tooltip="Editar"><i class="material-icons">edit</i></a>
										<div id="modal12" class="modal">
											<div class="modal-content center">
												<h4>Editar Contenido</h4>
												<div class="row">
													<form class="col s12" action="{{ url('event/'.$event->id) }}" method="POST">
														{!! csrf_field() !!}
														{!! method_field('PUT') !!}
														<div class="row">
															<div class="input-field col s12">
																<i class="material-icons prefix">radio</i>
																<input name="name" id="event-name" type="text" class="" value="{{ $event->name }}">
																<label for="event-name">Nombre del Contenido</label>
															</div>
														</div>
														<div class="row">
															<div class="col s6">
																<label for="event-start-at">Hora de Inicio</label>
																<div id="event-start-at" class="input-field">
																	<i class="material-icons prefix">alarm</i>
																	<input name="start_at" type="time" value="{{ $event->start_at }}">
																</div>
															</div>
															<div class="col s6">
																<label for="event-end-at">Hora de Finalizacion</label>
																<div id="event-end-at" class="input-field">
																	<i class="material-icons prefix">alarm</i>
																	<input name="end_at" type="time" value="{{ $event->end_at }}">
																</div>
															</div>
														</div>
														<input type="text" name="day" value="{{ $event->day }}" class="hide">
														<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Guardar</button>
													</form>
												</div>
											</div>
										</div>
										<form action="{{ url('event/'.$event->id) }}" method="POST" style="display:inline-block">
											{!! csrf_field() !!}
											{!! method_field('DELETE') !!}
											<button type="submit" class="btn tooltipped" href="#" data-position="right" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">delete_forever</i></button>
										</form>
									</td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			@endif
		</div>
		<div id="domingo" class="col s12">
			<div class="row center">
				<a class="waves-effect waves-light btn modal-trigger" href="#modal13">Nuevo Contenido</a>
				<div id="modal13" class="modal">
					<div class="modal-content">
						<h4>Nuevo Contenido</h4>
						<div class="row">
							<form action="{{ url('event') }}" method="POST" class="col s12">
								{!! csrf_field() !!}
								<div class="row">
									<div class="input-field col s12">
										<i class="material-icons prefix">radio</i>
										<input name="name" id="event-name" type="text">
										<label for="event-name">Nombre del Contenido</label>
									</div>
								</div>
								<div class="row">
									<div class="col s6">
										<label for="event-start-at">Hora de Inicio</label>
										<div id="event-start-at" class="input-field">
											<i class="material-icons prefix">alarm</i>
											<input name="start_at" type="time">
										</div>
									</div>
									<div class="col s6">
										<label for="event-end-at">Hora de Finalizacion</label>
										<div id="event-end-at" class="input-field">
											<i class="material-icons prefix">alarm</i>
											<input name="end_at" type="time">
										</div>
									</div>
								</div>
								<input type="text" name="day" value="7" class="hide">
								<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Crear</button>
							</form>
						</div>
					</div>
				</div>
				@include('common.errors')
			</div>
			@if (count($events) > 0)
				<table class="striped">
					<thead>
						<tr>
							<th data-field="name">Nombre</th>
							<th data-field="start_at">Inicio</th>
							<th data-field="end_at">Fin</th>
							<th data-field="actions">Acciones</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($events as $event)
							@if ($event->day == 7)
								<tr>
									<td><div>{{ $event->name }}</div></td>
									<td><div>{{ $event->start_at }}</div></td>
									<td><div>{{ $event->end_at }}</div></td>
									<td>
										<a class="waves-effect waves-light btn modal-trigger tooltipped" href="#modal14" data-position="left" data-delay="50" data-tooltip="Editar"><i class="material-icons">edit</i></a>
										<div id="modal14" class="modal">
											<div class="modal-content center">
												<h4>Editar Contenido</h4>
												<div class="row">
													<form class="col s12" action="{{ url('event/'.$event->id) }}" method="POST">
														{!! csrf_field() !!}
														{!! method_field('PUT') !!}
														<div class="row">
															<div class="input-field col s12">
																<i class="material-icons prefix">radio</i>
																<input name="name" id="event-name" type="text" class="" value="{{ $event->name }}">
																<label for="event-name">Nombre del Contenido</label>
															</div>
														</div>
														<div class="row">
															<div class="col s6">
																<label for="event-start-at">Hora de Inicio</label>
																<div id="event-start-at" class="input-field">
																	<i class="material-icons prefix">alarm</i>
																	<input name="start_at" type="time" value="{{ $event->start_at }}">
																</div>
															</div>
															<div class="col s6">
																<label for="event-end-at">Hora de Finalizacion</label>
																<div id="event-end-at" class="input-field">
																	<i class="material-icons prefix">alarm</i>
																	<input name="end_at" type="time" value="{{ $event->end_at }}">
																</div>
															</div>
														</div>
														<input type="text" name="day" value="{{ $event->day }}" class="hide">
														<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Guardar</button>
													</form>
												</div>
											</div>
										</div>
										<form action="{{ url('event/'.$event->id) }}" method="POST" style="display:inline-block">
											{!! csrf_field() !!}
											{!! method_field('DELETE') !!}
											<button type="submit" class="btn tooltipped" href="#" data-position="right" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">delete_forever</i></button>
										</form>
									</td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			@endif
		</div>
	</div>

@endsection