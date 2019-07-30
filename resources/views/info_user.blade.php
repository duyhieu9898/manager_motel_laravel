@extends('layouts.app')

@section('content')
<div id="app" class="container main-content">
    <div class="row" style="margin-top:90px;">
        <div class="col-lg-offset-2 col-lg-8">
            <info-user-component></info-user-component>
        </div>
    </div>
</div>
@endsection
@section('footer')
<!-- app -->
<script src="{!! asset('/js/app.js') !!}"></script>
@endsection
