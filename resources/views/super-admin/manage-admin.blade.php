@extends('master')

@section('title', 'Manage Admin')

@section('navbar')
    @include('super-admin.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile three wide tablet three wide computer three wide large screen column">
            <div class="ui fluid secondary vertical menu">
                @include('super-admin.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile thirteen wide tablet thirteen wide computer thirteen wide large screen column">
            <h3 class="ui teal dividing header">
                Manage Users
            </h3>

            <form method="GET" action="/manage-admin" class="ui form">
                <h4 class="ui dividing header">
                    Manage Admin
                </h4>
                <div class="ui stackable grid">
                    <div class="four wide mobile four wide tablet four wide computer four wide large screen column">
                        <div class="field">
                            <select name="status" class="ui dropdown" id="select">
                                <option value="all" @if($status == 'all') selected="selected" @endif>All</option>
                                <option value="active" @if($status == 'active') selected="selected" @endif>Active</option>
                                <option value="inactive" @if($status == 'inactive') selected="selected" @endif>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="twelve wide mobile twelve wide tablet twelve wide computer twelve wide large screen column">
                        <div class="field">
                            <div class="ui icon input">
                                <input type="text" name="query" placeholder="Search admins and emails" value="{{ $search }}">
                                <i class="blue search icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <table class="ui unstackable celled table">
                <thead>
                <tr>
                    <th>Admin Name</th>
                    <th>Email</th>
                    <th>Date Created</th>
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
                            <td>{{ $user->first_name.' '.$user->last_name  }}</td>
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
                    <th colspan="6">
                        <a href="/add-admin" class="ui tiny basic blue button">Add User</a>


                        {{--<div class="ui tiny right floated pagination menu">
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
                        </div>--}}
                        {{ $users->links('layout.semantic-paginate') }}
                        {{--{{ (new Landish\Pagination\SemanticUI($users))->links() }}--}}
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

        $('select').on('change', function() {
            var status = (this.value);
            this.form.submit();
            return status;
        });

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