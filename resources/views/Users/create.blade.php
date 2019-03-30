@extends('layouts.base')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-body">
                    @if ($errors->any())
                    <div class="alert alert-danger" style="margin: 4px;">
                        <ul style="list-style: none;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

   <form action="{{route('users.store')}}" method="POST"  enctype="multipart/form-data">
       @csrf
      
       <div class="form-group">
           <label for="exampleInputEmail1">Name</label>
           <input name="name" type="text" class="form-control" >
       </div>
       <div class="form-group">
           <label for="exampleInputEmail1"> Email</label>
           <input name="email" type="email" class="form-control" >
       </div>
       <div class="form-group">
           <label for="exampleInputEmail1">Password </label>
           <input name="password" type="password" class="form-control" >
       </div>
       <div class="form-group">
           <label for="exampleInputEmail1"> National_ID</label>
           <input name="national_id" type="text" class="form-control" >
       </div>

       <div class="form-group">
           <label for="exampleInputEmail1">Upload Image </label>
           <input name="image" type="file" value="NULL" class="form-control"  >
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

   
   </div>
        </div>
    </div>
</section>
@endsection
