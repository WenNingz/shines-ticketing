<div class="ui container">
    <div class="ui fixed menu">
        <a href="home">
            <img class="logo" src="https://placeholdit.imgix.net/~text?txtsize=18&txt=ShineS+ServiceS&w=150&h=50">
        </a>
        <div class="right menu">

            <a href="event" class="item">EVENT</a>
            <a href="#" class="item">HELP</a>
            <div class="ui simple dropdown item">
                <i class="circular teal user icon"></i>
                <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" href="admin-dashboard">
                        @if(auth()->check())
                            {{ auth()->user()->first_name }}
                        @endif
                    </a>
                    <a class="item" href="tickets">Tickets</a>
                    <a class="item" href="profile">Account Setting</a>
                    <a class="item" href="/logout">Log Out</a>
                </div>
            </div>
        </div>
    </div>
</div>