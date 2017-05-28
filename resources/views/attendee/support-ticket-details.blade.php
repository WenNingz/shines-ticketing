@extends('master')

@section('title', 'Ticket Details')

@section('navbar')
    @include('attendee.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile five wide tablet three wide computer three wide large screen column">
            <div class="ui teal fluid secondary vertical menu">
                @include('attendee.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile eleven wide tablet thirteen wide computer thirteen wide large screen column">
            <h3 class="ui teal dividing header">
                Ticket Details
            </h3>

            <div class="ui stackable grid">
                <div class="sixteen wide mobile sixteen wide tablet twelve wide computer twelve wide large screen column">
                    @if($post->status != 4 && $post->status != 3)
                        <div align="right">
                            Has this issue been resolved?
                            <a href="/my-tickets/{{$post->ticket_number}}/close"> Close It</a>
                        </div>
                    @endif

                    <div class="ui large header">
                        <p><u>Title: {{ $post->title }}</u></p>
                    </div>
                    <div class="ui stackable grid">
                        <div class="eight wide mobile eight wide tablet eight wide computer eight wide large screen column">
                            <p><b>Ticket No: </b>{{ $post->ticket_number }}</p>
                            <p><b>Status: </b>
                                @if($post->status == 4)
                                    <span class="text red">Closed</span>
                                @elseif($post->status == 1)
                                    <span class="text blue">Open</span>
                                @elseif($post->status == 2)
                                    <span class="text orange">Replied</span>
                                @elseif($post->status == 3)
                                    <span class="text green">Solved</span>
                                @endif
                            </p>
                        </div>
                        <div class="eight wide mobile eight wide tablet eight wide computer eight wide large screen column">
                            <p><b>Created: </b>{{ $post->created_at->diffForHumans()}}</p>
                            <p><b>Last Updated: </b>{{ $post->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
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
                                                            <a class="author"> {{ $child->getUserName() }} </a>
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
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            @if($post->status != 4 && $post->status != 3)
                                <div class="comment">
                                    <a class="avatar">
                                        <span class="teal large ui label">
                                            {{ substr($user->first_name, 0, 1).substr($user->last_name, 0, 1) }}
                                        </span>
                                    </a>
                                    <div class="content">
                                        <a class="author"> {{ $user->first_name . ' ' . $user->last_name}} </a>
                                        <div class="metadata">
                                            <span class="date">{{ \Carbon\Carbon::now()->format('M d, Y h:i A') }}</span>
                                        </div>
                                        <div class="text">
                                            <form method="post" action="/ticket-details/{{ $post->ticket_number }}"
                                                  onsubmit="$('.ui.submit.button').prop('disabled', true)"
                                                  class="ui form @if(sizeof($errors) > 0) error @endif">
                                                {{ csrf_field() }}
                                                @include('layout.errors')
                                                <div class="field">
                                                    <textarea name="message" rows="2"></textarea>
                                                </div>
                                                <button type="submit" class="ui mini blue submit basic button">
                                                    Add Reply
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
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
                    message: {
                        identifier: 'message',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'The message field is required.'
                            }
                        ]
                    }
                },
                onFailure: function () {
                    $('.ui.submit.button').prop('disabled', false);
                    return false;
                }
            });
    </script>
@endsection