@extends('master')

@section('title', 'Events List')

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
                Events List
            </h3>

            <form class="ui form">
                <div class="ui fluid icon input">
                    <input type="text" name="event" placeholder="Search events">
                    <i class="blue search icon"></i>
                </div>
            </form>

            <div class="ui middle aligned animated divided list">
                <div class="item">
                    <div class="ui basic segment">
                        <h4 class="header">Event Name #1</h4>
                        <p>Date & Time</p>
                        <a href="admin-event-detail">Edit</a>
                    </div>
                </div>
                <div class="item">
                    <div class="ui basic segment">
                        <h4 class="header">Event Name #2</h4>
                        <p>Date & Time</p>
                        <a href="admin-event-detail">Edit</a>
                    </div>
                </div>
            </div>

            <div class="ui horizontal segments">
                <div class="ui teal left aligned segment">
                    <a href="#"><i class="arrow circle outline left icon"></i> Previous</a>
                </div>
                <div class="ui teal center aligned segment">
                    <p>1 of 10</p>
                </div>
                <div class="ui teal right aligned segment">
                    <a href="">Next <i class="arrow circle outline right icon"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection