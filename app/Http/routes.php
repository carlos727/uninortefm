<?php

use App\Event;
use Illuminate\Http\Request;

Route::group(['middleware' => 'web'], function () {

	/*
	* Show Event Dashboard
	*/
	Route::get('/', function () {
		$events = Event::orderBy('start_at', 'asc')->get();

		return view('events', [
			'events' => $events
		]);
	});

	Route::get('/request-json-model', function(){
		return Event::all();
	});

	/*
	* Add New Event
	*/
	Route::post('/event', function (Request $request) {
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'start_at' => ['required', 'regex:^(([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?)$^', 'before:end_at'],
			'end_at' => ['required', 'regex:^(([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?)$^'],
			'day' => 'required|integer|between:1,7'
		]);

		if ($validator->fails()) {
			return redirect('/')
				->withInput()
				->withErrors($validator->errors());
		}

		$event = new Event;
		$event->name = $request->name;
		$event->start_at = $request->start_at;
		$event->end_at = $request->end_at;
		$event->day = $request->day;
		$event->save();

		return redirect('/');
	});

	/*
	* Delete Event
	*/
	Route::delete('/event/{event}', function (Event $event) {
		$event->delete();

		return redirect('/');
	});

	Route::put('/event/{event}', function ($id, Request $request) {
		$event = Event::find($id);

		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'start_at' => ['required', 'regex:^(([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?)$^', 'before:end_at'],
			'end_at' => ['required', 'regex:^(([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?)$^'],
			'day' => 'required|integer|between:1,7'
		]);

		if ($validator->fails()) {
			return redirect('/')
				->withInput()
				->withErrors($validator->errors());
		}

		$event->name = $request->name;
		$event->start_at = $request->start_at;
		$event->end_at = $request->end_at;
		$event->day = $request->day;
		$event->save();

		return redirect('/');
	});

});
