@extends('layouts.app')
@section('content')
<div class="container main-content">
    <div class="row" id="header">
        <div class="header-img hidden-sm hidden-xs">
            <img src="/images/bg-header.jpg" style="width:100%">
        </div>
        <div class="search col-md-4 col-md-push-1 col-xs-12  ">
            <div class="col-md-12">
                <h4>SEARCH BOX</h4>
                <form class="ui-widget form-horizontal" action="ListRoom.php" method="post">
                    <p><strong>category</strong></p>
                    <select class="col-xs-12 form-control">
                        @foreach($categoryList as $category)
                        <option>{{$category['name']}}</option>
                        @endforeach
                    </select>
                    <p><strong>address</strong></p>
                    <input type="text" name="address" id="tags" class="form-control" value="" required="required" name="valueSearch" placeholder="provincal" title="">
                    <p><strong>price</strong></p>
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="slider-range"></div>
                        </div>
                    </div>
                    <div class="row slider-labels">
                        <div class="col-xs-6 caption">
                            <strong>Min:</strong> <span id="slider-range-value1"></span>VND
                        </div>
                        <div class="col-sm-6 text-right caption">
                            <strong>Max:</strong> <span id="slider-range-value2"></span>VND
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="hidden" id="min-value" name="min-value" value="100">
                            <input type="hidden" id="max-value" name="max-value" value="">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Search</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Widget hot category -->
    <!-- motel -->
    <div class="row">
        <p class="alert alert-info col-sm-12" role="alert">
            Thuê phòng căn hộ trực tuyến giá tốt nhất
        </p>
    </div>
    <div class="row pl-sm-15">
        <ol class="breadcrumb">
            <li class="active">
                <a href="{{ route('index') }}">Trang chủ</a>
            </li>
        </ol>
    </div>
    <div class=" row">
        <p class="mb-10 pl-sm-15 ">
            Thứ 2, 16/08/2018
        </p>
    </div>
    {{-- show new room --}}
    @foreach ($newRoomsOfCategory as $category)
    <div class=" row wiget-category " id=" cho-thue-phong-tro">
        <div class="col-sm-12 category">
            <div class="row category--name text-capitalize">
                <a href="./category.php" class="text-success">{{$category['name']}}</a>
            </div>
        </div>
        @foreach($category['rooms'] as $room)
        <div class="col-md-4 col-md-push-0 col-sm-10 col-sm-push-1 col-xs-12 widget-thumb new-post">
            <a href='./detail-room/{{ $room['id'] }}' class="new-post__title ">{{ $room['title'] }}</a>
            <div class="row">
                <div class="col-xs-12 fl-left new-post__images">
                    <a href='./detail-room/{{ $room['id'] }}'>
                        <div class="box-image">
                            <img src="{{ $room->images[0]['file_name'] }}" alt="">
                        </div>
                        <div class="new-post__info col-xs-12">
                            <p class="info__address width-ellipsis">
                                <i class="fa fa-map-marker"></i>:
                                {{ formatAddressToString($room->address) }}

                            </p>
                            <p class="info__people">
                                People number: {{$room['maximum_peoples_number']}}
                            </p>
                            <p class="info__price">
                                <i class="fa fa-usd info__price--yellow" aria-hidden="true"></i>
                                {{$room['price']}} đ/tháng
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach

</div>
</main>
<!-- include sidebar col-md-4 -->
@endsection
@section('option-js')
<script src="{{ asset('js/searchBox.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('js/autoCompleteProvincial.js') }}" charset="utf-8"></script>
@endsection
