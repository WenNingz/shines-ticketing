@extends('master')

@section('title', 'Event Details')

@section('navbar');
    @include('guest.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="nine wide mobile nine wide tablet nine wide computer nine wide large screen column">
            <div class="ui teal dividing header">
                <div class="content">Free Event</div>
            </div>
            <h1>Event Name #1</h1>
            <p>By Dina the Front End Developer</p>
        </div>

        <div class="seven wide mobile seven wide tablet seven wide computer seven wide large screen column">
            <div class="ui teal dividing header">
                <div class="content">Detail Info</div>
            </div>
            <h5>Date and Time</h5>
            <p>Fri, April 2017</p>
            <p>08.00 a.m. - 02.00 p.m.</p>
            <p>City Square KZL</p>
        </div>

        <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
            <span>Share with friends: </span>
            <i class="teal circular facebook f icon link" data-content="Facebook"></i>
            <i class="teal circular google icon link" data-content="Google+"></i>
            <i class="teal circular twitter icon link" data-content="Twitter"></i>
            <a class="ui right floated mini blue basic button">Buy tickets</a>
        </div>

        <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
            <div class="ui teal dividing header">
                <div class="content">Description</div>
            </div>
            <img class="ui centered image" src="http://placehold.it/800x200">
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