@extends('master')

@section('title', 'Browse Events')

@section('navbar')
    @include('guest.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile five wide tablet three wide computer three wide large screen column">
            <div class="ui form">
                <div class="row">
                    <div class="column">
                        <h4>Type</h4>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="featured">
                                <label>Featured</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="hot">
                                <label>Hot</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="free">
                                <label>Free</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="new">
                                <label>New</label>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="column">
                        <h4>Dates</h4>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="today">
                                <label>Today</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="tomorrow">
                                <label>Tomorrow</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="week">
                                <label>This Week</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="weekend">
                                <label>This Weekend</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="nextWeek">
                                <label>Next Week</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="month">
                                <label>This Month</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="custom">
                                <label>Custom Date</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fifteen wide mobile eleven wide tablet thirteen wide computer thirteen wide large screen column">
            <form method="GET" action="/browse-events" class="ui form">
                <div class="ui fluid icon input">
                    <input name="query" type="text" placeholder="Search events" value="{{ $query }}">
                    <i class="blue search icon"></i>
                </div>
            </form>

            <div class="ui divided items">
                @foreach($events as $event)
                    <div class="item">
                        <a class="image" href="/view-event/{{ $event->id }}">
                            @if($event->image == null)
                                <img src="{{ asset('img/noImage.png') }}">
                            @else
                                <img src="{{ asset($event->image) }}">
                            @endif
                            <p>Free</p>
                        </a>
                        <div class="content">
                            <a href="/view-event/{{ $event->id }}" class="header">{{ $event->name }}
                                <span class="ui mini green label">New</span>
                            </a>
                            <div class="meta">
                                <span>{{ \Carbon\Carbon::parse($event->date)->toDayDateTimeString() }}</span>
                            </div>
                            <div class="description">
                                <p>{{ $event->venue }}</p>
                            </div>
                            <div class="extra">
                                <div>{{ $event->ticketsCount() }} tickets available</div>
                                <div>
                                    <i class="large right share teal alternate icon link" data-content="Share"></i>
                                    <a class="ui right floated tiny blue basic button">
                                        Buy tickets<i class="right chevron icon"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
                {{ $events->links('layout.semantic-paginate') }}
            </div>
        </div>
    </div>
    <script>
        $('.icon.link')
            .popup({
                variation: "mini inverted"
            })
        ;
    </script>
@endsection