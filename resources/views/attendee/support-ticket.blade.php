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
            <div class="ui stackable grid">
                <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
                    <table class="ui unstackable selectable table">
                        <thead>
                        <tr>
                            <th class="eleven wide">Title</th>
                            <th class="two wide">Status</th>
                            <th class="three wide">Date Created</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($posts->isEmpty())
                            <tr>
                                <td colspan="5">There is no request</td>
                            </tr>
                        @else
                            @foreach($posts as $post)
                                <tr class="details" data-value="{{ $post->ticket_number }}">
                                    <td>{{ $post->title }}</td>
                                    <td>
                                        @if($post->status == 1)
                                            Open
                                        @elseif($post->status == 2)
                                            Replied
                                        @else
                                            Closed
                                        @endif
                                    </td>
                                    <td>{{ $post->created_at->toFormattedDateString() }}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="3">
                                <a href="/new-ticket" class="ui mini blue basic button">New Request</a>
                                {{ $posts->links('layout.semantic-paginate') }}
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