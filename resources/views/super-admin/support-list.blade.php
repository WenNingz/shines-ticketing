@extends('master')

@section('title', 'Ticket List')

@section('navbar')
    @include('super-admin.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile five wide tablet three wide computer three wide large screen column">
            <div class="ui fluid secondary vertical menu">
                @include('super-admin.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile eleven wide tablet thirteen wide computer thirteen wide large screen column">
            <h3 class="ui teal dividing header">
                Support Ticket List
            </h3>

            <form class="ui form">
                <div class="ui fluid icon input">
                    <input type="text" name="query" placeholder="Search ticket">
                    <i class="blue search icon"></i>
                </div>
            </form>

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
                            <td>Open</td>
                            <td>{{ $post->created_at->toFormattedDateString() }}</td>
                            <td>
                                <a href="/ticket-details/{{ $post->ticket_number }}"
                                   class="ui mini fluid basic blue button">Reply</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="5">
                        {{ $posts->links('layout.semantic-paginate') }}
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection