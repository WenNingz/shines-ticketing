@extends('master')

@section('title', 'Support List')

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
            <table class="ui selectable fixed single line celled table">
                <thead>
                <tr>
                    <th class="three wide">Title</th>
                    <th class="ten wide">Message</th>
                    <th class="one wide">Status</th>
                    <th class="two wide">Date Created</th>
                </tr>
                </thead>
                <tbody>
                <tr id="js-ticket-1">
                    <td>Case #1</td>
                    <td>Message Description</td>
                    <td>Open</td>
                    <td>Mar 11, 2017</td>
                </tr>
                <tr>
                    <td>Case #2</td>
                    <td>Message Description</td>
                    <td>Close</td>
                    <td>Yesterday</td>
                </tr>
                <tr>
                    <td>Case #3</td>
                    <td>Message Description</td>
                    <td>Close</td>
                    <td>Yesterday</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="4">
                        <div id="js-request" class="ui right floated tiny teal basic button">
                            New Request
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <script>
        $("#js-ticket-1").click(function (){
            window.location.href = "/support-ticket";
        });

        $("#js-request").click(function (){
            window.location.href = "/support-new-ticket";
        });

    </script>
@endsection