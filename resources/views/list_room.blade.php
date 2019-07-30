@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/category-rooms.css') }}">
@endsection
@section('content')
<div class="container main-content" id="app">

    <div class="row mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Search result</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        @foreach ($rooms as $room)
            <div class="box-room box-room col-lg-3 col-md-4 col-sm-6 col-xs-10 col-xs-offset-1 col-sm-offset-0 ">
                <div class="box-room__image">
                    <div class="actions">
                        <a href="{{ url("/detail-room/$room->id") }}"><button type="button" class="btn btn-primary"> More info</button></a>
                    </div>
                    <img class='reponsive' src="{{ $room->images[0]->file_name}}" alt="">
                </div>
                <div class="box-room__info">
                    <div class="info__title"><p class="info__title--content fix-length">{{ $room->title }}</p> </div>
                    <div class="info__address"><p class="info__address--content fix-length">{{ $room->category->name }}</p> </div>
                    <div class="info_description"><p class="info__description--content">{!! $room->description !!}</p></div>
                </div>
                <div class="box-room__price">
                    <p class="box-room__price--content text-warning" > price: <span>12,345,478 </span>vnd/month</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row" id="pagination">
        <div class="col-md-6 col-md-push-3">
            {{ $rooms->links() }}
        </div>

    </div>

@endsection
