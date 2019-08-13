@extends('layouts.app')

@section('head')
<style>
    header {
        height: auto !important;
    }
</style>

<link rel="stylesheet" href="{{ asset('./plugins/DataPicker/bootstrap-datepicker.min.css') }}">
@endsection

@section('main-container')
<!-- main content -->
<div class="container mt-5">
    <div class="col-lg-12">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Rooms</a></li>
                <li class="breadcrumb-item active" aria-current="page">id={{ $room->id }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-xs-12 col-md-12 content">
                <h3 class="title-detail">{{ $room['title'] }}</h3>
                <span><i class="fa fa-clock-o"></i> Date Submitted:
                    {{ date('F d, Y', strtotime($room['updated_at'])) }}</span>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="box-image">
                                    <img class="responsive" src="{{ $room['images'][0]['file_name'] }}"
                                        alt="representative image">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <p>
                                    <strong>Address:</strong>
                                    {{ $room->address->street }}
                                    {{ $room->address->ward->name }}
                                    {{ $room->address->district->name }}
                                    {{ $room->address->province->name }}
                                </p>
                                <p><strong>Room area: </strong>{{ $room->room_area }}m</p>
                                <p><strong>Price: </strong>{{ formatMoney($room['price'],'vnd/month') }}</p>
                                <p><strong>People per Room:
                                    </strong>{{ $room->number_peoples }}/{{ $room->maximum_peoples_number }}</p>
                                <div>
                                    <div class="alert alert-info">
                                        <strong>benefit!</strong> Book now to get more privileges
                                    </div>
                                    <div class="alert alert-warning">
                                        <strong>Quick time!</strong> We will contact you 24 hours in advance from the
                                        time of booking
                                    </div>
                                    <!-- Trigger the modal with a button -->
                                    <button type="submit" class="btn btn-primary btn-block" data-toggle="modal"
                                        data-target="#book-room">Book This Room!</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="book-room" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <form action="{{ url("/bookings/rooms/$room->id") }}" method="post">
                                            @csrf
                                            <div class="modal-dialog" role="document">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{ $room['title'] }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="container">
                                                                <!-- Datepicker as text field -->
                                                                <div class="col-lg-12">
                                                                    <label for="datepickerarrival">Arrival date</label>
                                                                    <div class="input-group date col-lg-12"
                                                                        data-date-format="dd.mm.yyyy">

                                                                        <input id='datepickerarrival' type="text"
                                                                            class="form-control"
                                                                            placeholder="yyyy-mm-dd" name="arrival_date"
                                                                            autocomplete="off" clickable required />
                                                                        <div class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-th"></span>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Datepicker as text field -->
                                                                    <label for="departuredate">Departure Date</label>
                                                                    <div class="input-group date  col-lg-12"
                                                                        data-date-format="dd.mm.yyyy">

                                                                        <input id='datepickerdeparture' type="text"
                                                                            class="form-control"
                                                                            placeholder="yyyy-mm-dd" autocomplete="off"
                                                                            name="departure_date" clickable required />
                                                                        <div class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-th"></span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="input-group col-lg-12"
                                                                        data-date-format="dd.mm.yyyy">
                                                                        <div class="form-group">
                                                                            <label for="people">Number People:</label>
                                                                            <select class="form-control" id="people"
                                                                                name="peoples">
                                                                                @for ($i = 1; $i <= $room->
                                                                                    maximum_peoples_number -
                                                                                    $room->number_peoples; $i++)
                                                                                    <option value="{{ $i }}">{{ $i }}
                                                                                    </option>
                                                                                    @endfor
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary"
                                                            name="book_now">Book Now</button>
                                                        <a id="add-to-card" href="javascript:void(0)"
                                                            class="btn btn-info" data-room-id="{{ $room->id }}">Add To
                                                            Card </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-detail">
                    <div class="card">
                        <div class="card-header">Description</div>
                        <div class="card-body">
                            <p>{!! $room['description'] !!}</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Police and terms</div>
                    <div class="card-body">
                        <p>{!! $room['police_and_terms'] !!}</p>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">Convenients of Room</div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($room['convenients'] as $convenient)
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <img class="covenients__icon-item" src="{{ asset('images/ok.png') }}">
                                <span>{{ $convenient['name'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- phan commnet -->

            <div class="col-lg-12">
                <!-- comment -->
                <div id="fb-root"></div>
                <div class="fb-comments" data-href="https://www.facebook.com/ndh6989" data-width="1000"
                    data-numposts="5"></div>
            </div>


        </div>
    </div>
</div>
@endsection

@section('footer')
<!-- facebook -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
    src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v4.0&appId=1812993605672350&autoLogAppEvents=1">
</script>

<script src="{{ asset('./js/booking.js') }}"></script>
@endsection
