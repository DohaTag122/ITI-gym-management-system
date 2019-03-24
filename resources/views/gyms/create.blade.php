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
<a href="{{route('gyms.index')}}" class="btn btn-danger">Back</a>

   <form action="{{route('gyms.store')}}" method="POST">
       @csrf
       <div class="form-group">
           <label for="exampleInputName1">Name</label>
           <input name="name" type="text" class="form-control"  placeholder="Enter Name">
           
           <label for="exampleInputName1">City Name</label>
           <select class="form-control" name="city_id">
               @foreach($cities as $city)
                   <option value="{{$city->id}}">{{$city->name}}</option>
               @endforeach
           </select>

           <label for="exampleInputImage1">Cover Image</label>
           <?php  echo Form::file('image');?>

           <select class="form-control" name="city_id">
               @foreach($cities as $city)
                   <option value="{{$city->id}}">{{$city->name}}</option>
               @endforeach
           </select>
       </div>

    
   <button type="submit" class="btn btn-primary">Submit</button>
   </form>

@endsection