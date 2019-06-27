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
                <span><i class="fa fa-clock-o"></i> Date Submitted: {{ date('F d, Y', strtotime($room['updated_at'])) }}</span>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="box-image">
                                    <img src="{{ $room['images'][0]['file_name'] }}" alt="">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <p>
                                    <strong>Address:</strong> {{ formatAddressToString($room->address) }}
                                </p>
                                <p><strong>Room area: </strong>{{ $room['room_area'] }}m</p>
                                <p><strong>Price: </strong>{{ $room['price'] }} vnd/month</p>
                                <p><strong>People Maximum: </strong>{{ $room['maximum_peoples_number'] }}</p>
                                <div>
                                    <form action="#" method="post" accept-charset="utf-8">
                                        <button type="submit" name="pay" class="btn btn-primary btn-block">Đặt phòng ngay !</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-detail">
                    <div class="panel panel-default">
                        <div class="panel-heading go-text-right">Description</div>
                        <div class="panel-body">
                            <p>{{ $room['description'] }}</p>
                        </div>
                    </div>
                    <div class="row  mb-10 slide-img">
                        {{-- slide --}}
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading go-text-right">Police and terms</div>
                    <div class="panel-body">
                        <span class="RTL">
                            <p>{{ $room['police_and_terms'] }}</p>
                        </span>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading go-text-right">Tiện nghi nhà trọ</div>
                    <div class="panel-body">
                        <div class="go-text-right">
                            @foreach($room['convenients'] as $convenient)
                            <div style="margin-top:6px;margin-left:0px" class="row col-md-4 col-sm-4 col-xs-6">
                                <div class="row">
                                    <img class="go-right" style="max-height:30px;max-witdh:40px;vertical-align: text-bottom;" src="{{ asset('images/ok.png') }}">
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
                <div class="fb-like" data-href="http://localhost/detail-post.php" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                <div class="fb-save" data-uri="http://localhost" data-size="small"></div>
                <!-- comment -->
                <div class="fb-comments" data-href="https://www.facebook.com/ndh6998" data-width="100%" data-numposts="5">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
