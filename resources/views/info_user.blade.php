@extends('layouts.app')

@section('main-container')
<div class="container">
    <div class="row" >
        <div id="app" class="col-lg-8 profile-user" >
            <info-user-component></info-user-component>
        </div>
    </div>
</div>
@endsection

@section('footer')
<!-- app -->
<script src="{!! asset('/js/app.js') !!}"></script>
@endsection
