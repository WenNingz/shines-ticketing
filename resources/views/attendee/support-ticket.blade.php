@extends('master')

@section('title', 'My Tickets List')

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
                My Ticket List
            </h3>

            <div class="ui segment">
                <div class="ui secondary menu">
                    <a href='/my-tickets' class="item">
                        Active Tickets
                        <div class="ui teal label">{{ $active_posts->count() }}</div>
                    </a>
                    <a href='/solved-tickets' class="item">
                        Solved Tickets
                        <div class="ui label">{{ $solved_posts->count() }}</div>
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
                        @if(\Route::current()->getName() == 'my-tickets')
                            @if($active_posts->isEmpty())
                                <tr>
                                    <td colspan="5">There is no request</td>
                                </tr>
                            @else
                                @foreach($active_posts as $post)
                                    <tr class="details" data-value="{{ $post->ticket_number }}">
                                        <td>{{ $post->title }}</td>
                                        <td>
                                            @if($post->status == 0)
                                                <span class="text red">Closed</span>
                                            @elseif($post->status == 1)
                                                <span class="text blue">Open</span>
                                            @elseif($post->status == 2)
                                                <span class="text orange">Replied</span>
                                            @else
                                                <span class="text green">Solved</span>
                                            @endif
                                        </td>
                                        <td>{{ $post->replies->last()->updated_at->diffForHumans() }}</td>
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
                                            @if($post->status == 0)
                                                <span class="text red">Closed</span>
                                            @elseif($post->status == 1)
                                                <span class="text blue">Open</span>
                                            @elseif($post->status == 2)
                                                <span class="text orange">Replied</span>
                                            @else
                                                <span class="text green">Solved</span>
                                            @endif
                                        </td>
                                        <td>{{ $post->replies->last()->updated_at->diffForHumans() }}</td>
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