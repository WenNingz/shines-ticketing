@extends('master')

@section('title', 'My Tickets List')

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
                My Ticket List
            </h3>

            @php
                $my_ticket = \Route::current()->getName() == 'my-tickets';
                $solved_tickets = \Route::current()->getName() == 'solved-tickets';
            @endphp

            <div class="ui segment">
                <div class="ui secondary menu">
                    <a href='/my-tickets' class="@if($my_ticket) active @endif item">
                        Active Tickets
                        <div class="ui @if($my_ticket) teal @endif  label">{{ \Auth::user()->activePostCount() }}</div>
                    </a>
                    <a href='/solved-tickets' class="@if($solved_tickets) active @endif item">
                        Solved Tickets
                        <div class="ui @if($solved_tickets) teal @endif label">{{ \Auth::user()->solvedPostCount() }}</div>
                    </a>
                </div>
            </div>
            <div class="ui stackable grid">
                <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
                    <table class="ui unstackable selectable table">
                        <thead>
                        <tr>
                            <th class="eleven wide">Title</th>
                            <th class="two wide">Status</th>
                            <th class="three wide">Last Updated</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($my_ticket)
                            @if($active_posts->isEmpty())
                                <tr>
                                    <td colspan="5">There is no issues</td>
                                </tr>
                            @else
                                @foreach($active_posts as $post)
                                    <tr class="details" data-value="{{ $post->ticket_number }}">
                                        <td>{{ $post->title }}</td>
                                        <td>
                                            @if($post->status == 1)
                                                <span class="text blue">Open</span>
                                            @elseif($post->status == 2)
                                                <span class="text orange">Replied</span>
                                            @endif
                                        </td>
                                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        @else
                            @if($solved_posts->isEmpty())
                                <tr>
                                    <td colspan="5">There is no request</td>
                                </tr>
                            @else
                                @foreach($solved_posts as $post)
                                    <tr class="details" data-value="{{ $post->ticket_number }}">
                                        <td>{{ $post->title }}</td>
                                        <td>
                                            @if($post->status == 4)
                                                <span class="text red">Closed</span>
                                            @elseif ($post->status == 3)
                                                <span class="text green">Solved</span>
                                            @endif
                                        </td>
                                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        @endif
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="3">
                                <a href="/new-ticket" class="ui mini blue basic button">Create new ticket</a>
                                @if(\Route::current()->getName() == 'my-tickets')
                                    {{ $active_posts->links('layout.semantic-paginate') }}
                                @else
                                    {{ $solved_posts->links('layout.semantic-paginate') }}
                                @endif
                            </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".details").click(function () {
            window.location.href = "/ticket-details/" + $(this).attr('data-value');
        });
    </script>
@endsection