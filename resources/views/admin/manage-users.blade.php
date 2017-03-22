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

            <form class="ui form">
                <div class="ui fluid icon input">
                    <input type="text" name="event" placeholder="Search attendee">
                    <i class="blue search icon"></i>
                </div>
            </form>

            <table class="ui celled table">
                <thead>
                <tr><th class="one wide">ID No</th>
                    <th class="five wide">Attendee Name</th>
                    <th class="five wide">Email</th>
                    <th class="two wide">Date Joined</th>
                    <th class="one wide">Membership</th>
                    <th class="two wide">Action</th>
                </tr></thead>
                <tbody>
                <tr>
                    <td>111</td>
                    <td>Attendee #1</td>
                    <td>attendee#1@gmail.com</td>
                    <td>Mar 15, 2017</td>
                    <td>No</td>
                    <td><a class="ui mini basic red button">Suspend</a></td>
                </tr>
                <tr>
                    <td>112</td>
                    <td>Attendee #2</td>
                    <td>attendee#2@yahoo.com</td>
                    <td>Feb 30, 2019</td>
                    <td>Yes</td>
                    <td><a class="ui mini basic red button">Suspend</a></td>
                </tr>
                </tbody>
                <tfoot>
                <tr><th colspan="6">
                        <a class="ui small basic blue button">Add User</a>

                        <a class="ui small disabled button">Suspend All</a>

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
                </tr></tfoot>
            </table>
        </div>
    </div>
@endsection