@extends('master')

@section('title', 'Manage Attendee')

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
                Manage Users
            </h3>

            <form method="GET" action="/manage-attendee" class="ui form">
                <h4 class="ui dividing header">
                    Manage Attendee
                </h4>
                <div class="ui stackable grid">
                    <div class="four wide mobile four wide tablet four wide computer four wide large screen column">
                        <div class="field">
                            <select name="status" class="ui dropdown" id="select">
                                <option value="all">All</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="twelve wide mobile twelve wide tablet twelve wide computer twelve wide large screen column">
                        <div class="field">
                            <div class="ui icon input">
                                <input type="text" name="query" placeholder="Search attendees and emails">
                                <i class="blue search icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <table class="ui unstackable celled table">
                <thead>
                <tr>
                    <th>Attendee Name</th>
                    <th>Email</th>
                    <th>Date Joined</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($users->isEmpty())
                    <tr>
                        <td colspan="5">There is no user</td>
                    </tr>
                @else
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->first_name.' '.$user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->formatLocalized('%d %B %Y') }}</td>
                            <td>
                                @if($user->status == 2 || $user->status == 3)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                            <td>
                                @if($user->status == 2 || $user->status == 3)
                                    <a class="ui mini fluid basic red button suspend" data-action="suspend"
                                       data-value="{{ $user->id }}">Suspend</a>
                                @else
                                    <a class="ui mini fluid basic blue button activate" data-action="activate"
                                       data-value="{{ $user->id }}">Activate</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="5">
                        <div class="ui tiny right floated pagination menu">
                            <a class="icon item">
                                <i class="left chevron icon"></i>
                            </a>
                            <a class="item">1</a>
                            <a class="item">2</a>
                            <a class="item">3</a>
                            <a class="item">4</a>
                            <a class="icon item">
                                <i class="right chevron icon"></i>
                            </a>
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <script>
        $('#select')
            .dropdown();
        ;

        $('.suspend, .activate').click(function () {
            $.ajax({
                url: '/suspend',
                method: 'POST',
                data: {
                    _method: 'put',
                    _token: '{{ csrf_token() }}',
                    user_id: $(this).attr('data-value'),
                    action: $(this).attr('data-action')
                },
                beforeSend: function (jqXHR, settings) {
                    console.log(settings.data);
                    return settings;
                },
                success: function (data, textStatus, jqXHR) {
                    console.log(data);
                    window.location.reload();
                }
            });
        });
    </script>
@endsection