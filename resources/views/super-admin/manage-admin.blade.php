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

            <form class="ui form">
                <h4 class="ui dividing header">
                    Manage Admin
                </h4>
                <div class="ui stackable grid">
                    <div class="two wide mobile two wide tablet four wide computer four wide large screen column">
                        <div class="field">
                            <select class="ui selection dropdown">
                                <option value="3">All</option>
                                <option value="2">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="fourteen wide mobile fourteen wide tablet twelve wide computer twelve wide large screen column">
                        <div class="field">
                            <div class="ui icon input">
                                <input type="text" name="event" placeholder="Search admins">
                                <i class="blue search icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <table class="ui celled table">
                <thead>
                <tr>
                    <th class="four wide">Admin Name</th>
                    <th class="four wide">Email</th>
                    <th class="three wide">Date Created</th>
                    <th class="two wide">Status</th>
                    <th class="two wide">Action</th>
                </tr>
                </thead>
                <tbody>
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
                                <a class="ui mini fluid basic red button">Suspend</a>

                            @else
                                <a class="ui mini fluid basic blue button">Active</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="6">
                        <a href="/add-admin" class="ui tiny basic blue button">Add User</a>

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
@endsection