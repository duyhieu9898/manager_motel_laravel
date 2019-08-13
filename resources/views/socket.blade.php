@extends('layouts.app')

@section('head')
<style>
    header {
        height: auto !important;
    }
</style>
@endsection
@section('main-container')
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.4.5/socket.io.min.js"></script>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div id="messages">fsdfsdf</div>
        </div>
    </div>
</div>
<script>
    var socket = io.connect('http://localhost:3335');
        socket.on('message', function (data, ff) {
            console.log(data);
            //$( "#messages" ).append( "<p>"+data.actionData+"</p>" );
          });

          $('#messages').click(function (e) {
              e.preventDefault();


          });

</script>

@endsection
