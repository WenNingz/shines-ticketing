@extends('master')

@section('title', 'Event Home')

@section('navbar')
    @include('guest.navbar')
@endsection

@section('content')
    <form action="events" action="GET" class="ui form center aligned raised segment">
        <h4 class="font-4">"The only source of Knowledge <br> is Experience"</h4>
        <span class="font-2">by Albert Einstein</span>
        <p class="font-2">Seek your knowledge</p>

        <div class="ui stackable centered grid">
            <div class="four wide column">
                <input type="text" placeholder="Search events">
            </div>
            {{--<div class="three wide column">
                <select class="ui fluid selection dropdown">
                    <option value="all">All Dates</option>
                    <option value="today">Today</option>
                    <option value="tomorrow">Tomorrow</option>
                    <option value="week">This Week</option>
                    <option value="weekend">This Weekend</option>
                    <option value="nextWeek">Next Week</option>
                    <option value="month">Next Month</option>
                </select>
            </div>--}}
            <div class="two wide column">
                <button type="submit" class="ui fluid teal basic button">Search</button>
            </div>
        </div>
    </form>

    <div class="ui form basic padded segment">
        <div class="ui stackable grid">
            <div class="ui four stackable doubling cards">
                <div class="ui card">
                    <a class="ui image" href="event-detail">
                        <div class="ui yellow ribbon label">Featured</div>
                        <img src="http://placehold.it/250x150">
                    </a>
                    <div class="content">
                        <a class="header" href="event-detail">Event Name #1</a>
                        <div class="description">
                            Event #1 Location
                        </div>
                        <div class="meta">
                            Date & Time
                        </div>
                    </div>
                    <div class="extra content">
                    <span class="right floated">
                        ### ticket available
                    </span>
                        <i class="large right share teal alternate icon link" data-content="Share"></i>
                    </div>
                </div>
                <div class="ui card">
                    <a class="ui image">
                        <div class="ui red ribbon label">Hot</div>
                        <img src="http://placehold.it/250x150">
                    </a>
                    <div class="content">
                        <a class="header">Event Name #1</a>
                        <div class="description">
                            Event #1 Location
                        </div>
                        <div class="meta">
                            Date & Time
                        </div>
                    </div>
                    <div class="extra content">
                    <span class="right floated">
                        ### ticket available
                    </span>
                        <i class="large right share teal alternate icon link" data-content="Share"></i>
                    </div>
                </div>
                <div class="ui card">
                    <a class="ui image">
                        <div class="ui green ribbon label">New</div>
                        <img src="http://placehold.it/250x150">
                    </a>
                    <div class="content">
                        <a class="header">Event Name #1</a>
                        <div class="description">
                            Event #1 Location
                        </div>
                        <div class="meta">
                            Date & Time
                        </div>
                    </div>
                    <div class="extra content">
                    <span class="right floated">
                        ### ticket available
                    </span>
                        <i class="large right share teal alternate icon link" data-content="Share"></i>
                    </div>
                </div>
                <div class="ui card">
                    <a class="ui image">
                        <div class="ui teal ribbon label">Free</div>
                        <img src="http://placehold.it/250x150">
                    </a>
                    <div class="content">
                        <a class="header">Event Name #1</a>
                        <div class="description">
                            Event #1 Location
                        </div>
                        <div class="meta">
                            Date & Time
                        </div>
                    </div>
                    <div class="extra content">
                    <span class="right floated">
                        ### ticket available
                    </span>
                        <i class="large right share teal alternate icon link" data-content="Share"></i>
                    </div>
                </div>
                <div class="ui card">
                    <a class="ui image">
                        <div class="ui teal ribbon label">Free</div>
                        <img src="http://placehold.it/250x150">
                    </a>
                    <div class="content">
                        <a class="header">Event Name #1</a>
                        <div class="description">
                            Event #1 Location
                        </div>
                        <div class="meta">
                            Date & Time
                        </div>
                    </div>
                    <div class="extra content">
                    <span class="right floated">
                        ### ticket available
                    </span>
                        <i class="large right share teal alternate icon link" data-content="Share"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.ui.selection.dropdown')
            .dropdown()
        ;

        $('.icon.link')
            .popup({
                variation: "mini inverted"
            })
        ;
    </script>

@endsection
