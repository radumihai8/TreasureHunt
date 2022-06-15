@extends('layouts.app')

@section('content')


    @if($room->user_id == auth()->user()->id)
        <div class="accordion mb-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Add new question
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form method="POST" action="/question">
                            @csrf
                            <input type="number" class="d-none" value="{{$room->id}}" name="room_id">
                            <div class="mb-3">
                                <label for="qInput" class="form-label">Question:</label>
                                <input type="text" class="form-control" id="qInput" name="question">
                            </div>
                            <div class="mb-3">
                                <label for="locationInput" class="form-label">First Answer:</label>
                                <input type="text" class="form-control" name="answer1">
                            </div>
                            <div class="mb-3">
                                <label for="locationInput" class="form-label">Second Answer:</label>
                                <input type="text" class="form-control" name="answer2">
                            </div>
                            <div class="mb-3">
                                <label for="locationInput" class="form-label">Third Answer:</label>
                                <input type="text" class="form-control" name="answer3">
                            </div>
                            <div class="mb-3">
                                <label for="locationInput" class="form-label">Select Correct Answer:</label>
                                <select class="form-control" name="correct_answer">
                                    <option value="1" selected>1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="locationInput" class="form-label">Value:</label>
                                <input type="number" class="form-control" name="points" value="100">
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    @endif
    <div class="alert alert-info">
        Unlock the next question by answering the current one!
    </div>

    <h1>Total points: {{$gameInfo->points()}}</h1>

    <h4>Game progress</h4>
    <div class="progress mb-5">
        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {{($questions_answered->count()/$room->questions->count())*100}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{($questions_answered->count()/$room->questions->count())*100}}%</div>
    </div>
    @foreach($room->questions->slice(0,$questions_answered->count()+1) as $question)
    <div class="accordion" id="accordionQuestions">
        <div class="accordion-item mb-3">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed {{$loop->index < $questions_answered->count() ? 'bd-teal-200' : ""}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$question->id}}" aria-expanded="false" aria-controls="collapse{{$question->id}}">
                    {{$question->question}}
                </button>
            </h2>

            <div id="collapse{{$question->id}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                @if(!$question->isAnswered())

                <div class="accordion-body">
                    <form method="post" action="/answer">
                        @csrf
                        <div class="row">

                            <input type="number" name="question_id" value="{{$question->id}}" class="d-none">
                            <div class="col">
                                <select type="select" class="form-control" name="answer">
                                    <option selected>Choose an answer</option>
                                    <option value="1">{{$question->answer1}}</option>
                                    <option value="2">{{$question->answer2}}</option>
                                    <option value="3">{{$question->answer3}}</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>

                    </form>
                </div>
                @else
                <div class="accordion-body">
                    <p>You answered this question, your hint is:</p>
                    <strong>{{$question->hint}}</strong>
                </div>
                @endif
            </div>

        </div>
    </div>
    @endforeach

    <h2>Ranking</h2>
    <table class="table table-striped table-hover">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Points</th>
        </tr>
        @foreach($ranking as $name => $points)
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$name}}</td>
                <td>{{$points}}</td>
            </tr>
        @endforeach

    </table>

@endsection
