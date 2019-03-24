@extends('layouts.base')


@section('extra_css')

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

@endsection

@section('content')
<a href="{{route('coaches.index')}}" class="btn btn-danger">Back</a>
<table class="table">
    <thead>
        <tr>
        <th scope="col">Id</th>
        <th scope="col">Gym Id</th>
        <th scope="col">Name</th>
        <th scope="col">Created At</th>
        <th scope="col">Updated At</th>        
        </tr>
    </thead>
    <tbody>
    <tr>
      <td>{{$coach->id}}</td>
      <td>{{$gym->id}}</td>
      <td>{{$coach->name}}</td>
      <td>{{$coach->created_at->format('d-m-Y H:i:s')}}</td>
      <td>{{$coach->updated_at->format('d-m-Y H:i:s')}}</td>
    </tr>
    </tbody>


@endsection