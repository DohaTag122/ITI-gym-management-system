<html>



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
           <label for="exampleInputEmail1">Password/label>
           <input name="password" type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title">
       </div>
       <div>
       <input type="radio" name="role" value="admin"> Admin<br>
        <input type="radio" name="role" value="cityManger"> City Manger<br>
         <input type="radio" name="role" value="gymManger"> Gym Manger<br>
       </div>
        
       
    
   <button type="submit" class="btn btn-primary">Submit</button>
  
   </form>

</html>
