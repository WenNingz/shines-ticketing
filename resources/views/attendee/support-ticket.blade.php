@extends('master')

@section('title', 'All Events')

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
            <h3 class="ui teal dividing header">
                Support Ticket
            </h3>

            <h4 class="header">Ticket No. 123-456-789</h4>
            <h4 class="header">Title : Case #1</h4>

            <div class="ui message">
                <div class="ui comments">
                    <div class="comment">
                        <a class="avatar"><img src="http://placehold.it/15x15"></a>

                        <div class="content">
                            <a class="author">User Name</a>
                            <div class="metadata">
                                <span class="date">Mar 11, at 5:42PM</span>
                            </div>
                            <div class="text">
                                I'm very interested in this motherboard. Do you know if it'd work in a Intel LGA775 CPU
                                socket?
                            </div>

                            <div class="ui comments">
                                <div class="comment">
                                    <a class="avatar"><img src="http://placehold.it/15x15"></a>
                                    <div class="content">
                                        <a class="author">Admin #1</a>
                                        <div class="metadata">
                                            <span class="date">Mar 11, at 5:42PM</span>
                                        </div>
                                        <div class="text">
                                            Yes
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comment">
                            <a class="avatar"><img src="http://placehold.it/15x15"></a>

                            <div class="content">
                                <a class="author">User Name</a>
                                <div class="metadata">
                                    <span class="date">Mar 11, at 5:47PM</span>
                                </div>
                                <div class="text">
                                    Ok
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection