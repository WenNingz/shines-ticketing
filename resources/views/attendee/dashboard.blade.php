@extends('master')

@section('title', 'Dashboard')

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
            <h3 class="ui teal dividing header">
                Upcoming Event
            </h3>
            <div class="ui segment">
                <div class="ui four fluid stackable link cards">
                    <div id="js-event-1" class="card">
                        <div class="content">
                            <div class="header">Event Name #3</div>
                            <div class="description">
                                <p>Date & Time</p>
                                <p>Location</p>
                                <p>By ..... </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="ui teal dividing header">
                Purchased Tickets
            </h3>
            <div class="ui segment">
                <div class="ui four fluid stackable link cards">
                    <div id="js-event-2" class="card">
                        <div class="content">
                            <div class="header">Event Name #3</div>
                            <div class="description">
                                <p>Date & Time</p>
                                <p>Location</p>
                                <p>By ..... </p>
                            </div>
                        </div>
                    </div>
                    <div id="js-event-2" class="card">
                        <div class="content">
                            <div class="header">Event Name #3</div>
                            <div class="description">
                                <p>Date & Time</p>
                                <p>Location</p>
                                <p>By ..... </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.ui .item').on('click', function () {
                $('.ui .item').removeClass('active');
                $(this).addClass('active');
            });
        });

        $("#js-event-1").click(function () {
            window.location.href = "/event-details";
        });

        $("#js-event-2").click(function () {
            window.location.href = "/event-details";
        });

    </script>
@endsection