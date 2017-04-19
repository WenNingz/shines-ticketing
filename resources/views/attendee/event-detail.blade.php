@extends('master')

@section('title', 'Event Details')

@section('navbar')
    @include('attendee.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile five wide tablet three wide computer three wide large screen column">
            <div class="ui fluid secondary vertical menu">
                @include('attendee.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile eleven wide tablet thirteen wide computer thirteen wide large screen column">
            <div class="ui stackable grid">
                <div class="nine wide mobile nine wide tablet nine wide computer nine wide large screen column">
                    <div class="ui teal dividing header">
                        <div class="content">Event Details</div>
                    </div>

                    <h2>{{ $event->name }}</h2>
                    <p>By Dina the Front End Developer</p>
                    <h4>Date and Time</h4>
                    <p>{{ \Carbon\Carbon::parse($event->date)->format('l, j F Y') }}</p>
                    <p>{{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}</p>
                    <p>{{ $event->venue }}</p>
                </div>

                <div class="seven wide mobile seven wide tablet seven wide computer seven wide large screen column">
                    <div class="ui teal dividing header">
                        <div class="content">Purchase Details</div>
                    </div>
                    <p>Ticket ID : 1234567</p>
                    <p>Password : <a>Show</a></p>
                </div>

                <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
                    <div class="ui teal dividing header">
                        <div class="content">Description</div>
                    </div>
                    <div align="justify" class="ui text container">
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
@endsection