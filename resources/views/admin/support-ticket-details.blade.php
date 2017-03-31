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
                            @php $replies = $post->getReplies() @endphp
                            @foreach($replies as $key => $reply)
                                <div class="comment">
                                    <a class="avatar">
                                        <span class="ui teal large label"> {{ $reply->getUserInitial() }} </span>
                                    </a>
                                    <div class="content">
                                        <a class="author"> {{ $reply->getUserName() }} </a>
                                        <div class="metadata">
                                            <span class="date">
                                                {{ $reply->created_at->format('M d, Y h:i A') . ' | '. $reply->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <div align="justify" class="text"> {{ $reply->message }} </div>

                                        @if($reply->childrenCount() > 0)
                                            <div class="ui comments">
                                                @foreach($reply->children as $child)
                                                    <div class="comment">
                                                        <a class="avatar">
                                                            <span class="ui orange large label"> {{ $child->getUserInitial() }} </span>
                                                        </a>
                                                        <div class="content">
                                                            <a class="author">{{ $child->getUserName() }}</a>
                                                            <div class="metadata">
                                                                <span class="date">
                                                                    {{ $child->created_at->format('M d, Y h:i A') . ' | '. $child->created_at->diffForHumans()}}
                                                                </span>
                                                            </div>
                                                            <div align="justify"
                                                                 class="text"> {{ $child->message }} </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                                @if($key == sizeof($replies) - 1 )
                                                    <div class="comment">
                                                        <a class="avatar">
                                                            <span class="orange large ui label">
                                                                {{ substr($user->first_name, 0, 1).substr($user->last_name, 0, 1) }}
                                                            </span>
                                                        </a>
                                                        <div class="content">
                                                            <a class="author"> {{ $user->first_name . ' ' . $user->last_name}} </a>
                                                            <div class="metadata">
                                                                <span class="date">
                                                                    {{ \Carbon\Carbon::now()->format('M d, Y h:i A') }}
                                                                </span>
                                                            </div>
                                                            <div class="text">
                                                                <form method="post"
                                                                      action="/ticket-details/{{ $post->ticket_number }}"
                                                                      class="ui form @if(sizeof($errors) > 0) error @endif">
                                                                    {{ csrf_field() }}

                                                                    @include('layout.errors')
                                                                    <div class="field">
                                                                        <textarea name="message" rows="2"></textarea>
                                                                    </div>
                                                                    <button type="submit"
                                                                            class="ui mini blue basic button">
                                                                        Add Reply
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            @if($key == sizeof($replies) - 1 )
                                                <div class="ui comments">
                                                    <div class="comment">
                                                        <a class="avatar">
                                                            <span class="orange large ui label">
                                                                {{ substr($user->first_name, 0, 1).substr($user->last_name, 0, 1) }}
                                                            </span>
                                                        </a>
                                                        <div class="content">
                                                            <a class="author"> {{ $user->first_name . ' ' . $user->last_name}} </a>
                                                            <div class="metadata">
                                                                <span class="date">
                                                                    {{ \Carbon\Carbon::now()->format('M d, Y h:i A') }}
                                                                </span>
                                                            </div>
                                                            <div class="text">
                                                                <form method="post"
                                                                      action="/ticket-details/{{ $post->ticket_number }}"
                                                                      class="ui form @if(sizeof($errors) > 0) error @endif">
                                                                    {{ csrf_field() }}

                                                                    @include('layout.errors')
                                                                    <div class="field">
                                                                        <textarea name="message" rows="2"></textarea>
                                                                    </div>
                                                                    <button type="submit"
                                                                            class="ui mini blue basic button">
                                                                        Add Reply
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.ui.form')
            .form({
                fields: {
                    message: 'empty'
                }
            });
    </script>
@endsection