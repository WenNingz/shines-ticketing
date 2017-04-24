@extends('master')

@section('title', 'Reset Password')

@section('navbar')
    @include('guest.navbar')
@endsection

@section('content')
    @include('layout.flash')
    <div class="ui centered grid">
        <div class="thirteen wide mobile nine wide tablet five wide computer five wide large screen column">
            <form method="POST" action="/reset-password"
                  class="ui form center aligned padded segment @if(sizeof($errors->all()) > 0)) error @endif">
                <h2 class="ui teal center aligned header">Reset Password</h2>
                <div class="ui clearing divider"></div>

                {{ csrf_field() }}

                @include('layout.errors')

                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="email" placeholder="E-mail address" value="{{ old('email') }}">
                    </div>
                </div>

                <button type="submit" class="ui fluid teal basic submit button">Send Password Reset Link</button>
            </form>
        </div>
    </div>

    <script>
        $('.ui.form')
            .form({
                fields: {
                    email: {
                        identifier: 'email',
                        rules: [
                            {
                                type: 'email',
                                prompt: 'The email must be a valid email address.'
                            }
                        ]
                    }
                }
            });
    </script>
@endsection