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
                    <form action="{{route('sessions.update', $session)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Session Name</label>
                            <input name="name" type="text" class="form-control" id="name"  placeholder="{{$session->name}}" disabled="">
                        </div>
                        <div class="form-group">
                            <label for="day">Date </label>

                            <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control pull-right" id="datepicker" name="day" value="{{$session->day}}">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                            <label for="start_at">Starts At</label>
                                <div class="input-group">
                                    <input class="form-control timepicker" type="time" name="start_at" id="start_at" value="{{$session->start_at}}">
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
                                    <input class="form-control timepicker" type="time" name="finish_at" id="finish_at" value="{{$session->finish_at}}">
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
                                <input class="form-control" type="text" name="price" id="price" placeholder="{{$session->price}}" disabled="">
                                <span class="input-group-addon">.00</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Session Coaches</label>
                            <select class="form-control" multiple  style="width:100%" disabled>
                                @foreach($coaches as $coach)
                                    @foreach ($session->coaches as $pivot_coach)
                                    @if ($pivot_coach->id == $coach->id)
                                    <option>{{$coach->name}}</option>
                                    @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div  class="form-group">
                            <label for="gym_id">Gym</label>
                            <select class="form-control" name="gym_id" disabled="">
                                @foreach($gyms as $gym)
                                    @if ($gym->id == $session->gym_id)
                                    <option value="{{$gym->id}}">{{$gym->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>            
                        <a href="{{route('sessions.index')}}" class="btn btn-danger"><i class="far fa-arrow-alt-circle-left"></i>&nbsp;Back</a>
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
    $('.select2').select2();
</script>
@endsection