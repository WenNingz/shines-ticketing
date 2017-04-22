@extends('master')

@section('title', 'Support - Contact Us')

@section('navbar')
    @if(auth()->check())
        @if(auth()->user()->hasRole('super-admin'))
            @include('super-admin.common.navbar')
        @elseif(auth()->user()->hasRole('admin'))
            @include('admin.common.navbar')
        @elseif(auth()->user()->hasRole('attendee'))
            @include('attendee.common.navbar')
        @endif
    @else
        @include('guest.navbar')
    @endif
@endsection

@section('content')
    <div class="ui text container">
        <div class="ui padded centered grid">
            <div class="row"></div>
            <div class="row">
                <div class="sixteen wide mobile sixteen wide tablet ten wide computer ten wide large screen column">
                    <form method='GET' action='/support' class="ui form errors"
                          onsubmit="$('.ui.submit.button').prop('disabled', true)">
                        <div class="ui huge header">Contact Us</div>
                        <div class="ui divider"></div>
                        {{ csrf_field() }}

                        @include('layout.errors')
                        <div class="required field">
                            <label>Your Email Address</label>
                            <input type="email" name="email" placeholder="Email address">
                        </div>
                        <div class="required field">
                            <label>Title</label>
                            <input type="text" name="title" placeholder="A brief of your request">
                        </div>
                        <div class="field">
                            <label>Description</label>
                            <textarea rows='3' name="description" placeholder="Describe request in details"></textarea>
                        </div>
                        <div class="field">
                            <button type="submit" name="submit" class="ui mini basic blue submit button">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row"></div>
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
                    email: {
                        identifier: 'email',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'The email field is required.'
                            }
                        ]
                    }
                },
                onFailure: function () {
                    $('.ui.submit.button').prop('disabled', false);
                    return false;
                }
            });

        $('#select')
            .dropdown();
        ;
    </script>
@endsection
@section('footer')
    @include('guest.footer')
@endsection