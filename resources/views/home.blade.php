@extends('layouts.app')
@section('head')
<style>
    header {
        height: auto !important;
    }
</style>


@endsection
@section('main-container')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="min-height: 600px">
            <chat-application></chat-application>
        </div>
    </div>
</div>
@endsection
@section('footer')
<!-- app -->
<script src="{!! asset('/js/app.js') !!}"></script>

@endsection
