<?php

namespace App\Http\Controllers;

use App\Events\MessageSend;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

class ChatController extends Controller
{
    public function show(User $user){
        return view('chat',compact('user'));
    }

    public function getMessages(User $user){
        return Message::query()
        ->where(function ($query) use($user){
                $query->where('sender_id', auth()->id())
                ->where('receiver_id',$user->id);
            })
            ->orWhere(function ($query) use($user){
                $query->where('sender_id', $user->id)
                ->where('receiver_id',auth()->id());
            })
            ->with('sender','receiver')
            ->orderBy('created_at','asc')
            ->get();
    }
    public function sendMessage(User $user){
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'text' => request('message'),
        ]);
        Broadcast(new MessageSend($message));
        return response()->json($message);
    }
}
