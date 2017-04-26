@extends('master')

@section('title', 'Event Details')

@section('navbar')
    @include('admin.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile five wide tablet three wide computer three wide large screen column">
            <div class="ui fluid secondary vertical menu">
                @include('admin.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile eleven wide tablet thirteen wide computer thirteen wide large screen column">
            <div class="ui stackable grid">

                <div class="nine wide mobile nine wide tablet nine wide computer nine wide large screen column">
                    <div class="ui teal dividing header">
                        <div class="content">Event Detail</div>
                    </div>
                    <h2>{{ $event->name }}</h2>
                    <h5>Date and Time</h5>
                    <p>{{ \Carbon\Carbon::parse($event->date)->format('l, j F Y') }}</p>
                    <p>{{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}</p>
                    <p>{{ $event->venue }}</p>
                    {{--<p class="blue text"><i class="unhide icon"></i> 1002 </p>--}}
                    @if($event->tags()->count() > 0)
                        <span>Tags: </span>
                        @foreach($event->tags as $tag)
                            <a class="ui black basic label">{{ $tag->name}}</a>
                        @endforeach
                    @endif
                </div>

                <div class="seven wide mobile seven wide tablet seven wide computer seven wide large screen column">
                    <div class="ui teal dividing header">
                        <div class="content">Ticket Info</div>
                    </div>
                    <table class="ui unstackable small compact table">
                        <thead>
                        <tr>
                            <th>Ticket Type</th>
                            <th>Total</th>
                            <th>Remaining</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($event->tickets as $ticket)
                            <tr>
                                <td>
                                    <h5 class="ui header">{{ $ticket->name }}
                                        <div class="sub header">{{ $ticket->description }}</div>
                                    </h5>
                                </td>
                                <td>{{ $ticket->total }} Tickets</td>
                                <td>{{ $ticket->available }} Tickets</td>
                                <td>${{ $ticket->price }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
                    <div class="ui teal dividing header">
                        <div class="content">Description</div>
                    </div>
                    <div class="ui justified text container">
                        @if($event->image_ori != null)
                            <img class="ui centered image" src="{{ asset($event->image_ori) }}">
                            <div class="ui divider"></div>
                        @endif
                        {!! $event->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.message .close')
            .on('click', function () {
                $(this)
                    .closest('.message-holder')
                    .remove()
                ;
            })
        ;
    </script>
@endsection