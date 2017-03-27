@extends('master')

@section('title', 'Ticket Details')

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
                Ticket Details
            </h3>

            <h4 class="header">Ticket No. {{ $post->ticket_number }}</h4>
            <h4 class="header">Title : {{ $post->title }}</h4>

            <div class="ui message">
                <div class="ui comments">
                    <div class="comment">
                        <a class="avatar teal large ui label">{{ substr($post->user->first_name, 0, 1) }}</a>

                        <div class="content">
                            <a class="author">{{ $post->user->first_name }}</a>
                            <div class="metadata">
                                <span class="date">{{ $post->created_at }}</span>
                            </div>
                            <div class="text">
                                {{ $post->message }}
                            </div>

                            <div class="ui comments">
                                <div class="comment">
                                    <a class="avatar orange large ui label">A</a>
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