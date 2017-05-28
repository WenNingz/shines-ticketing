@extends('master')

@section('title', 'Sync Event')

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
                Sync Event
            </h3>

            <div class="ui stackable grid">
                <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
                    <a href="/sync-events" class="ui right floated basic tiny red icon button">Refresh</a>
                </div>

                <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
                    <div class="ui middle aligned animated divided relaxed list">
                        @include('layout.success')
                        @if($events->isEmpty())
                            <div>There is no new event</div>
                        @else
                            @foreach($events as $event)
                                <div class="item">
                                    <div class="right floated content">
                                        <a class="ui basic mini blue button"
                                           href="/edit-event/{{ $event->id }}">Edit</a>
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
                </div>
                <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
                    {{ $events->links('layout.semantic-paginate') }}
                </div>
            </div>
        </div>
    </div>
@endsection