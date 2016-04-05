<?php

use App\Event;
use Illuminate\Http\Request;

Route::group(['middleware' => 'web'], function () {

	/*
	* Show Event Dashboard
	*/
	Route::get('/', function () {
		$events = Event::orderBy('start_at', 'asc')->get();

		$class = [
			'lunes'		=>	'active',
			'martes'	=>	'',
			'miercoles'	=>	'',
			'jueves'	=>	'',
			'viernes'	=>	'',
			'sabado'	=>	'',
			'domingo'	=> ''
		];

		return view('events', [
			'events' => $events
		], [
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
					->select('id', 'name', 'start_at', 'end_at')
					->where('day','=',1)
					->get();

		return Response::json($events);
	});

	Route::get('/json/martes', function(){
		$events = DB::table('events')
					->select('id', 'name', 'start_at', 'end_at')
					->where('day','=',2)
					->get();

		return Response::json($events);
	});

	Route::get('/json/miercoles', function(){
		$events = DB::table('events')
					->select('id', 'name', 'start_at', 'end_at')
					->where('day','=',3)
					->get();

		return Response::json($events);
	});

	Route::get('/json/jueves', function(){
		$events = DB::table('events')
					->select('id', 'name', 'start_at', 'end_at')
					->where('day','=',4)
					->get();

		return Response::json($events);
	});

	Route::get('/json/viernes', function(){
		$events = DB::table('events')
					->select('id', 'name', 'start_at', 'end_at')
					->where('day','=',5)
					->get();

		return Response::json($events);
	});

	Route::get('/json/sabado', function(){
		$events = DB::table('events')
					->select('id', 'name', 'start_at', 'end_at')
					->where('day','=',6)
					->get();

		return Response::json($events);
	});

	Route::get('/json/domingo', function(){
		$events = DB::table('events')
					->select('id', 'name', 'start_at', 'end_at')
					->where('day','=',7)
					->get();

		return Response::json($events);
	});

	/*
	* Add New Event
	*/
	Route::post('/event', function ($class, Request $request) {

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

		$class = [
			'lunes'		=>	'',
			'martes'	=>	'',
			'miercoles'	=>	'',
			'jueves'	=>	'',
			'viernes'	=>	'',
			'sabado'	=>	'',
			'domingo'	=> ''
		];

		if ($request->day == 1) {
			$class['lunes'] = 'active';
		} elseif ($request->day == 2) {
			$class['martes'] = 'active';
		} elseif ($request->day == 3) {
			$class['miercoles'] = 'active';
		} elseif ($request->day == 4) {
			$class['jueves'] = 'active';
		} elseif ($request->day == 5) {
			$class['viernes'] = 'active';
		} elseif ($request->day == 6) {
			$class['sabado'] = 'active';
		} else {
			$class['domingo'] = 'active';
		}

		if ($validator->fails()) {
			return redirect('/', [
						'class' => $class
					])
				->withInput()
				->withErrors($validator->errors());
		}

		$event = new Event;
		$event->name = $request->name;
		$event->start_at = $request->start_at;
		$event->end_at = $request->end_at;
		$event->day = $request->day;
		$event->save();

		return redirect('/', [
			'class' => $class
		]);
	});

	/*
	* Delete Event
	*/
	Route::delete('/event/{event}', function ($class, Event $event) {
		$class = [
			'lunes'		=>	'',
			'martes'	=>	'',
			'miercoles'	=>	'',
			'jueves'	=>	'',
			'viernes'	=>	'',
			'sabado'	=>	'',
			'domingo'	=> ''
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

		$event->delete();

		return redirect('/', [
			'class' => $class
		]);
	});

	Route::put('/event/{event}', function ($id, $class, Request $request) {
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

		$class = [
			'lunes'		=>	'',
			'martes'	=>	'',
			'miercoles'	=>	'',
			'jueves'	=>	'',
			'viernes'	=>	'',
			'sabado'	=>	'',
			'domingo'	=> ''
		];

		if ($request->day == 1) {
			$class['lunes'] = 'active';
		} elseif ($request->day == 2) {
			$class['martes'] = 'active';
		} elseif ($request->day == 3) {
			$class['miercoles'] = 'active';
		} elseif ($request->day == 4) {
			$class['jueves'] = 'active';
		} elseif ($request->day == 5) {
			$class['viernes'] = 'active';
		} elseif ($request->day == 6) {
			$class['sabado'] = 'active';
		} else {
			$class['domingo'] = 'active';
		}

		if ($validator->fails()) {
			$events = Event::orderBy('start_at', 'asc')->get();
			return redirect('/', [
						'class' => $class
					])
				->withInput()
				->withErrors($validator->errors());
		}

		$event->name = $request->name;
		$event->start_at = $request->start_at;
		$event->end_at = $request->end_at;
		$event->day = $request->day;
		$event->save();

		return redirect('/', [
			'class' => $class
		]);
	});

});
