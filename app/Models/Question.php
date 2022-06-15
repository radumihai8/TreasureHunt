<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function isAnswered(){
        if(UserQuestion::where('question_id',$this->id)->where('user_id', auth()->user()->id)->exists())
            return True;
        return False;
    }
}
