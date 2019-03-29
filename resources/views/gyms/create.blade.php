@extends('layouts.base')


@section('extra_css')

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
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
           <select class="form-control" name="city_manager_id" id="city_manager_id"></select>

                              
       </div>

    
   <button type="submit" class="btn btn-primary">Submit</button>
   </form>
    
   <!-- <script>
        $('#city_id').on('change', e => {
            $('#city_manager_id').empty()       
            $.ajax({
                url: `/gyms/${e.value}/managers_of_city`,
                success : data => {
                    alert('success'); 
                    //console.log(managers_of_city);
                    data.managers_of_city.forEach(manager_of_city =>
                        $('#city_manager_id').append(`<option value="${manager_of_city.id}">${manager_of_city.name}</option>`)
                    )
                },
                error : response => {
                    alert('error');
                    //console.log(response);
                }
            })
        })
    </script>           -->

    <!-- <script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="city_id"]').on('change',function(){
               var countryID = jQuery(this).val();
               if(countryID)
               {
                  jQuery.ajax({
                     headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     url : 'get_managers/'+countryID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="city_manager_id"]').empty();
                        jQuery.each(data, function(id,name){
                           $('select[name="city_manager_id"]').append('<option value="'+ id +'">'+ name +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="city_manager_id"]').append('<option value="fady">fady</option>');;
               }
            });
    });
    </script> -->

@endsection