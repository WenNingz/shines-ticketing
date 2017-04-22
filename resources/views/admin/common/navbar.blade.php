<div class="ui container">
    <div class="ui fixed menu">
        <a href="/">
            <img class="logo" src="{{ asset('img/logo.png') }}">
        </a>
        <div class="right menu">

            <a href="/browse-events" class="item">EVENT</a>
            <a href="/ticket-list" class="item">HELP</a>
            <div class="ui simple dropdown item">
                <i class="circular teal user icon"></i>
                <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" href="/dashboard">
                        @if(auth()->check())
                            {{ auth()->user()->first_name }}
                        @endif
                    </a>
                    <a class="item" href="/profile">Account Setting</a>
                    <a class="item" href="/logout">Log Out</a>
                </div>
            </div>
        </div>
    </div>
</div>