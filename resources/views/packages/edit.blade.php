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
    <form action="{{route('packages.update', $package->id)}}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Package Name</label>
            <input name="name" type="text" class="form-control" id="name"  value={{$package->name}}>
        </div>
        <div class="form-group">
            <label for="number_of_sessions">No. Of sessions</label>
            <input type="number" name="number_of_sessions" value="{{$package->number_of_sessions}}" class="form-control"></input>
        </div>
        <div class="form-group">
            <label for="package_price">Package Price (usd) </label>
            <input type="number" name="package_price" value="{{$package->package_price}}" id="package_price"></input>

        </div>

         <div class="form-group">
            <label for="gym_id">Gym</label>
            <select class="form-control" name="gym_id">
                @foreach($gyms as $gym)
                @if ($gym->id == $package->gym_id)
                    <option value="{{$gym->id}}" selected>{{$gym->name}}</option>
                    @else
                    <option value="{{$gym->id}}">{{$gym->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection