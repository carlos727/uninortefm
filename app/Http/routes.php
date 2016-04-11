<?php

use App\Event;
use App\User;
use Illuminate\Http\Request;

Route::group(['middleware' => 'web'], function () {

	/*
	* Show Event Dashboard
	*/
	Route::get('/', function () {
		$events = Event::orderBy('start_at', 'asc')->get();

		$class = [
			'lunes'		=>	'active',
			'martes'	=>	' ',
			'miercoles'	=>	' ',
			'jueves'	=>	' ',
			'viernes'	=>	' ',
			'sabado'	=>	' ',
			'domingo'	=> 	' ',
			'users'		=>	' ',
			'events'	=>	'activeli',
			'day'		=>	0
		];

		return view('events', [
			'events' => $events,
			'class' => $class
		]);
	});

	/*
	* Add New Event
	*/
	Route::post('/event', function (Request $request) {

		$start_at = $request->start_at_h.":".$request->start_at_m;
		$end_at = $request->end_at_h.":".$request->end_at_m;

		$request ->merge(['start_at' => $start_at]);
		$request->merge(['end_at' => $end_at]);

		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'start_at' => ['required', 'regex:^(([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?)$^', 'before:end_at'],
			'end_at' => ['required', 'regex:^(([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?)$^'],
			'day' => 'required|integer|between:1,7'
		]);

		$validator->after(function($validator) {
			$events = Event::orderBy('start_at', 'asc')->get();

			$start_at = strtotime(array_get($validator->getData(), 'start_at', null));
			$end_at = strtotime(array_get($validator->getData(), 'end_at', null));

			$conts = 0;
			$conte =  0;
			$contover = 0;
			$continto = 0;
			foreach ($events as $event) {
				$event_start = strtotime($event->start_at);
				$event_end = strtotime($event->end_at);

				if ($start_at <= $event_start && $end_at >= $event_end) {
					$contover++;
				} elseif ($start_at > $event_start && $end_at < $event_end) {
					$continto++;
				} elseif ($start_at < $event_start && $end_at > $event_start) {
					$conte++;
				} elseif ($start_at < $event_end && $end_at > $event_end) {
					$conts++;
				}
			}

		    if ($conts > 0) {
				$validator->errors()->add('start_at', 'La hora de inicio no puede ser en medio de otro programa!');
			}

			if ($conte > 0) {
				$validator->errors()->add('end_at', 'La hora de finalización no puede ser en medio de otro programa!');
			}

			if ($contover > 0) {
				$validator->errors()->add('end_at', 'Existe otro programa en medio de este horario!');
			}

			if ($contint > 0) {
				$validator->errors()->add('end_at', 'No se puede programar un contenido durante la emisión de otro!');
			}
		});

		$class = [
			'lunes'		=>	' ',
			'martes'	=>	' ',
			'miercoles'	=>	' ',
			'jueves'	=>	' ',
			'viernes'	=>	' ',
			'sabado'	=>	' ',
			'domingo'	=>	' ',
			'users'		=>	' ',
			'events'	=>	'activeli',
			'day'		=>	0
		];

		if ($request->day == 1) {
			$class['lunes'] = 'active';
			$class['day'] = 1;
		} elseif ($request->day == 2) {
			$class['martes'] = 'active';
			$class['day'] = 2;
		} elseif ($request->day == 3) {
			$class['miercoles'] = 'active';
			$class['day'] = 3;
		} elseif ($request->day == 4) {
			$class['jueves'] = 'active';
			$class['day'] = 4;
		} elseif ($request->day == 5) {
			$class['viernes'] = 'active';
			$class['day'] = 5;
		} elseif ($request->day == 6) {
			$class['sabado'] = 'active';
			$class['day'] = 6;
		} else {
			$class['domingo'] = 'active';
			$class['day'] = 7;
		}

		if ($validator->fails()) {
			$events = Event::orderBy('start_at', 'asc')->get();

			return view('events', [
					'events' => $events,
					'class' => $class
				])
				->withErrors($validator->errors());
		}

		$event = new Event;
		$event->name = $request->name;
		$event->start_at = $request->start_at;
		$event->end_at = $request->end_at;
		$event->day = $request->day;
		$event->save();

		$events = Event::orderBy('start_at', 'asc')->get();

		return view('events', [
			'events' => $events,
			'class' => $class
		]);
	});

	/*
	* Delete Event
	*/
	Route::delete('/event/{event}', function ($id) {

		$event = DB::table('events')
					->select('day')
					->where('id','=', $id)
					->first();

		$class = [
			'lunes'		=>	' ',
			'martes'	=>	' ',
			'miercoles'	=>	' ',
			'jueves'	=>	' ',
			'viernes'	=>	' ',
			'sabado'	=>	' ',
			'domingo'	=>	' ',
			'users'		=>	' ',
			'events'	=>	'activeli',
			'day'		=>	0
		];

		if ($event->day == 1) {
			$class['lunes'] = 'active';
		} elseif ($event->day == 2) {
			$class['martes'] = 'active';
		} elseif ($event->day == 3) {
			$class['miercoles'] = 'active';
		} elseif ($event->day == 4) {
			$class['jueves'] = 'active';
		} elseif ($event->day == 5) {
			$class['viernes'] = 'active';
		} elseif ($event->day == 6) {
			$class['sabado'] = 'active';
		} else {
			$class['domingo'] = 'active';
		}

		Event::findOrFail($id)->delete();

		$events = Event::orderBy('start_at', 'asc')->get();

		return view('events', [
					'events' => $events,
					'class' => $class
				]);
	});

	/*
	* Edit Event
	*/
	Route::put('/event/{event}', function ($id, Request $request) {

		$event = Event::find($id);

		$start_at = $request->start_at_h.":".$request->start_at_m;
		$end_at = $request->end_at_h.":".$request->end_at_m;

		$request ->merge(['start_at' => $start_at]);
		$request->merge(['end_at' => $end_at]);

		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'start_at' => ['required', 'regex:^(([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?)$^', 'before:end_at'],
			'end_at' => ['required', 'regex:^(([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?)$^'],
			'day' => 'required|integer|between:1,7'
		]);

		$validator->after(function($validator) {
			$events = Event::orderBy('start_at', 'asc')->get();

			$start_at = array_get($validator->getData(), 'start_at', null);
			$end_at = array_get($validator->getData(), 'end_at', null);

			$conts = 0;
			$conte =  0;
			foreach ($events as $event) {
				if ($event->start_at < $start_at && $start_at < $event->end_at) {
					$conts++;
				}

				if ($event->start_at < $end_at && $end_at < $event->end_at) {
					$conte++;
				}
			}

		    if ($conts > 0) {
				$validator->errors()->add('start_at', 'La hora de inicio no puede ser en medio de otro programa!');
			}

			if ($conte > 0) {
				$validator->errors()->add('end_at', 'La hora de finalización no puede ser en medio de otro programa!');
			}
		});

		$class = [
			'lunes'		=>	' ',
			'martes'	=>	' ',
			'miercoles'	=>	' ',
			'jueves'	=>	' ',
			'viernes'	=>	' ',
			'sabado'	=>	' ',
			'domingo'	=>	' ',
			'users'		=>	' ',
			'events'	=>	'activeli',
			'day'		=>	0
		];

		if ($request->day == 1) {
			$class['lunes'] = 'active';
			$class['day'] = 1;
		} elseif ($request->day == 2) {
			$class['martes'] = 'active';
			$class['day'] = 2;
		} elseif ($request->day == 3) {
			$class['miercoles'] = 'active';
			$class['day'] = 3;
		} elseif ($request->day == 4) {
			$class['jueves'] = 'active';
			$class['day'] = 4;
		} elseif ($request->day == 5) {
			$class['viernes'] = 'active';
			$class['day'] = 5;
		} elseif ($request->day == 6) {
			$class['sabado'] = 'active';
			$class['day'] = 6;
		} else {
			$class['domingo'] = 'active';
			$class['day'] = 7;
		}

		if ($validator->fails()) {
			$events = Event::orderBy('start_at', 'asc')->get();

			return view('events', [
					'events' => $events,
					'class' => $class
				])
				->withErrors($validator->errors());
		}

		$event->name = $request->name;
		$event->start_at = $request->start_at;
		$event->end_at = $request->end_at;
		$event->day = $request->day;
		$event->save();

		$events = Event::orderBy('start_at', 'asc')->get();

		return view('events', [
			'events' => $events,
			'class' => $class
		]);
	});

	/*
	* Show Users Dashboard
	*/
	Route::get('/users', ['as' => 'users', function(){

		$users = User::orderBy('username','asc')->get();

		$class = [
			'users'		=>	'activeli',
			'events'	=>	' '
		];

		return view('users',[
			'users' => $users,
			'class' => $class
			]);
	}]);

	/*
	* Add New User
	*/
	Route::post('/users/user', function (Request $request) {

		$validator = Validator::make($request->all(), [
			'username'	=>	'required',
			'rol'		=>	'required'
		]);

		$validator->after(function($validator) {
			$users = User::orderBy('username', 'asc')->get();

			$username = array_get($validator->getData(), 'username', null);


			if ($users->contains('username',$username)) {
				$validator->errors()->add('username', 'Este usuario ya existe!');
			}
		});

		$class = [
			'users'		=>	'activeli',
			'events'	=>	' '
		];

		if ($validator->fails()) {
			$users = User::orderBy('username', 'asc')->get();

			return Redirect::route('users', [
					'users' => $users,
					'class' => $class
				])
				->withErrors($validator->errors());
		}

		$user = new User;
		$user->username = $request->username;
		$user->rol = $request->rol;
		$user->isActive = true;
		$user->save();

		$users = User::orderBy('username', 'asc')->get();

		return Redirect::route('users', [
					'users' => $users,
					'class' => $class
				]);
	});

	/*
	* Delete User
	*/
	Route::delete('/users/user/{user}', function ($id) {

		$class = [
			'users'		=>	'activeli',
			'events'	=>	' '
		];

		User::findOrFail($id)->delete();

		$users = User::orderBy('username', 'asc')->get();

		return Redirect::route('users', [
					'users' => $users,
					'class' => $class
				]);
	});

	/*
	* Edit User
	*/
	Route::put('/users/user/{user}', function ($id, Request $request) {

		$user = User::find($id);

		$class = [
			'users'		=>	'activeli',
			'events'	=>	' '
		];

		$user->isActive = $request->isActive;
		$user->save();

		$users = User::orderBy('username', 'asc')->get();

		return Redirect::route('users', [
					'users' => $users,
					'class' => $class
				]);
	});

	/*
	* Show all events in json format
	*/
	Route::get('/json', function(){
		$events = DB::table('events')
					->select('id', 'name', 'start_at', 'end_at', 'day')
					->get();

		return Response::json($events);
	});

	/*
	* Show events per day in json format
	*/
	Route::get('/json/lunes', function(){
		$events = DB::table('events')
					->select('id', 'name', 'start_at', 'end_at', 'day')
					->where('day','=',1)
					->get();

		return Response::json($events);
	});

	Route::get('/json/martes', function(){
		$events = DB::table('events')
					->select('id', 'name', 'start_at', 'end_at', 'day')
					->where('day','=',2)
					->get();

		return Response::json($events);
	});

	Route::get('/json/miercoles', function(){
		$events = DB::table('events')
					->select('id', 'name', 'start_at', 'end_at', 'day')
					->where('day','=',3)
					->get();

		return Response::json($events);
	});

	Route::get('/json/jueves', function(){
		$events = DB::table('events')
					->select('id', 'name', 'start_at', 'end_at', 'day')
					->where('day','=',4)
					->get();

		return Response::json($events);
	});

	Route::get('/json/viernes', function(){
		$events = DB::table('events')
					->select('id', 'name', 'start_at', 'end_at', 'day')
					->where('day','=',5)
					->get();

		return Response::json($events);
	});

	Route::get('/json/sabado', function(){
		$events = DB::table('events')
					->select('id', 'name', 'start_at', 'end_at', 'day')
					->where('day','=',6)
					->get();

		return Response::json($events);
	});

	Route::get('/json/domingo', function(){
		$events = DB::table('events')
					->select('id', 'name', 'start_at', 'end_at', 'day')
					->where('day','=',7)
					->get();

		return Response::json($events);
	});

});