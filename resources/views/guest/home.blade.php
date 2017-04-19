@extends('master')

@section('title', 'Event Home')

@section('navbar')
    @if(auth()->check())
        @if(auth()->user()->hasRole('super-admin'))
            @include('super-admin.common.navbar')
        @elseif(auth()->user()->hasRole('admin'))
            @include('admin.common.navbar')
        @elseif(auth()->user()->hasRole('attendee'))
            @include('attendee.common.navbar')
        @endif
    @else
        @include('guest.navbar')
    @endif
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
                        <a class="ui image" href="/view-event/{{ $event->id }}">
                            @if($event->ticketsCount() == 0)
                                <div class="ui red ribbon label">Sold Out</div>
                            @endif
                            @if($event->image_card == null)
                                <img src="{{ asset('img/noImage.png') }}">
                            @else
                                <img src="{{ asset($event->image_card) }}">
                            @endif

                            <div class="ui bottom left attached teal label">
                                {{ \Carbon\Carbon::parse($event->date)->format('j M') }}
                            </div>
                        </a>
                        <div class="content">
                            <a class="ellipsis header" href="/view-event/{{ $event->id }}">{{ $event->name }} </a>
                            <div class="meta">
                                {{ $event->venue }}
                            </div>
                        </div>
                        <div class="extra content">
                            <span class="right floated purple text">
                                @if($event->ticketsCount() > 0)
                                    {{ $event->ticketsCount() }} ticket available
                                @endif
                            </span>
                            <i class="right share teal alternate icon link" data-content="Share"></i>
                        </div>
                    </div>
                @endforeach
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
@section('footer')
    @include('guest.footer')
@endsection
