@extends('layouts.app')
@section('content')
@if (\Session::has('success'))
    <div class="alert alert-success booking-success">
            <strong>Success!</strong> {!! \Session::get('success') !!}
    </div>
@endif
<div class="container main-content">
    <div class="row" id="header">
        <div class="header-img hidden-sm hidden-xs">
            <img class='reponsive' src="/images/bg-header.jpg" style="width:100%">
        </div>
        <div class="search col-md-4 col-md-push-1 col-xs-12  ">
            <div class="col-md-12">
                <h4>SEARCH BOX</h4>
                <form class="ui-widget form-horizontal" action="/search-room" method="get">
                    <p><strong>category</strong></p>
                    <select name="category_id" class="col-xs-12 form-control">
                        @foreach($categories as $category)
                        <option value="{{ $category['id'] }}">{{$category['name']}}</option>
                        @endforeach
                    </select>
                    <p><strong>address</strong></p>
                    <input type="text" name="name_province" id="tags" class="form-control" value="" required="required" name="valueSearch" placeholder="Enter province" title="">
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
                            <input type="hidden" id="min-value" name="min_price" value="100">
                            <input type="hidden" id="max-value" name="max_price" value="">
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
        <p class="alert alert-info col-sm-12" role="alert">Thuê phòng căn hộ trực tuyến giá tốt nhất</p>
    </div>
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
            </ol>
        </nav>
    </div>
    <div class=" row">
        <p>Thứ 2, 16/08/2018</p>
    </div>
    {{-- show new room --}}
    @foreach ($newRoomsOfCategory as $category)
    <div class="row wiget-category">
        <div class="col-sm-12 category">
            <div class="row category--name text-capitalize">
                <a href="{{ route('category_rooms',$category['id']) }}" class="text-success">{{$category['name']}}</a>
            </div>
        </div>
        @foreach($category['rooms'] as $room)
        <div class="col-lg-4 col-md-6  col-md-push-0 col-sm-10 col-sm-push-1 col-xs-12 widget-thumb new-post">
            <a href='./detail-room/{{ $room['id'] }}' class="new-post__title ">{{ $room['title'] }}</a>
            <div class="row">
                <div class="col-xs-12 fl-left new-post__images">
                    <a href='./detail-room/{{ $room['id'] }}'>
                        <div class="box-image">
                            <img class='reponsive' src="{{ $room->images[0]['file_name'] }}" alt="">
                        </div>
                        <div class="new-post__info col-xs-12">
                            <p class="info__address width-ellipsis">
                                <i class="fa fa-map-marker"></i>:
                                {{ $room->address->province->name }}
                                {{ $room->address->district->name }}
                                {{ $room->address->ward->name }}
                                {{ $room->address->street }}
                            </p>
                            <p class="info__people"><strong>People per Room:
                                    </strong>{{ $room->number_peoples }}/{{ $room->maximum_peoples_number }}</p>
                            <p class="info__price">
                                <i class="fa fa-usd info__price--yellow" aria-hidden="true"></i>
                                {{ formatMoney($room['price'],'vnd/month') }}
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
@section('footer')
<script src="{{ asset('js/searchBox.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('js/autoCompleteProvincial.js') }}" charset="utf-8"></script>
@endsection
