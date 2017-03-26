<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/create', function () {
    return view('sked.create');
});

Route::get('/prueba', function () {
    $dates = \sked\Date::where('event_id', '=', '1237')->get();

    return $dates;
});

Route::post('/order/store', 'EventController@order');

Route::post('/order', 'EventController@store');

Route::get('/view2', function(){

    return view('sked.order', ['guests' => [], 'dates' => [], 'event' => []]);
});

Route::get('/view3', function(){

    return view('sked.guest', ['guests' => [], 'dates' => [], 'event' => []]);
});

Route::get('/clean', function (){

    $events = \sked\Event::all();
    foreach ($events as $e){
        $e->delete();
    }

    $dates = \sked\Date::all();
    foreach ($dates as $d){
        $d->delete();
    }

    $guests = \sked\Guest::all();
    foreach( $guests as $g){
        $g->delete();
    }

});

Route::get('/guest', 'GuestController@order');

Route::post('/guest/store', 'GuestController@store');

