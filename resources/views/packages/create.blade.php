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
                   <form style="margin:10px" class="col-sm-8" action="{{route('packages.store')}}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="name">Package Name</label>
                            <input name="name" type="text" class="form-control" id="name"  placeholder="Enter Package Name" value="{{old('name')}}">
                        </div>
                        
                        <div  class="form-group">
                            <label for="gym_id">Gym</label>
                            <select class="form-control" name="gym_id" id="gym_id">
                                @foreach($gyms as $gym)
                                    <option value="{{$gym->id}}">{{$gym->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Sessions</label>
                            <select id="sessions_select" name="session[]" class="form-control select2" multiple="multiple" data-placeholder="Select a Session" style="width:100%">
                                 @foreach($sessions as $session)
                                    <option value="{{$session->id}}">{{$session->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <a href="{{route('packages.index')}}" class="btn btn-danger"><i class="far fa-arrow-alt-circle-left"></i>&nbsp;Back</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-clipboard-check"></i>&nbsp;Create</button>
                        
                   </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('extra_scripts')
    <script>
        $(document).on('change','#gym_id',function() {

            var gym_id = $('#gym_id').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetchSessions') }}',
                dataType : 'json',
                type: 'get',
                data: {
                    gym_id:gym_id,
                },

                success:function(response) {

                    console.log(response);
                    var $dropdown = $('#sessions_select');
                    $dropdown.select2('destroy');

                    $dropdown.find('option').remove();
                    if(response['data'].length > 0 )
                    {
                        for(var i =0;i<response['data'].length;i++)
                        {   console.log(i);
                            $dropdown.append($("<option />").val(response['data'][i]['id']).text(response['data'][i]['name']));
                        }
                    }

                    $dropdown.select2();

                },

        });
        });
    </script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true;
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
<script>
    $('.select2').select2();
</script>
@endsection