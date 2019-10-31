@extends('layouts.app')

@section('head')
<style>
    header {
        height: auto !important;
    }
    #app {
        min-height: calc(100% - 50px - 320px);
    }
</style>
@endsection
@section('main-container')

<nav aria-label="breadcrumb" class="pt-5">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item">Categories</li>
        <li class="breadcrumb-item active" aria-current="page">{{ $listRooms[0]->category->name }}</li>
    </ol>
</nav>

<div class="row">
    @foreach ($listRooms as $room)
    <div class="box-room col-lg-3 col-md-4 col-sm-6 col-xs-10">
        <div class="box-room__image">
            <div class="box-room__actions">
                <a href="{{ url("/detail-room/$room->id") }}">
                    <button type="button" class="btn btn-primary"> More info</button>
                </a>
            </div>
            <img class="responsive" src="{{ $room->images[0]->file_name}}" alt="">
        </div>
        <div class="box-room__info">
            <div class="box-room__title">
                <p class="fix-length">{{ $room->title }}</p>
            </div>
            <div class="box-room__category">
                <p class="fix-length">{{ $room->category->name }}</p>
            </div>
            <div class="box-room__description">
                {!! $room->description !!}
            </div>
        </div>
        <div class="box-room__price">
            <p class="text-warning"> price: {{ formatMoney($room['price'],'vnd/month') }}</p>
        </div>
    </div>
    @endforeach
</div>
<div class="row justify-content-center" id="pagination">
    {{ $listRooms->links() }}
</div>

@endsection
