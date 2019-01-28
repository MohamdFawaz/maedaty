<?php

namespace App\Http\Controllers\Frontend;

use App\Events\MessageDelivered;
use App\Models\Message\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index(){
        $messages = Message::get();
        return view('frontend.pages.message.index', compact('messages'));
    }

    public function store(Request $request){
        $messages = Message::create([
            'user_id' => $request->user_id,
            'body' => $request->body
        ]);
        broadcast(new MessageDelivered($messages))->toOthers();
        return 1;
    }


}
