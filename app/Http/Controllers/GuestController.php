<?php

namespace sked\Http\Controllers;

use Illuminate\Http\Request;
use sked\Date;
use sked\Event;
use sked\Guest;
use Mail;

class GuestController extends Controller
{


    public function order(Request $request)
    {

        $guest_id = $request['guestid'];
        $guest = Guest::findOrFail($guest_id);

        if ($guest->already_sked == 1) {
            return view('sked/alreadySked');
        }

        $event_id = $request['eventid'];
        $event = Event::findOrFail($event_id);

        $dates = Date::where('event_id', '=', $event->id)->get();

        return view('sked/guest', ['guest' => $guest, 'event' => $event, 'dates' => $dates]);

    }

    public function store(Request $request)
    {

        $dates_id = $request['dates'];
        $guest = Guest::findOrFail($request['guestId']);
        $event = Event::findOrFail($request['eventId']);

        if ($guest->already_sked == 1) {
            return view('sked/alreadySked');
        }

        $date_valoration = count(Date::where('event_id', '=', $event->id)->get());

        if ($request['dates']) {

            foreach ($dates_id as $id) {

                $date = Date::findOrFail($id);

                if ($date->valoration > 0) {
                    $date->valoration += $date_valoration;
                    $date->update();
                }

                $date_valoration--;

            }
        }

        if ($guest->required == 1 && $request['disabledDates']) {

            $disabled_dates_id = $request['disabledDates'];

            foreach ($disabled_dates_id as $id) {

                $date = Date::findOrFail($id);
                $date->valoration = -1;

                $date->update();

            }
        }

        $guest->already_sked = 1;
        $guest->update();

        if ($this->isSkedComplete($event->id)) {
            $this->notifyAdmin($event->id);
        }

        return $request->all();

    }

    private function isSkedComplete($event_id)
    {

        $guests = Guest::where('already_sked', '=', '0')->get();

        if($guests == []){
            return false;
        }
        else{
            return true;
        }
    }

    private function notifyAdmin($event_id)
    {

        $event = Event::findOrFail($event_id);

        $dates = Date::where('event_id', '=', $event->id);

        $posible_nice_dates = $dates->where('valoration', '>', '0')->get();

        if($posible_nice_dates == []) {

            $max_value = $dates->max('valoration');
            $nice_dates = $dates->where('valoration', '=', $max_value)->get();

            Mail::send('email.finalization', ['event' => $event, 'dates' => $nice_dates], function ($ms) use ($event) {

                $ms->subject('Sked is finish');
                $ms->to($event->email);
            });

        }
        else{
            Mail::send('email.badFinalization', ['event' => $event], function ($ms) use ($event) {

                $ms->subject('Sked is finish');
                $ms->to($event->email);
            });
        }

    }

}
