@extends('layouts/base')
@section('content')
<div class="text-center">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Gym</th>
                <th>No of Sessions</th>
                <th>Package Price (usd)</th>
                <th>Created At</th>
            </tr>
        </thead>

        <tbody>
            <tr>  
                <td>{{$package->name}}</td>
                <td>{{$package->gym_id}}</td>
                <td>{{$package->number_of_sessions}}</td>
                <td>{{$package->package_price}}</td>
                <td>{{ \Carbon\Carbon::parse($package->created_at)->format('l jS \\of F Y h:i:s A')}}</td>
            </tr>
        </tbody>
    </table>
</div>    
@endsection