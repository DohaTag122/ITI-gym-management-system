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
           <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title">
       </div>
       <div class="form-group">
           <label for="exampleInputEmail1"> Email</label>
           <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title">
       </div>
       <div class="form-group">
           <label for="exampleInputEmail1">Password </label>
           <input name="password" type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title">
       </div>

       <div class="form-group">
           <label for="exampleInputEmail1">Image </label>
           <input name="image" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title">
       </div>
       <div class="form-group">
           <label for="exampleInputEmail1">ban </label>
           <input name="ban" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title">
       </div>
       <div class="form-group">
           <label for="exampleInputEmail1">gymid </label>
           <input name="gymid" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title">
       </div>


       


       <div>
       @role('admin') 
        <input type="radio" name="role" value="cityManger"> City Manger<br>
        @endrole

       
         <input type="radio" name="role" value="gymManger"> Gym Manger<br>
       </div>
        
       
    
   <button type="submit" class="btn btn-primary">Submit</button>
  
   </form>

   @endsection
