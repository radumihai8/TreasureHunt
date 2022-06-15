@extends('layouts.app')


@section('content')
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>Created By</th>
            <th>Date</th>
            <th>Location</th>
            <th>Action</th>
        </tr>
        @foreach($rooms as $room)
            <tr>
                <td><a href="/rooms/{{$room->id}}">{{$room->name}}</a></td>
                <td>{{$room->owner->name}}</td>
                <td>{{$room->date}}</td>
                <td>{{$room->location}}</td>
                <td>
                    @if($room->date->isPast())
                        Room ended
                        @else
                            @if(!auth()->user()->rooms->find($room->id))
                                <form method="POST" action="/game">
                                    @csrf
                                    <input type="number" class="d-none" name="room_id" value="{{$room->id}}">
                                    <input type="submit" class="btn btn-success" value="Join">
                                </form>
                            @else
                                <a href="/rooms/{{$room->id}}" class="btn btn-primary">View</a>
                            @endif
                    @endif

                </td>
            </tr>

        @endforeach
    </table>

@endsection
