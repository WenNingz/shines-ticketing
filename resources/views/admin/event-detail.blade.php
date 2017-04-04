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
                <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column message-holder">
                    <div class="ui success message">
                        <i class="close icon"></i>
                        <div class="header">
                            Saved/Publish Successfully
                        </div>
                    </div>
                </div>

                <div class="nine wide mobile nine wide tablet nine wide computer nine wide large screen column">
                    <div class="ui teal dividing header">
                        <div class="content">Event Detail</div>
                    </div>
                    <h2>Event Name #1</h2>
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
                    <div class="ui inverted dividing"></div>
                    <span>Share with friends: </span>
                    <i class="teal circular facebook f icon link" data-content="Facebook"></i>
                    <i class="teal circular google icon link" data-content="Google+"></i>
                    <i class="teal circular twitter icon link" data-content="Twitter"></i>
                </div>

                <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
                    <div class="ui teal dividing header">
                        <div class="content">Event Description</div>
                    </div>
                    <div class="ui right aligned basic segment">
                        <a href="admin-event-edit" class="ui tiny basic teal button">Edit</a>
                        <a class="ui tiny basic green button">Publish</a>
                    </div>

                    <img class="ui centered image" src="http://placehold.it/800x200">
                    <div class="description">
                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                            Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu
                            libero sit
                            amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
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
        $('.icon.link')
            .popup({
                variation: "mini inverted"
            })
        ;
    </script>
@endsection