@extends('layouts/base')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-10">
            <div class="box">
            <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th >Name</th>
                            <th >Gym</th>
                            <th style="width: 126px;">No of Sessions</th>
                            <th style="width: 126px;">Package Price</th>
                            <th style="width: 250px;">Created At</th>
                        </tr>
                        <tr>
                            <td>{{$package->name}}</td>
                            <td>{{$package->gym_id}}</td>
                            <td>{{$package->number_of_sessions}}</td>
                            <td><i class="fas fa-dollar-sign"></i>&nbsp;{{$package->package_price}}</td>
                            <td>{{ \Carbon\Carbon::parse($package->created_at)->format('h:i A \\, l jS \\of F Y ')}}</td>
                        </tr>
                    </table>
                    <a style="margin-top: 20px;" href="{{route('packages.index')}}" class="btn btn-danger"><i class="far fa-arrow-alt-circle-left"></i>&nbsp;Back</a>
                </div>
            </div>
        </div>
    </div>
</section>    
@endsection