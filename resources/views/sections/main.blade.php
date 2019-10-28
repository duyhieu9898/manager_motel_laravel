<div class="body-wrap" id="app">
    <div id="main-container" class="container-fluid">
        @yield('main-container')
        @if (Auth::check())
            <chat-application></chat-application>
        @endif

    </div>
</div>
