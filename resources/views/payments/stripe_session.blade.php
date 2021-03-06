@extends('layouts.base')
@section('content')    
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-body">
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    <form action="/charge_session" method="POST">
                        {{ csrf_field() }}
                        <div  class="form-group">
                            <label for="member">Member Name</label>
                            <select class="form-control" name="member_id">
                                @foreach($members as $member)
                                    <option value="{{$member->id}}">{{$member->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div  class="form-group">
                            <label for="gym">Gym</label>
                            <select name="gym_id" id="gym_id" class="form-control dynamic" data-dependent="session_id">
                                <option value="" >Select Gym</option>
                                @foreach($gyms as $gym)
                                <option value="{{ $gym->id}}">{{ $gym->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="form-group">
                            <label for="session">Session</label>
                            <select name="session_id" id="session_id" class="form-control dynamic">
                                <option value="" >Select Session</option>
                            </select>
                        </div>
                        <script
                        id="stripe_id"
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="{{ env('STRIPE_KEY') }}"
                        data-name="Session"
                        data-amount=""
                        data-description="Purchasing Session"
                        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                        data-locale="auto"
                        data-currency="usd">
                        </script>
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
                    var $dropdown = $('#session_id');
                    $dropdown.find('option').remove();
                    $dropdown.append($("<option />").val('').text(''));
                    if(response['data'].length >0) {
                        for (var i = 0; i < response['data'].length; i++) {
                            console.log(i);
                            $dropdown.append($("<option />").val(response['data'][i]['id']).text(response['data'][i]['name']).attr('price', response['data'][i]['price']));
                        }
                    }

                },

        });
        });
    </script>

@endsection