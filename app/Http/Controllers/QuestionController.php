<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Room;
use App\Models\RoomUser;
use App\Models\UserQuestion;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function answer(Request $request){
        $validated = $request->validate([
            'answer' => 'integer|max:3',
            'question_id' => 'integer'
        ]);

        $question = Question::find($validated['question_id']);
        $gameInfo = RoomUser::where([
            'user_id' => auth()->user()->id,
            'room_id' => $question->room_id
        ])->first();

        if($question->correct_answer == $validated['answer']){
            $gameInfo->increment('questions_unlocked', 1);
            $userQuestion = new UserQuestion();
            $userQuestion->user_id = auth()->user()->id;
            $userQuestion->room_id = $question->room_id;
            $userQuestion->question_id = $question->id;
            $userQuestion->save();
            return back()->with('success', 'Correct Answer!');

        }else{
            $gameInfo->increment('penalty', 50);
            return back()->with('error', 'Wrong answer! -50 points');
        }


    }

    public function store(Request $request){
        $validated = $request->validate([
            'room_id' => 'integer|exists:rooms,id',
            'question' => 'string',
            'answer1' => 'string',
            'answer2' => 'string',
            'answer3' => 'string',
            'correct_answer' => 'integer|max:3',
            'points' => 'integer',
        ]);
        $room = Room::find($validated['room_id']);

        if($room->user_id != auth()->user()->id)
            return response('Unautorized!', 401);

        $question = new Question();
        $question->room_id = $validated['room_id'];
        $question->question = $validated['question'];
        $question->answer1 = $validated['answer1'];
        $question->answer2 = $validated['answer2'];
        $question->answer3 = $validated['answer3'];
        $question->correct_answer = $validated['correct_answer'];
        $question->points = $validated['points'];
        if($question->save())
            return back()->with('success', 'Question created!');
        else
            return back()->with('error', 'Question not created!');

    }
}
