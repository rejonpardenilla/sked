<?php

namespace sked\Http\Controllers;

use Illuminate\Http\Request;
use sked\Date;
use sked\Event;
use sked\Guest;
use Mail;
use Session;

class EmailSender
{

    public static function notifyAdmin($event_id)
    {

        $event_dates = Date::where('event_id', '=', $event_id);
        $event = Event::findOrFail($event_id);

        $possible_dates = $event_dates->where('valoration', '>', '0')
            ->where('assistance', '>', 1)->get();

        $absents_guests_required = Guest::where('event_id', '=', $event_id)
            ->where('required', '=', '1')
            ->where('already_sked', '=', '0')->get();

        if((!$possible_dates->isEmpty()) and $absents_guests_required->isEmpty()) {

            $max_assistance = $possible_dates->max('assistance');
            $more_assistance_dates = $possible_dates->where('assistance', '=', $max_assistance);

            $max_valoration = $more_assistance_dates->max('valoration');
            $best_dates = $more_assistance_dates->where('valoration', '=', $max_valoration);

            Mail::send('email.finalization', ['event' => $event, 'dates' => $best_dates], function ($ms) use ($event) {

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

    public static function notifyGuests($event_id)
    {
        $guests = Guest::where('event_id', '=', $event_id)->get();

        foreach ($guests as $guest){

            $url = 'dev.sked.es/guest?guestid='.$guest->id.'&eventid='.$event_id;

            Mail::send('email.invitation', ['event' => Event::findOrFail($event_id),
                'url' => $url], function($ms) use ($guest){

                $ms->subject('You are invited to sked in a event');
                $ms->to($guest->email);
            });

        }

    }



}