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
                            <input type="text" name="title" placeholder="A brief of your issue ticket">
                        </div>
                        <div class="field">
                            <label>Message</label>
                            <textarea name="message" placeholder="Describe your issue here in details" rows="6"></textarea>
                        </div>
                        <a href='/my-tickets' class="ui basic black button">Back</a>
                        <button type="submit" class="ui basic blue button">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.ui.form')
            .form({
                fields: {
                    title: {
                        identifier: 'title',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'The title field is required.'
                            }
                        ]
                    },
                    message: {
                        identifier: 'message',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'The message field is required.'
                            }
                        ]
                    }
                }
            });
    </script>
@endsection