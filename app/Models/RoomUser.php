<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomUser extends Model
{
    use HasFactory;

    protected $table = 'user_room';

    public $timestamps = False;
    public $guarded = [];

    public function points(){
        $answered = UserQuestion::where('user_id', auth()->user()->id)->where('room_id', $this->room_id)->get();
        $sum = 0;
        foreach($answered as $answer){
            $sum += Question::find($answer->question_id)->points;
        }
        return $sum;
    }
}
