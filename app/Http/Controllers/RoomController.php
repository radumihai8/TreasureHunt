<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Room;
use App\Models\RoomUser;
use App\Models\User;
use App\Models\UserQuestion;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    public function index()
    {
        return view('room.index', [
            'rooms' => Room::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('room.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'location' => 'string|max:255',
            'description' => 'string|max:10000',
            'date' => 'date',
        ]);

        $room = new Room();
        $room->user_id = auth()->user()->id;
        $room->name = $validated['name'];
        $room->location = $validated['location'];
        $room->description = $validated['description'];
        $room->date = $validated['date'];

        if($room->save())
            return back()->with('success', 'Room created!');
        else
            return back()->with('error', 'Error!');
    }


    public function show(Room $room)
    {
        if(!auth()->user()->rooms->find($room->id))
            return back()->with('error','You are not part of this room!');
        $gameInfo = RoomUser::where([
            'user_id' => auth()->user()->id,
            'room_id' => $room->id
        ])->first();

        $ranking = [];

        foreach(RoomUser::all() as $player)
            $ranking[User::find($player->user_id)->name] = $player->points();

        //Sort the raking array by points
        ksort($ranking);


        return view('room.show', ['ranking'=>$ranking,'room'=>$room, 'gameInfo' => $gameInfo, 'questions_answered' => UserQuestion::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
