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


   <form action="{{route('users.store')}}" method="POST">
       @csrf
       <div class="form-group">
           <label for="exampleInputEmail1">Name</label>
           <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
       </div>
       <div class="form-group">
           <label for="exampleInputEmail1"> Email</label>
           <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
       </div>
       <div class="form-group">
           <label for="exampleInputEmail1">Password </label>
           <input name="password" type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
       </div>
       <div class="form-group">
           <label for="exampleInputEmail1"> National_ID</label>
           <input name="national_id" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
       </div>

       <div class="form-group">
           <label for="exampleInputEmail1">Image </label>
           <input name="image" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
       </div>
       
       

       <div class="form-group">
           <label for="exampleInputPassword1">gymid</label>
           <select class="form-control" name="gym_id">
               @foreach($gyms as $gym)
                   <option value="{{$gym->id}}">{{$gym->name}}</option>
               @endforeach
           </select>
       </div>


       <div>
       @role('admin') 
        <input type="radio" name="role" value="cityManager"> City Manager<br>
        @endrole

       
         <input type="radio" name="role" value="gymManager"> Gym Manager<br>
       </div>
        
       
    
   <button type="submit" class="btn btn-primary">Submit</button>
  
   </form>

   @endsection
