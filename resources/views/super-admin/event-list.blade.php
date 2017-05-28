@extends('master')

@section('title', 'Events List')

@section('navbar')
    @include('super-admin.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile five wide tablet three wide computer three wide large screen column">
            <div class="ui teal fluid secondary vertical menu">
                @include('super-admin.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile eleven wide tablet thirteen wide computer thirteen wide large screen column">
            <h3 class="ui teal dividing header">
                Events List
            </h3>

            <form method="GET" action="/event-list" class="ui form">
                <div class="ui stackable grid">
                    <div class="four wide mobile sixteen wide tablet four wide computer four wide large screen column">
                        <div class="field">
                            <select name="status" class="ui fluid selection dropdown" id="select">
                                <option value="all" @if($status == 'all') selected="selected" @endif>All</option>
                                <option value="ongoing" @if($status == 'ongoing') selected="selected" @endif>On Going
                                </option>
                                <option value="complete" @if($status == 'complete') selected="selected" @endif>
                                    Completed
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="twelve wide mobile sixteen wide tablet twelve wide computer twelve wide large screen column">
                        <div class="ui fluid icon input">
                            <input type="text" name="query" placeholder="Search events" value="{{ $query }}">
                            <i class="blue search icon"></i>
                        </div>
                    </div>
                </div>
            </form>

            <div class="ui middle aligned animated divided list">
                @if($events->isEmpty())
                    <div>There is no event</div>
                @else
                    @foreach($events as $event)
                        <div class="item">
                            <div class="right floated content">
                                <a class="ui basic mini blue button"
                                   href="/event-details/{{ $event->id }}">Manage</a>
                            </div>
                            <h3 class="ui blue header">{{ $event->name }}
                                <div class="sub header">{{ \Carbon\Carbon::parse($event->date)->toDayDateTimeString() }}</div>
                            </h3>
                            <div class="description">
                                <i class="marker icon"></i>
                                {{ $event->venue }}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
                {{ $events->links('layout.semantic-paginate') }}
            </div>
        </div>
    </div>

    <script>
        $('#select')
            .dropdown();
        ;

        $('select').on('change', function () {
            var status = (this.value);
            this.form.submit();
            return status;
        });
    </script>
@endsection