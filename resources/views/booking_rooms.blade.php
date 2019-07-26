@extends('layouts.app')

@section('content')
<div id="app" class="container main-content">
    <div class="row mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Booking</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <h3>Booking</h3>
                        <div class="box-image">
                            <img src="{{ $room['images'][0]['file_name'] }}" alt="">
                        </div>
                        <div class="alert alert-warning" role="alert">
                            Book now to keep the room empty and the best price!
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <h3>Detail Room</h3>
                        <p>
                            <strong>Address:</strong>
                            {{ $room->address->street }}
                            {{ $room->address->ward->name }}
                            {{ $room->address->district->name }}
                            {{ $room->address->province->name }}
                        </p>
                        <p><strong>Room area: </strong>{{ $room->room_area }}m</p>
                        <p><strong>Price: </strong>{{ $room->price }} vnd/month</p>
                        <p><strong>Number of current people: </strong>{{ $room->number_peoples }}</p>
                        <p><strong>Maximum number of people: </strong>{{ $room->maximum_peoples_number }}</p>
                        <div class="row">
                            <div class="col-sm-12">
                                <contact-form-component></contact-form-component>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-offset-5 col-sm-12">
            <form action="/booking/{{ $room->id }}" method="post">
                @csrf
                <button type="submit" class="btn btn-primary">Book This Room</button>
                <a href="#" class="btn btn-default" role="button">Cancle</a>
            </form>

        </div>
    </div>
</div>
@endsection
@section('option-js')
    <!-- app -->
    <script src="{!! asset('/js/app.js') !!}"></script>
@endsection
