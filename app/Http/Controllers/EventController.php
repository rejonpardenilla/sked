<?php

namespace sked\Http\Controllers;

use Illuminate\Http\Request;
use sked\Date;
use sked\Event;
use sked\Guest;
use Mail;
use Session;

class EventController extends Controller
{


    public function store(Request $request)
    {

        return view('sked.order', ['guests' => [], 'dates' => [], 'event' => []]);
        $this->validate($request,
            [
                'guests' => 'required',
                'dates' => 'required',
            ],
            [
                'required' => 'At least one :attribute must be added'
            ]
        );

        if(!$request['guests'] || !!$request['dates']){

        }

        $event = new Event();

        $event->name = $request['eventName'];
        $event->username = $request['userName'];
        $event->email = $request['email'];
        $event->deadline = $request['deadline'];

        $event->save();

        foreach ($request['guests'] as $person) {

            $guest = new Guest();

            $guest->event_id = $event->id;
            $guest->name = $person['name'];
            $guest->email = $person['email'];

            $guest->save();

        }

        foreach ($request['dates'] as $time) {

            $date = new Date();

            $date->event_id = $event->id;
            $date->date = $time['date'];
            $date->time = $time['time'];

            $date->save();
        }

        $guests = Guest::where('event_id', '=', $event->id)->get();
        $dates = Date::where('event_id', '=', $event->id)->get();


        return view('sked.order', ['guests' => $guests, 'dates' => $dates, 'event' => $event]);

    }

    public function order(Request $request)
    {

        return response('Store in the server', 200);

    }

    private function updateDateValoration($dates)
    {

        $datesCount = count($dates);

        foreach ($dates as $id_date) {

            $date = Date::findOrFail($id_date);

                $date->valoration = $datesCount;

                $date->update();

                $datesCount--;

        }

    }

    private function notifyGuests($event_id)
    {
        $guests = Guest::where('event_id', '=', $event_id)->get();

        foreach ($guests as $guest){

            $url = 'www.localhost:8000/guest?guestid='.$guest->id.'&eventid='.$event_id;

            Mail::send('email.invitation', ['event' => Event::findOrFail($event_id),
            'url' => $url], function($ms) use ($guest){

                $ms->subject('Correo');
                $ms->to($guest->email);
            });

        }

    }

}
