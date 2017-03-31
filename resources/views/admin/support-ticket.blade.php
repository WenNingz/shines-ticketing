@extends('master')

@section('title', 'Support Ticket')

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
            <h3 class="ui blue dividing header">
                My Tickets
            </h3>
            <div class="ui stackable grid">
                <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
                    <table class="ui unstackable table">
                        <thead>
                        <tr>
                            <th>Ticket No</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Request Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($posts->isEmpty())
                            <tr>
                                <td colspan="5">There is no request</td>
                            </tr>
                        @else
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->ticket_number }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>@if($post->status == 1)
                                            Open
                                        @elseif($post->status == 2)
                                            Replied
                                        @else
                                            Closed
                                        @endif
                                    </td>
                                    <td>{{ $post->created_at->toFormattedDateString() }}</td>
                                    <td>
                                        <a href="/ticket-details/{{ $post->ticket_number }}"
                                           class="ui mini fluid basic blue button">Reply</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        <tfoot>
                        <tr>
                            <th colspan="5">{{ $posts->links('layout.semantic-paginate') }}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--When attendee reply to admin support, table cell will be highlighted and move to the top--}}