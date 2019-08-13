@extends('layouts.app')
@section('head')
<style>
    header {
        height: auto !important;
    }
</style>
@endsection
@section('main-container')
<div>
    <nav aria-label="breadcrumb" class="mt-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Search</li>
            @foreach ($arrBreadcrumb as $breadcrumb)
            <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb }}</li>
            @endforeach
        </ol>
    </nav>
    @if ($rooms->isEmpty())
    <div class="row">
        <div class="container">
            <p style="margin:20px 0 300px; text-align:center">There are no rooms that match the search rules above</p>
        </div>
    </div>


    @else
    <div class="row">
        @foreach ($rooms as $room)
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
        {{ $rooms->links() }}
    </div>
    @endif
    @endsection
