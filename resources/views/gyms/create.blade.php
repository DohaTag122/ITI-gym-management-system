@extends('layouts.base')


@section('extra_css')

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

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
           <select class="form-control" name="city_id" id="city_id">
               @foreach($cities as $city)
                   <option value="{{$city->id}}">{{$city->name}}</option>                <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

               @endforeach
           </select>

           <label for="exampleInputImage1">Cover Image</label>
           <?php  echo Form::file('image');?>

           <label for="exampleInputName1">City Manger Name</label>
           <select class="form-control" name="city_manager_id" id="city_manager_id">
                <script>
                    $('#city_id').on('change', e => {
                        $('#city_manager_id').empty()
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: `gyms/${e.value}/managers_of_city`,
                            dataType : 'json',
                            type: 'get',
                            success: data => {
                                // data.users.forEach(managers_of_city =>
                                //     $('#managers_of_city').append(`<option value="${managers_of_city.id}">${managers_of_city.name}</option>`)
                                // )
                                console.log(data);
                            },
                            error : response => {
                                alert('error');
                                console.log(response);
                            }
                        })
                    })
                </script>                        
           </select>
       </div>

    
   <button type="submit" class="btn btn-primary">Submit</button>
   </form>

@endsection