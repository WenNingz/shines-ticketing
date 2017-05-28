@extends('master')

@section('title', 'Ticket Details')

@section('navbar')
    @include('super-admin.common.navbar')
@endsection

@section('content')

    <div class="ui stackable grid">
        <div class="one wide mobile five wide tablet three wide computer three wide large screen column">
            <div class="ui teal fluid secondary vertical menu">
                @include('super-admin.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile eleven wide tablet thirteen wide computer thirteen wide large screen column">
            <h3 class="ui teal dividing header">
                Ticket Details
            </h3>

            <div class="ui stackable grid">
                <div class="sixteen wide mobile sixteen wide tablet twelve wide computer twelve wide large screen column">
                    <div class="ui large header">
                        <p><u>Title: {{ $post->title }}</u></p>
                    </div>
                    <p><b>Ticket No. : </b> {{ $post->ticket_number }}</p>
                    <div class="ui message">
                        <div class="ui comments">
                            @php $replies = $post->getReplies() @endphp
                            @foreach($replies as $key => $reply)
                                <div class="comment">
                                    <a class="avatar">
                                        <span class="ui teal large label">{{ $reply->getUserInitial() }}</span>
                                    </a>
                                    <div class="content">
                                        <a class="author"> {{ $reply->getUserName() }} </a>
                                        <div class="metadata">
                                            <span class="date">
                                                {{ $reply->created_at->format('M d, Y h:i A') . ' | '. $reply->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <div align="justify" class="text">{{ $reply->message }}</div>

                                        @if($reply->childrenCount() > 0)
                                            <div class="ui comments">
                                                @foreach($reply->children as $child)
                                                    <div class="comment">
                                                        <a class="avatar">
                                                            <span class="ui orange large label">{{ $child->getUserInitial() }}</span>
                                                        </a>
                                                        <div class="content">
                                                            <a class="author">{{ $child->getUserName() }}</a>
                                                            <div class="metadata">
                                                                <span class="date">
                                                                    {{ $child->created_at->format('M d, Y h:i A') . ' | '. $child->created_at->diffForHumans()}}
                                                                </span>
                                                            </div>
                                                            <div align="justify"
                                                                 class="text">{{ $child->message }}</div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                                @if($post->status != 4 && $post->status != 3)
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
                                                                          onsubmit="$('.ui.submit.button').prop('disabled', true)"
                                                                          class="ui form @if(sizeof($errors) > 0) error @endif">
                                                                        {{ csrf_field() }}

                                                                        <input type="hidden" name="close" id="close"
                                                                               value="false">

                                                                        @include('layout.errors')
                                                                        <div class="field">
                                                                            <textarea name="message"
                                                                                      rows="2"></textarea>
                                                                        </div>
                                                                        <button type="submit"
                                                                                class="ui mini blue reply submit basic button">
                                                                            Add Reply
                                                                        </button>
                                                                        <button type="submit"
                                                                                class="ui mini red basic submit close button">
                                                                            Reply & Close
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        @else
                                            @if($post->status != 4 && $post->status != 3)
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
                                                                          onsubmit="$('.ui.submit.button').prop('disabled', true)"
                                                                          class="ui form @if(sizeof($errors) > 0) error @endif">
                                                                        {{ csrf_field() }}

                                                                        <input type="hidden" name="close" id="close"
                                                                               value="false">

                                                                        @include('layout.errors')
                                                                        <div class="field">
                                                                            <textarea name="message"
                                                                                      rows="2"></textarea>
                                                                        </div>
                                                                        <button type="submit"
                                                                                class="ui mini blue reply submit basic button">
                                                                            Add Reply
                                                                        </button>
                                                                        <button type="submit"
                                                                                class="ui mini red basic close submit button">
                                                                            Reply & Close
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
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

        $('.close').on('click', function () {
            $('#close').val('true')
        });

        $('.reply').on('click', function () {
            $('#close').val('false')
        });
    </script>
@endsection