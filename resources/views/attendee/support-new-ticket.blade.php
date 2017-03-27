@extends('master')

@section('title', 'New Ticket')

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

            <div class="ui stackable grid">
                <div class="sixteen wide mobile fourteen wide tablet twelve wide computer twelve wide large screen column">
                    <form method="POST" action="/new-ticket" class="ui form @if(sizeof($errors) > 0) error @endif">
                        <h4 class="ui dividing header">
                            Please provide details issue
                        </h4>
                        {{ csrf_field() }}

                        @include('layout.errors')
                        <div class="field">
                            <label>Title</label>
                            <input type="text" name="title" placeholder="Title">
                        </div>
                        <div class="field">
                            <label>Message</label>
                            <textarea name="message" placeholder="Message" rows="6"></textarea>
                        </div>
                        <button type="submit" class="ui basic blue button">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

    </script>
@endsection