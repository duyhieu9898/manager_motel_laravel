@extends('layouts.app')

@section('header')
<div class="container">
    <div class="row" style="margin-top:90px;">
        <div class="col-lg-8 profile-user" id="app">
            <info-user-component></info-user-component>
        </div>
    </div>
</div>
@endsection

@section('footer')
<!-- app -->
<script src="{!! asset('/js/app.js') !!}"></script>

@endsection
