@extends('master')

@section('title', 'Users Support')

@section('navbar')
    @include('admin.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile five wide tablet three wide computer three wide large screen column">
            <div class="ui fluid secondary vertical menu">
                @include('admin.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile eleven wide tablet thirteen wide computer thirteen wide large screen column">
            <h3 class="ui teal dividing header">
                Support Ticket List
            </h3>

            <div class="ui stackable grid">
                <div class="sixteen wide mobile eight wide tablet four wide computer four wide large screen column">
                    <form class="ui form">
                        <select name="category" class="ui fluid selection dropdown" id="select">
                            <option value="all" @if($category == 'all') selected="selected" @endif>All</option>
                            <option value="bill" @if($category == 'bill') selected="selected" @endif>Billing</option>
                            <option value="technical" @if($category == 'technical') selected="selected" @endif>Technical</option>
                            <option value="cs" @if($category == 'cs') selected="selected" @endif>Customer Service
                            </option>
                            <option value="other" @if($category == 'other') selected="selected" @endif>Other</option>
                        </select>
                    </form>
                </div>
            </div>

            <table class="ui unstackable table">
                <thead>
                <tr>
                    <th>Ticket No</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Request Date</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($posts->isEmpty())
                    <tr>
                        <td colspan="6">There is no issues</td>
                    </tr>
                @else
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->ticket_number }}</td>
                            <td>{{ $post->title }}</td>
                            <td>Open</td>
                            <td>{{ $post->created_at->toFormattedDateString() }}</td>
                            <td>
                                @if($post->category == 'bill')
                                    <span class="text red">Billing</span>
                                @elseif($post->category == 'technical')
                                    <span class="text blue">Technical</span>
                                @elseif($post->category == 'cs')
                                    <span class="text green">Customer Services</span>
                                @else
                                    <span>Others</span>
                                @endif
                            </td>
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
                    <th colspan="6">
                        {{ $posts->links('layout.semantic-paginate') }}
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <script>
        $('#select')
            .dropdown();

        $('select').on('change', function () {
            var category = (this.value);
            this.form.submit();
            return category;
        });
    </script>
@endsection