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
                        <tr id="js-ticket-1">
                            <td>Case #1</td>
                            <td>Open</td>
                            <td>Mar 11, 2017</td>
                        </tr>
                        <tr>
                            <td>Case #2</td>
                            <td>Close</td>
                            <td>Yesterday</td>
                        </tr>
                        <tr>
                            <td>Case #3</td>
                            <td>Close</td>
                            <td>Yesterday</td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="3">
                                <div id="js-request" class="ui right floated mini blue basic button">
                                    New Request
                                </div>
                            </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#js-ticket-1").click(function () {
            window.location.href = "/support-ticket";
        });

        $("#js-request").click(function () {
            window.location.href = "/new-ticket";
        });

    </script>
@endsection