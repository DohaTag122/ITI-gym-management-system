@extends('layouts.base')


@section('extra_css')

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

@endsection

@section('content')
<a href="{{route('gyms.index')}}" class="btn btn-danger">Back</a>
<table class="table">
    <thead>
        <tr>
        <th scope="col">Id</th>
        <th scope="col">City Manager Id</th>
        <th scope="col">City Id</th>
        <th scope="col">Name</th>
        <th scope="col">Image</th>
        <th scope="col">Created At</th>
        <th scope="col">Updated At</th>    
        </tr>
    </thead>
    <tbody>
    <tr>
      <td>{{$gym->id}}</td>
      <td>{{$gym->city_manager_id}}</td>
      <td>{{$gym->city_id}}</td>
      <td>{{$gym->name}}</td>
      <td><img src="/img/{{$gym->image}}" height="50" width="50"></td>
      <td>{{$gym->created_at->format('d-m-Y H:i:s')}}</td>
      <td>{{$gym->updated_at->format('d-m-Y H:i:s')}}</td>
    </tr>
    </tbody>


@endsection