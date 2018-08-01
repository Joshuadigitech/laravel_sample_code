<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Message;
use App\Room;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        if (Auth::User()->id == $id) {
            return redirect()->back();
        }
        $room_id = DB::table('rooms')->select('id')->where(function ($query) use ($id) {
            $query->where('user1', '=', $id)->where('user2', '=', Auth::User()->id);
        })
            ->orWhere(function ($query) use ($id) {
                $query->where('user2', '=', $id)->where('user1', '=', Auth::User()->id);
            })
            ->first();
        if ($room_id == null) {
            $newRoom = new Room();
            $newRoom->user1 = Auth::User()->id;
            $newRoom->user2 = $id;
            $newRoom->save();
            $room_id = $newRoom;
        }
        $chattingWith = User::find($id);
        return view('chat', compact('room_id', 'chattingWith'));
    }
    function list() {
        $users = User::all();
        return view('list', compact('users'));
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
        return Message::with('user')->get();
        //return Message::with('user')->where('room_id','=',Auth::User()->messages()->first()->room_id)->get();
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $message = $user->messages()->create([
            'message' => $request->input('message'),
            'room_id' => $request->input('room_id'),
        ]);
        broadcast(new MessageSent($user, $message))->toOthers();
        return ['status' => 'Message Sent!'];
    }
}
