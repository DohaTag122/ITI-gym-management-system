@extends('layouts/base')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th >Name</th>
                            <th >Gym</th>
                            <th >No of Sessions</th>
                            <th >Price </th>
                            <th >Created At</th>
                        </tr>
                        <tr>
                            <td>{{$session->name}}</td>
                            <td>{{$session->gym_id}}</td>
                            <td>{{$session->number_of_sessions}}</td>
                            <td>{{$session->price}}</td>
                            <td>{{ \Carbon\Carbon::parse($session->created_at)->format('l jS \\of F Y h:i:s A')}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>    
@endsection