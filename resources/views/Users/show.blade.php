@extends('layouts.base')


@section('extra_css')

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

@endsection

@section('content')

<div class="container">
  <h2>My Profil</h2>
  <form>
  <div class="form-group">
      <label for="email">Name:</label>
      <label  class="form-control" >{{$user->name}}  </label>
  </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <label  class="form-control" >{{$user->email}}  </label>
  </div>
  <div class="form-group">
      <label for="email">National_ID:</label>
      <label  class="form-control" >{{$user->national_id}}  </label>
  </div>
 
  </form>
</div>


@endsection