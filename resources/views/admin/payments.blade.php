@extends('master')

@section('title', 'All Events')

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
                Payment Transaction
            </h3>

            <form class="ui form">
                <div class="ui fluid icon input">
                    <input type="text" name="event" placeholder="Search payment">
                    <i class="blue search icon"></i>
                </div>
            </form>

            <table class="ui fixed single line celled table">
                <thead>
                <tr>
                    <th class="four wide">Transaction No</th>
                    <th class="two wide">Type</th>
                    <th class="four wide">Name</th>
                    <th class="four wide">Event</th>
                    <th class="two wide">Status</th>
                    <th class="two wide">Paid Date</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>RNV-123456</td>
                    <td>Visa Card</td>
                    <td>Attendee #1</td>
                    <td>Event Name #1</td>
                    <td>Pending</td>
                    <td>Mar 15, 2017</td>
                </tr>
                <tr>
                    <td>RNV-123456</td>
                    <td>Master Card</td>
                    <td>Attendee #1</td>
                    <td>Event Name #1</td>
                    <td>Complete</td>
                    <td>Mar 15, 2017</td>
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