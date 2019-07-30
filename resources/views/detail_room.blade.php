@extends('layouts.app')

@section('content')
<!-- main content -->
<div class="container main-content">
    <div class="col-md-10">
        <div class="row mb-10 pl-sm-15 date-curent">
            Thứ 4, 27/2/2019
        </div>
        <div class="row pl-sm-15">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('index') }}">Trang chủ</a>
                </li>
                <li class="active">detail</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12 content pr15-min-992">
                <h3 class="title-detail">{{ $room['title'] }}</h3>
                <span><i class="fa fa-clock-o"></i> Date Submitted:
                    {{ date('F d, Y', strtotime($room['updated_at'])) }}</span>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="box-image">
                                    <img class="reponsive" src="{{ $room['images'][0]['file_name'] }}" alt="representative image">
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
                                    <!-- Trigger the modal with a button -->
                                    <button type="submit" class="btn btn-primary btn-block" data-toggle="modal"
                                        data-target="#book-room">Book This Room!</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="book-room" role="dialog">
                                        <form action="{{ url("/bookings/rooms/$room->id") }}" method="post">
                                            @csrf
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">{{ $room['title'] }}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="container">
                                                                <!-- Datepicker as text field -->
                                                                <label for="datepickerarrival">Arrival date</label>
                                                                <div  class="input-group date col-sm-5"
                                                                    data-date-format="dd.mm.yyyy">

                                                                    <input id='datepickerarrival' type="text" class="form-control"
                                                                        placeholder="dd.mm.yyyy" name="arrival_date" clickable required />
                                                                    <div class="input-group-addon">
                                                                        <span class="glyphicon glyphicon-th"></span>
                                                                    </div>
                                                                </div>

                                                                <!-- Datepicker as text field -->
                                                                <label for="departuredate">Departure Date</label>
                                                                <div  class="input-group date  col-sm-5"
                                                                    data-date-format="dd.mm.yyyy">

                                                                    <input id='datepickerdeparture' type="text"
                                                                        class="form-control"
                                                                        placeholder="Departure Date"
                                                                        name="departure_date" clickable  required />
                                                                    <div class="input-group-addon">
                                                                        <span class="glyphicon glyphicon-th"></span>
                                                                    </div>
                                                                </div>

                                                                <div class="input-group ol-sm-5"
                                                                    data-date-format="dd.mm.yyyy">
                                                                    <div class="form-group">
                                                                        <label for="people">Number People:</label>
                                                                        <select class="form-control" id="people"
                                                                            name="peoples">
                                                                            @for ($i = 1; $i <= $room->maximum_peoples_number - $room->number_peoples; $i++)
                                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                                            @endfor
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" name="book_now">Book Now</button>
                                                        <button type="submit" class="btn btn-info">Add To Card</button>
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
                    <div class="panel panel-default">
                        <div class="panel-heading go-text-right">Description</div>
                        <div class="panel-body">
                            <p>{!! $room['description'] !!}</p>
                        </div>
                    </div>
                    <div class="row  mb-10 slide-img">

                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading go-text-right">Police and terms</div>
                    <div class="panel-body">
                        <span class="RTL">
                            <p>{!! $room['police_and_terms'] !!}</p>
                        </span>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading go-text-right">Convenients of Room</div>
                    <div class="panel-body">
                        <div class="go-text-right">
                            @foreach($room['convenients'] as $convenient)
                            <div style="margin-top:6px;margin-left:0px" class="row col-md-4 col-sm-4 col-xs-6">
                                <div class="row">
                                    <img class="go-right"
                                        style="max-height:30px;max-witdh:40px;vertical-align: text-bottom;"
                                        src="{{ asset('images/ok.png') }}">
                                    <span class="text-left go-text-right size14">
                                        {{ $convenient['amount'].' '.$convenient['name'] }} </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- phan commnet -->
            <div class="comment">
                <div class="fb-like" data-href="http://localhost/detail-post.php" data-layout="button_count"
                    data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                <div class="fb-save" data-uri="http://localhost" data-size="small"></div>
                <!-- comment -->
                <div class="fb-comments" data-href="https://www.facebook.com/ndh6989" data-width="100%"
                    data-numposts="5">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('head')
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
<script src="" charset="utf-8"></script>
@endsection
@section('footer')
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}" charset="utf-8"></script>
@endsection
