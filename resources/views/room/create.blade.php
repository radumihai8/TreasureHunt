@extends('layouts.app')

@section('content')
<h1>Create a new room</h1>
<form method="POST" action="/rooms">
    @csrf
    <div class="mb-3">
        <label for="nameInput" class="form-label">Room Name:</label>
        <input type="text" class="form-control" id="nameInput" name="name" placeholder="name">
    </div>
    <div class="mb-3">
        <label for="locationInput" class="form-label">Location:</label>
        <input type="text" class="form-control" id="locationInput" name="location" placeholder="Bucharest">
    </div>
    <div class="mb-3">
        <label for="descriptionInput" class="form-label">Room Description:</label>
        <textarea class="form-control" id="descriptionInput" rows="4" name="description"></textarea>
    </div>
    <div class="mb-3">
        <label for="dateInput" class="form-label">Start Date:</label>
        <input type="date" class="form-control" id="dateInput" name="date" placeholder="date">
    </div>
    <div class="mb-3">
        <input type="submit" class="btn btn-primary" value="Create">
    </div>
</form>
@endsection
