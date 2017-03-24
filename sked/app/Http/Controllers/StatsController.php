<?php

namespace sked\Http\Controllers;

use Illuminate\Http\Request;
use sked\Comment;
use sked\Event;
use sked\Guest;
use sked\Visit;

class StatsController extends Controller
{

    public function show() {

        $visits = Visit::all();
        $creators = Event::select(['name', 'email'])->get()->unique('email');
        $guests = Guest::select(['name', 'email'])->get()->unique('email');

        $totalGuest = Guest::all()->count();
        $guestsResponses = Guest::where('already_sked', '1')->count();

        $responseRate = ($guestsResponses/$totalGuest)*100;
        $responseRate = number_format($responseRate, 2);

        $creatorsCount = [];

        foreach ($creators as $creator){

            $repetitions = Event::where('email', $creator['email'])->count();
            $row = ['name' => $creator['name'], 'email' => $creator['email'], 'count' => $repetitions];
            array_push($creatorsCount, $row);

        }

        return view('admin.stats',
            [
                'visits' => $visits,
                'creators' => $creators,
                'guests' => $guests,
                'responseRate' => $responseRate,
                'creatorsCount' => $creatorsCount
            ]);

    }

    public function store(Request $request){

        $comment = new Comment();
        $comment->email = $request['email'];
        $comment->comment = $request['comment'];
        $comment->date = date('Y-m-d');

        $comment->save();

    }

    public function index(){

        $comments = Comment::all();

        return view('admin.comments', ['comments' => $comments]);

    }


}
