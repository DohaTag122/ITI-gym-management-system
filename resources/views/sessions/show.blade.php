@extends('layouts/base')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-10">
            <div class="box">
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>Day</th>
                            <th>Starts At</th>
                            <th>Finishes At </th>
                            <th>Price</th>
                            <th>Coaches</th>
                            <th>Gym</th>
                            <th>Created At</th>
                        </tr>
                        <tr>
                            <td>{{$session->name}}</td>
                            <td>{{$session->day}}</td>
                            <td>{{\Carbon\Carbon::parse($session->start_at)->format('h:i A')}}</td>
                            <td>{{\Carbon\Carbon::parse($session->finish_at)->format('h:i A')}}</td>
                            <td>{{$session->price}}</td>
                            <td>
                                @foreach($coaches as $coach)
                                    @foreach ($session->coaches as $pivot_coach)
                                    @if ($pivot_coach->id == $coach->id)
                                    {{$coach->name}}<br>
                                    @endif
                                    @endforeach
                                @endforeach
                            </td>
                            <td>
                                @foreach($gyms as $gym)
                                    @if ($gym->id == $session->gym_id)
                                    {{$gym->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ \Carbon\Carbon::parse($session->created_at)->format('h:i A \\, l jS \\of F Y ')}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>    
@endsection
