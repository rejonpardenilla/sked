<?php

namespace sked\Http\Controllers;

use Illuminate\Http\Request;
use sked\Comment;
use sked\Event;
use sked\Guest;

class CommentController extends Controller
{

    public function show($type, $id) {

        $email = '';

        if($type == 'admin'){
            $event = Event::findOrFail($id);
            $email = $event->email;
        }

        elseif ($type == 'guest'){
            $guest = Guest::findOrFail($id);
            $email = $guest->email;
        }

        return redirect('/success')->with(['email' => $email]);

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
