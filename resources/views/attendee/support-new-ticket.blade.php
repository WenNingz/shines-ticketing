@extends('master')

@section('title', 'All Events')

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
                New Ticket
            </h3>

            <form method="GET" action="support-ticket" class="ui form">
                <div class="ten wide field">
                    <label>Title</label>
                    <input type="text" name="title" placeholder="Title">
                </div>
                <div class="ten wide field">
                    <label>Message</label>
                    <textarea placeholder="Message" rows="6"></textarea>
                </div>
                <button class="ui basic teal button" type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection