@extends('master')

@section('title', 'Event Detail')

@section('navbar')
    @include('attendee.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile three wide tablet three wide computer three wide large screen column">
            <div class="ui fluid secondary vertical menu">
                @include('attendee.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile thirteen wide tablet thirteen wide computer thirteen wide large screen column">
            <div class="ui stackable grid">
                <div class="nine wide mobile nine wide tablet nine wide computer nine wide large screen column">
                    <div class="ui teal dividing header">
                        <div class="content">Event Details</div>
                    </div>

                    <h2>Event Name #1</h2>
                    <p>By Dina the Front End Developer</p>
                    <h4>Date and Time</h4>
                    <p>Fri, April 2017</p>
                    <p>08.00 a.m. - 02.00 p.m.</p>
                    <p>City Square KZL</p>
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
                    <img class="ui centered image" src="http://placehold.it/800x200">
                </div>
            </div>
        </div>
    </div>
@endsection