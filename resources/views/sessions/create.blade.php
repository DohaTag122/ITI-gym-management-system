@extends('layouts.base')
@section('extra_css')

@endsection
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

                    <form style="margin:10px" class="col-sm-8" action="{{route('sessions.store')}}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="name">Session Name</label>
                            <input name="name" type="text" class="form-control" id="name"  placeholder="Enter Session Name" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="day">Date </label>

                            <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control pull-right" id="datepicker" name="day" value="{{old('day')}}">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                            <label for="start_at">Starts At</label>
                                <div class="input-group">
                                    <input class="form-control timepicker" type="time" name="start_at" id="start_at" value="{{old('start_at')}}">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                            <label for="finish_at">Finishs At</label>
                                <div class="input-group">
                                    <input class="form-control timepicker" type="time" name="finish_at" id="finish_at" value="{{old('finish_at')}}">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price">Session Price</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input class="form-control" type="text" name="price" id="price" value="{{old('price')}}">
                                <span class="input-group-addon">.00</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-success" id="coach_toggle" data-toggle="modal" data-target="#CoachModal"><i class="fas fa-user-plus"></i>&nbsp;Add Coaches To Your Session</a>
                        </div>
                        <div  class="form-group">
                            <label for="gym_id">Gym</label>
                            <select class="form-control" name="gym_id">
                                @foreach($gyms as $gym)
                                    <option value="{{$gym->id}}">{{$gym->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{route('sessions.index')}}" class="btn btn-danger"><i class="far fa-arrow-alt-circle-left"></i>&nbsp;Back</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-clipboard-check"></i>&nbsp;Create</button>
                        {{-- Modal --}}
                        <div class="modal fade" id="CoachModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="exampleModalLabel">Add Coaches To Your session</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="coach_container">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div>
                                            <button type="button" id="add-coach" class="btn btn-success">Add More Coaches</button>
                                            <button type="button" row_delete="" id="delete_item"  class="btn btn-primary" data-dismiss="modal">Done</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Dismiss</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

    
@endsection
@section('extra_scripts')
<!-- timepicker -->
<script>
const drawElement = (tagname, attributes = {}, text) => {
    const element = document.createElement(tagname);
    for (let attr in attributes) {
        element.setAttribute(attr, attributes[attr]);
    }
    if (text) {
        element.appendChild(document.createTextNode(text));
    }
    return element;
}
const appendElement = (parent, ...children) => {
    for (let child of children) {
        parent.appendChild(child);
    }
}
const appendBodySceleton = (...children) => {
        for (let i = (children.length - 1); i >= 0; i--) {
            document.body.insertBefore(children[i], document.body.firstChild);
        }
}
const insertAfter = (newNode, referenceNode) => {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}
document.getElementById("add-coach").addEventListener("click", ()=>{
    const coach_div = drawElement("div");
    appendElement(document.getElementById('coach_container'), coach_div);
    // insertAfter(coach_div, document.getElementById("first-coach"));
    coach_div.innerHTML = `<div class="form-group">
            <label for="coach">Coach Name</label>
            <select class="form-control" name="coach[]">
                @foreach($coaches as $coach)
                    <option value="{{$coach->id}}">{{$coach->name}}</option>
              @endforeach
            </select>
            </div>`;

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
@endsection