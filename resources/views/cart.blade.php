@extends('layouts.app')

@section('content')
<div id="app" class="container main-content">
    <div class="row mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">cart</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Cart</h3>
                            @if ($rooms->isNotEmpty())
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:15%;">Image</th>
                                        <th style="width:30%;">Room title</th>
                                        <th style="width:10%;">Tenants</th>
                                        <th style="width:10%;">Price</th>
                                        <th style="width:17.5%;">Arrival date</th>
                                        <th style="width:17.5%;">Departure date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($rooms as $room)
                                    <tr>
                                        <td>
                                            <div class="box-image">
                                                <img class="reponsive" src="{{ $room['images'][0]['file_name'] }}" alt="">
                                            </div>
                                        </td>
                                        <td>{{ $room->title }}</td>
                                        <td>{{ $room->pivot->peoples }}</td>
                                        <td>{{ $room->price }}/vnd</td>
                                        <td>{{ $room->pivot->arrival_date }}</td>
                                        <td>{{ $room->pivot->departure_date }}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <p>There are no rooms in the cart</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-sm-12">
                    <info-user-component></info-user-component>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
            @if ($rooms->isNotEmpty())
                <div class="col-sm-offset-5 col-sm-12">
                    <form action="/check-out/" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success">Check Out</button>
                        <a href="/" class="btn btn-primary" role="button">Back To Home</a>
                    </form>
                </div>
            @else
                <div class="col-sm-offset-3 col-sm-12">
                    <a href="/" class="btn btn-primary" role="button">Back To Home</a>
                </div>
            @endif
        </div>
</div>

</div>
@endsection
@section('footer')
<!-- app -->
<script src="{!! asset('/js/app.js') !!}"></script>
@endsection
