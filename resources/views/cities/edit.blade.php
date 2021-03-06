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
<a href="{{route('cities.index')}}" class="btn btn-danger">Back</a>
    <form action="{{ route('cities.update', $city->id) }}" method="POST">  
    @method('PUT')  
       @csrf
       <div class="form-group">
           <label for="exampleInputName1">Name</label>
           <input name="name" type="text" class="form-control"  value="{{$city->name}}">
       </div>

    
   <button type="submit" class="btn btn-primary">Submit</button>
   </form>

@endsection