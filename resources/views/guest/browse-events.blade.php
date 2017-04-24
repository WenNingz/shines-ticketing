@extends('master')

@section('title', 'Browse Events')

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
    <div class="ui stackable grid">
        <div class="one wide mobile five wide tablet three wide computer three wide large screen column">
            <form method="GET" action="/browse-events" class="ui form">
                <h4 class="ui blue header">SEARCH</h4>
                <div class="field">
                    <label>Query</label>
                    <div class="ui icon input">
                        <input name="query" type="text" placeholder="Search name" value="{{ $query }}">
                        <i class="blue search icon"></i>
                    </div>
                </div>
                <div class="ui divider"></div>
                <h4 class="ui blue header">Custom Date</h4>
                <div class="field">
                    <label>Start Date</label>
                    <input name="start_date" type="text" id="from_datepicker" placeholder="Start Date"
                           value="{{ $start_date }}">
                </div>
                <div class="field">
                    <label>End Date</label>
                    <input name="end_date" type="text" id="to_datepicker" placeholder="End Date"
                           value="{{ $end_date }}">
                </div>
                <button type="submit" class="ui basic mini blue button">Submit</button>
            </form>
        </div>

        <div class="fifteen wide mobile eleven wide tablet thirteen wide computer thirteen wide large screen column">
            <div class="ui divided items">
                @foreach($events as $event)
                    <div class="item">
                        <a class="image" href="/view-event/{{ $event->id }}">
                            @if($event->image_card == null)
                                <img src="{{ asset('img/noImage.png') }}">
                            @else
                                <img src="{{ asset($event->image_card) }}">
                            @endif
                            <p>
                                @if($event->tickets()->count() == 1)
                                    @if($event->tickets()->first()->price <= 0)
                                        Free
                                    @else
                                        ${{ $event->tickets()->first()->price }}
                                    @endif
                                @else
                                    @if($event->tickets()->min('price') == $event->tickets()->max('price'))
                                        ${{ $event->tickets()->max('price') }}
                                    @else
                                        ${{ $event->tickets()->min('price') }}
                                        - ${{ $event->tickets()->max('price') }}
                                    @endif
                                @endif
                            </p>
                        </a>
                        <div class="content">
                            <a href="/view-event/{{ $event->id }}" class="header">{{ $event->name }}
                                @if($event->created_at->addDays(7) > \Carbon\Carbon::now())
                                    <span class="ui mini green label">New</span>
                                @endif
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
                                    <i class="right share teal alternate icon link" data-content="Share"></i>
                                    <a href="/view-event/{{ $event->id }}"
                                       class="ui right floated tiny blue basic icon button">
                                        Buy tickets
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

        $(function () {
            $("#from_datepicker").datepicker({
                minDate: 0,
                dateFormat: 'yy-mm-dd'
            });
        });

        var start_date = $('#from_datepicker').val();
        $(function () {
            $("#to_datepicker").datepicker({
                minDate: start_date,
                dateFormat: 'yy-mm-dd'
            });
        });

    </script>
@endsection