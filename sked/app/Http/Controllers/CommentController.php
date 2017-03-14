<?php

namespace sked\Http\Controllers;

use Illuminate\Http\Request;
use sked\Comment;
use sked\Event;

class CommentController extends Controller
{

    public function show($event_id) {

        $event = Event::findOrFail($event_id);
        $email = $event->email;

        return redirect('/success')->with(['email' => $email]);

    }

    public function store(Request $request){

        $comment = new Comment();
        $comment->email = $request['email'];
        $comment->comment = $request['comment'];
        $comment->date = date('Y-m-d');

        $comment->save();

    }


}
