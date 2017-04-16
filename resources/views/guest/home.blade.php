@extends('master')

@section('title', 'Event Home')

@section('navbar')
    @include('guest.navbar')
@endsection

@section('content')
    @include('layout.flash')
    <form action="/browse-events" action="GET" class="ui form center aligned raised padded segment">
        <h4 class="amatic-4">"The only source of Knowledge <br> is Experience"</h4>
        <span class="amatic-2">by Albert Einstein</span>
        <p class="font-2">Seek your knowledge</p>

        <div class="ui stackable centered grid">
            <div class="six wide mobile six wide tablet four wide computer four wide large screen column">
                <input name="query" type="text" placeholder="Search events">
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
            <div class="four wide mobile four wide tablet two wide computer two wide large screen column">
                <button type="submit" class="ui fluid teal basic button">Search</button>
            </div>
        </div>
    </form>

    <div class="ui basic padded segment">
        <div class="ui container">
            <div class="ui four doubling stackable cards">
                @foreach($events as $event)
                    <div class="ui card">
                        <a class="ui image" href="/">
                            <div class="ui yellow ribbon label">{{ \Carbon\Carbon::parse($event->date)->format('j M') }}</div>
                            @if($event->image == null)
                                <img src="{{ asset('img/noImage.png') }}">
                            @else
                                <img src="{{ asset($event->image) }}">
                            @endif
                        </a>
                        <div class="content">
                            <a class="header" href="/">{{ $event->name }}</a>
                            <div class="description">
                            </div>
                            <div class="meta">
                                {{ $event->venue }}
                            </div>
                        </div>
                        <div class="extra content">
                            <span class="right floated">{{ $event->ticketsCount() }} ticket available</span>
                            <i class="large right share teal alternate icon link" data-content="Share"></i>
                        </div>
                    </div>
                @endforeach
            </div>

            {{ $events->links('layout.semantic-paginate') }}
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
@section('footer')
    @include('guest.footer')
@endsection
