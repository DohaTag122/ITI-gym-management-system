
@extends('layouts.base')


@section('extra_css')

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

@endsection


@section('content')
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
@endif



<div class="container">
  <h2> Edit your Data</h2>
  <form action="{{route('users.update',$user->id)}}" method="POST">
       @csrf
        @method('put')
    <div class="form-group">
      <label for="email">Name:</label>
      <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
    </div>
   
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email"  name="email" value="{{$user->email}}">
    </div>
    <div class="form-group">
      <label for="email">National_ID:</label>
      <input type="text" class="form-control" id="national_id"  name="national_id" value="{{$user->national_id}}">
    </div>
    
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>
@endsection