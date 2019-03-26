@extends('layouts.base')
@section('content')
    @if ($errors->any())
    <div class="alert alert-danger" style="margin: 4px;">
        <ul style="list-style: none;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{route('sessions.update', $session->id)}}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Session Name</label>
            <input name="name" type="text" class="form-control" id="name"  placeholder="Enter Session Name" value="{{$session->name}}">
        </div>
        <div class="form-group">
            <label for="number_of_sessions">Day</label>
        <input type="date" name="day" class="form-control" value="{{$session->day}}">
        </div>
        <div class="form-group">
            <label for="start_at">Starts At</label>
            <input class="form-control" type="time" name="start_at" id="start_at" value="{{$session->start_at}}">
        </div>
        <div class="form-group">
            <label for="finish_at">Finishes At</label>
            <input class="form-control" type="time" name="finish_at" id="finish_at" value="{{$session->finish_at}}">
        </div>
        <div class="form-group">
            <label for="price">Price (usd) </label>
            <input class="form-control" type="number" name="price" id="price" value="{{$session->price}}">
        </div>
        <div  class="form-group">
            <label for="gym_id">Gym</label>
            <select class="form-control" name="gym_id">
                @foreach($gyms as $gym)
                @if ($gym->id == $session->gym_id)
                    <option value="{{$gym->id}}" selected>{{$gym->name}}</option>
                    @else
                    <option value="{{$gym->id}}">{{$gym->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div  class="form-group">
            <label for="coach_id">Gym</label>
            <select class="form-control" name="coach_id">
                @foreach($coaches as $coach)
                @if ($coach->id == $session->coach_id)
                    <option value="{{$coach->id}}">{{$coach->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        

    <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection