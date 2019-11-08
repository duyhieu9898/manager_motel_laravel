@extends('layouts/app')

@section('header')
<div class="header-container">
    <div class="header-content">
        <div class="align-items-center d-flex">
            <img src="images/logo.png">
            <span class="header-content__title">HOMO<span style="color:#f1ab42">SAPIENS</span></span>

        </div>
        <p class="header-content__description">Khách sạn tốt nhất vịnh bắc bộ</p>
    </div>
</div>
@endsection

@section('main-container')

<div class="search-room">
    <h3 class="text-center">TÌM PHÒNG</h3>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <form action="/search-room" method="get">
                <div class="row">
                    <div class="col-lg-2">
                        <label class="srearch-room__lable-input">Thể Loại</label>
                        <select name="category_id" class="form-control srearch-room--input-category" required>
                            <option hidden>Chọn thể loại</option>
                            @foreach($categories as $category)
                            <option value="{{ $category['id'] }}">{{$category['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 ">
                        <label class="srearch-room__lable-input">Tỉnh/Thành phố</label>
                        <input type="text" name="name_province" class="form-control" placeholder="Enter name province">
                    </div>
                    <div class="col-lg-2 ">
                        <label class="srearch-room__lable-input">Số Người</label>
                        <input type="text" name="people" class="form-control " placeholder="Enter number people">
                    </div>
                    <div class="col-lg-2">
                        <label class="srearch-room__lable-input">Giá tối thiểu</label>
                        <input type="text" name="min_price" class="form-control" data-type="currency"
                            placeholder="Enter price min">
                    </div>
                    <div class="col-lg-2">
                        <label class="srearch-room__lable-input">Giá tối đa</label>
                        <input type="text" name="max_price" class="form-control" data-type="currency"
                            placeholder="Enter price max">
                    </div>
                    <div class="col-lg-2 d-flex flex-column-reverse">
                        <button type="submit" class="btn btn-outline-dark">Tìm ngay</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>
</div>

<div id="room-center">
    <div class="room-center__title text-white pt-5">
        <h3>PHÒNG MỚI NHẤT</h3>
    </div>
    <div class="">
        <div class="col-lg-12 p-5">
            <div class="owl-carousel owl-theme new-room-carousel">
                @foreach($roomsNewsCreate as $room)
                <div class="widget-thumb new-post">
                    <a href='./detail-room/{{ $room['id'] }}' class="new-post__title ">{{ $room['title'] }}</a>
                    <div class=" new-post__images">
                        <a href='./detail-room/{{ $room['id'] }}'>
                            <div class="box-image">
                                <img class='reponsive' src="{{ $room->images[0]['file_name'] }}" alt="">
                            </div>
                            <div class="new-post__info ">
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
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script src="./js/owl-carousel-option.js"></script>
@endsection
