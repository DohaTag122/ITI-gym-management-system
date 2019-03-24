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
<a href="{{route('coaches.index')}}" class="btn btn-danger">Back</a>
    <form action="{{ route('coaches.update', $coach->id) }}" method="POST">  
    @method('PUT')  
       @csrf
       <div class="form-group">
           <label for="exampleInputName1">Name</label>
           <input name="name" type="text" class="form-control"  value="{{$coach->name}}">
      
           <label for="exampleInputName1">Gym Name</label>
           <select class="form-control" name="gym_id">
               @foreach($gyms as $gym)
                   <option value="{{$gym->id}}">{{$gym->name}}</option>
               @endforeach
           </select>
       </div>

    
   <button type="submit" class="btn btn-primary">Submit</button>
   </form>

@endsection