@extends('layouts.app')

@section('content')

	<header>
		<div class="row">
			<h2 class="center">Gestor de Contenidos Uninorte FM</h2>
			<div class="divider"></div>
		</div>
	</header>

	<div class="row">
		<div class="col s12">
			<ul class="tabs">
				<li class="tab col s1"><a class="{{{ $class['lunes'] }}}" href="#tab1">Lunes</a></li>
				<li class="tab col s1"><a class="{{{ $class['martes'] }}}" href="#tab2">Martes</a></li>
				<li class="tab col s1"><a class="{{{ $class['miercoles'] }}}" href="#tab3">Miercoles</a></li>
				<li class="tab col s1"><a class="{{{ $class['jueves'] }}}" href="#tab4">Jueves</a></li>
				<li class="tab col s1"><a class="{{{ $class['viernes'] }}}" href="#tab5">Viernes</a></li>
				<li class="tab col s1"><a class="{{{ $class['sabado'] }}}" href="#tab6">Sabado</a></li>
				<li class="tab col s1"><a class="{{{ $class['domingo'] }}}" href="#tab7">Domingo</a></li>
			</ul>
			<div class="divider"></div>
		</div>
		@for ($i = 1; $i <= 7; $i++)
			<div id="tab{{ $i }}" class="col s12">
				<div class="row center">
					<a class="waves-effect waves-light btn modal-trigger" href="#modal{{ $i }}">Nuevo Contenido</a>
					<div id="modal{{ $i }}" class="modal">
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
											<div id="event-start-at">
												<div class="row dv-time">
													<div class="col s1"><i class="material-icons prefix">alarm</i></div>
													<div class="col s3 offset-s1">
														<select name="start_at_h">
															<option value="00" selected="selected">00</option>
															<option value="01">01</option>
															<option value="02">02</option>
															<option value="03">03</option>
															<option value="04">04</option>
															<option value="05">05</option>
															<option value="06">06</option>
															<option value="07">07</option>
															<option value="08">08</option>
															<option value="09">09</option>
															<option value="10">10</option>
															<option value="11">11</option>
															<option value="12">12</option>
															<option value="13">13</option>
															<option value="14">14</option>
															<option value="15">15</option>
															<option value="16">16</option>
															<option value="17">17</option>
															<option value="18">18</option>
															<option value="19">19</option>
															<option value="20">20</option>
															<option value="21">21</option>
															<option value="22">22</option>
															<option value="23">23</option>
														</select>
													</div>
													<div class="col s1 offset-s1"><p>:</p></div>
													<div class="col s3">
														<select name="start_at_m">
															<option value="00" selected="selected">00</option>
															<option value="15">15</option>
															<option value="30">30</option>
															<option value="45">45</option>
															<option value="59">59</option>
														</select>
													</div>
												</div>
												<input name="start_at" type="time" class="hide" value=" ">
											</div>
										</div>
										<div class="col s6">
											<label for="event-end-at">Hora de Finalizacion</label>
											<div id="event-end-at">
												<div class="row dv-time">
													<div class="col s1"><i class="material-icons">alarm</i></div>
													<div class="col s3 offset-s1">
														<select name="end_at_h">
															<option value="00" selected="selected">00</option>
															<option value="01">01</option>
															<option value="02">02</option>
															<option value="03">03</option>
															<option value="04">04</option>
															<option value="05">05</option>
															<option value="06">06</option>
															<option value="07">07</option>
															<option value="08">08</option>
															<option value="09">09</option>
															<option value="10">10</option>
															<option value="11">11</option>
															<option value="12">12</option>
															<option value="13">13</option>
															<option value="14">14</option>
															<option value="15">15</option>
															<option value="16">16</option>
															<option value="17">17</option>
															<option value="18">18</option>
															<option value="19">19</option>
															<option value="20">20</option>
															<option value="21">21</option>
															<option value="22">22</option>
															<option value="23">23</option>
														</select>
													</div>
													<div class="col s1 offset-s1"><p>:</p></div>
													<div class="col s3 dv-time">
														<select name="end_at_m">
															<option value="00" selected="selected">00</option>
															<option value="15">15</option>
															<option value="30">30</option>
															<option value="45">45</option>
															<option value="59">59</option>
														</select>
													</div>
												</div>
												<input name="end_at" type="time" class="hide" value=" ">
											</div>
										</div>
									</div>
									<input type="text" name="day" value="{{ $i }}" class="hide">
									<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Crear</button>
								</form>
							</div>
						</div>
					</div>
					{{{ $d = $day }}}
					@if ( $i == $d )
						@include('common.errors')
					@endif
				</div>
				@if (count($events) > 0)
					<table class="striped">
						<?php $a=0 ?>
						@foreach ($events as $event)
							@if ($event->day == $i)
								<?php $a++; ?>
							@endif
						@endforeach

						<thead>
							<?php if ($a > 0) { ?>
								<tr>
									<th data-field="name">Nombre</th>
									<th data-field="start_at">Inicio</th>
									<th data-field="end_at">Fin</th>
									<th data-field="actions">Acciones</th>
								</tr>
							<?php } ?>
						</thead>

						<tbody>
							@foreach ($events as $event)
								@if ($event->day == $i)
									<tr>
										<td><div>{{ $event->name }}</div></td>
										<td><div>{{ $event->start_at }}</div></td>
										<td><div>{{ $event->end_at }}</div></td>
										<td>
											<a class="waves-effect waves-light btn modal-trigger tooltipped" href="#modet{{ $event->id }}" data-position="left" data-delay="50" data-tooltip="Editar"><i class="material-icons">edit</i></a>
											<div id="modet{{ $event->id }}" class="modal">
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
																	<div id="event-start-at">
																		<div class="row dv-time">
																			<div class="col s1"><i class="material-icons prefix">alarm</i></div>
																			<div class="col s3 offset-s1">
																				{{ Form::select('start_at_h', [
																					'00' => '00',
																					'01' => '01',
																					'02' => '02',
																					'03' => '03',
																					'04' => '04',
																					'05' => '05',
																					'06' => '06',
																					'07' => '07',
																					'08' => '08',
																					'09' => '09',
																					'10' => '10',
																					'11' => '11',
																					'12' => '12',
																					'13' => '13',
																					'14' => '14',
																					'15' => '15',
																					'16' => '16',
																					'17' => '17',
																					'18' => '18',
																					'19' => '19',
																					'20' => '20',
																					'21' => '21',
																					'22' => '22',
																					'23' => '23'
																				], substr($event->start_at,0,2) ) }}
																			</div>
																			<div class="col s1 offset-s1"><p>:</p></div>
																			<div class="col s3">
																				{{ Form::select('start_at_m', [
																					'00' => '00',
																					'15' => '15',
																					'30' => '30',
																					'45' => '45',
																					'59' => '59'
																				], substr($event->start_at,3) ) }}
																			</div>
																		</div>
																		<input name="start_at" type="time" class="hide" value=" ">
																	</div>
																</div>
																<div class="col s6">
																	<label for="event-end-at">Hora de Finalizacion</label>
																	<div id="event-end-at">
																		<div class="row dv-time">
																			<div class="col s1"><i class="material-icons">alarm</i></div>
																			<div class="col s3 offset-s1">
																				{{ Form::select('end_at_h', [
																					'00' => '00',
																					'01' => '01',
																					'02' => '02',
																					'03' => '03',
																					'04' => '04',
																					'05' => '05',
																					'06' => '06',
																					'07' => '07',
																					'08' => '08',
																					'09' => '09',
																					'10' => '10',
																					'11' => '11',
																					'12' => '12',
																					'13' => '13',
																					'14' => '14',
																					'15' => '15',
																					'16' => '16',
																					'17' => '17',
																					'18' => '18',
																					'19' => '19',
																					'20' => '20',
																					'21' => '21',
																					'22' => '22',
																					'23' => '23'
																				], substr($event->end_at,0,2) ) }}
																			</div>
																			<div class="col s1 offset-s1"><p>:</p></div>
																			<div class="col s3">
																				{{ Form::select('end_at_m', [
																					'00' => '00',
																					'15' => '15',
																					'30' => '30',
																					'45' => '45',
																					'59' => '59'
																				], substr($event->end_at,3) ) }}
																			</div>
																		</div>
																		<input name="end_at" type="time" class="hide" value=" ">
																	</div>
																</div>
															</div>
															<input type="text" name="day" value="{{ $event->day }}" class="hide">
															<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Guardar</button>
														</form>
													</div>
												</div>
											</div>
											<a id="btndlt"  class="waves-effect waves-light btn modal-trigger tooltipped" href="#model{{ $event->id }}" data-position="right" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">delete_forever</i></a>
											<div id="model{{ $event->id }}" class="modal">
												<div class="modal-content">
													<h4 class="center">Eliminar Contenido</h4>
													<div class="row">
														<div class="col s4 center"><img src="{{ URL::asset('img/Icon-warning.png') }}" alt=""></div>
														<div id="del-cont" class="col s8">
															<p><b>¿Estas seguro de borrar este contenido?</b></p>
															<p>Nombre: {{ $event->name }}</p>
															<p>Hora de Inicio: {{ $event->start_at }}</p>
															<p>Hora de Finalizacion: {{ $event->end_at }}</p>
															<p>Dia: 
																@if ($event->day == 1)
																	Lunes
																@elseif ($event->day == 2)
																	Martes
																@elseif ($event->day == 3)
																	Miercoles
																@elseif ($event->day == 4)
																	Jueves
																@elseif ($event->day == 5)
																	Viernes
																@elseif ($event->day == 6)
																	Sabado
																@else
																	Domingo
																@endif
															</p>
														</div>
													</div>
													<form action="{{ url('event/'.$event->id) }}" method="POST" class="center">
														{!! csrf_field() !!}
														{!! method_field('DELETE') !!}
														<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Eliminar</button>
													</form>
												</div>
											</div>
										</td>
									</tr>
								@endif
							@endforeach
						</tbody>
					</table>
				@endif
			</div>
		@endfor
	</div>

@endsection