@extends('master')

@section('title', 'Users Support')

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
            <h3 class="ui blue dividing header">
                Support Ticket List
            </h3>

            <form class="ui form">
                <div class="ui fluid icon input">
                    <input type="text" name="event" placeholder="Search ticket">
                    <i class="blue search icon"></i>
                </div>
            </form>

            <table class="ui fixed single line celled table">
                <thead>
                <tr><th class="two wide">Ticket No</th>
                    <th class="two wide">Title</th>
                    <th class="six wide">Message</th>
                    <th class="two wide">Status</th>
                    <th class="two wide">Date Created</th>
                    <th class="two wide">Action</th>
                </tr></thead>
                <tbody>
                <tr>
                    <td>123-456-789</td>
                    <td>Case #1</td>
                    <td>Message Description</td>
                    <td>Open</td>
                    <td>Mar 15, 2017</td>
                    <td><a href="ticket-details" class="ui mini basic blue button">Reply</a></td>
                </tr>
                <tr>
                    <td>123-456-799</td>
                    <td>Case #2</td>
                    <td>Message Description</td>
                    <td>Pending</td>
                    <td>Mar 11, 2017</td>
                    <td><a href="ticket-details" class="ui mini basic blue button">Reply</a></td>
                </tr>
                </tbody>
                <tfoot>
                <tr><th colspan="6">
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