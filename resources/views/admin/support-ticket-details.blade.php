@extends('master')

@section('title', 'Ticket Details')

@section('navbar')
    @include('admin.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile three wide tablet three wide computer three wide large screen column">
            <div class="ui fluid secondary vertical menu">
                @include('admin.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile thirteen wide tablet thirteen wide computer thirteen wide large screen column">
            <h3 class="ui teal dividing header">
                Ticket Details
            </h3>

            <div class="ui stackable grid">
                <div class="sixteen wide mobile sixteen wide tablet twelve wide computer twelve wide large screen column">
                    <div align="right">Has this issue been resolved? <a href="#"> Close It</a></div>
                    <h4 class="header">
                        <p>Ticket No. {{ $post->ticket_number }}</p>
                        <p>Title : {{ $post->title }}</p>
                    </h4>
                    <div class="ui message">
                        <div class="ui comments">
                            <div class="comment">
                                <a class="avatar">
                                    <span class="teal large ui label">
                                    {{ substr($post->user->first_name, 0, 1).
                                     substr($post->user->last_name, 0, 1)}}
                                    </span>
                                </a>
                                <div class="content">
                                    <a class="author">{{ $post->user->first_name }}</a>
                                    <div class="metadata">
                                        <span class="date">{{ $post->created_at->format('M d, Y h:i A') .
                                            ' | '. $post->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <div align="justify" class="text">
                                        {{ $post->message }}
                                    </div>

                                    <div class="ui comments">
                                        <div class="comment">
                                            <a class="avatar">
                                                <span class="orange large ui label">
                                                    {{ substr(Auth::user()->first_name, 0, 1).
                                                    substr(Auth::user()->last_name, 0, 1) }}
                                                </span>
                                            </a>
                                            <div class="content">
                                                <a class="author">

                                                </a>
                                                <div class="metadata">
                                                    <span class="date">
                                                        {{ \Carbon\Carbon::now()->format('M d, Y h:i A') }}
                                                    </span>
                                                </div>
                                                <div class="text">
                                                    <form class="ui form">
                                                        <div class="field">
                                                            <textarea rows="2"></textarea>
                                                        </div>
                                                        <button class="ui mini blue basic button">Add Reply</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection