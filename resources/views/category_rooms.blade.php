@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/category-rooms.css') }}">
@endsection
@section('content')
<div class="container main-content" id="app">
    <div class="row">
        @foreach ($listRooms as $room)
            <div class="col-md-3">
                <div class="box-room">
                    <div class="box-room__image">
                        <div class="actions">
                            <button type="button" class="btn btn-primary">More info</button>
                        </div>
                        <img src="{{ $room->images[0]->file_name}}" alt="">
                    </div>
                    <div class="box-room__info">
                        <div class="info__title"><p class="info__title--content fix-length">{{ $room->title }}</p> </div>
                        <div class="info__address"><p class="info__address--content fix-length">{{ $room->address->district->name }}-{{ $room->address->province->name }}  </p> </div>
                        <div class="info_description"><p class="info__description--content">{!! $room->description !!}</p></div>
                    </div>
                    <div class="box-room__price">
                        <p class="box-room__price--content text-warning" > price: <span>12,345,478 </span>vnd/month</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-4 col-md-push-4">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href=""><i class="fa fa-arrow-left"></i></a></li>
                    <li class="page-item"><a class="page-link" href="">1</a></li>
                    <li class="page-item"><a class="page-link" href="">2</a></li>
                    <li class="page-item"><a class="page-link" href="">3</a></li>
                    <li class="page-item"><a class="page-link" href="">4</a></li>
                    <li class="page-item"><a class="page-link" href="">5</a></li>
                    <li class="page-item"><a class="page-link" href="">6</a></li>
                    <li class="page-item"><a class="page-link" href="">7</a></li>
                    <li class="page-item"><a class="page-link" href="">8</a></li>
                    <li class="page-item">
                        <a class="page-link" href=""><i class="fa fa-arrow-right"></i> </a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>

@endsection
