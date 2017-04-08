@extends('master')

@section('title', 'Change Password')

@section('navbar')
    @include('admin.common.navbar')
@endsection

@section('content')
    <div class="ui centered grid">
        <div class="thirteen wide mobile nine wide tablet five wide computer five wide large screen column">
            <form method="POST" action="/setup" onsubmit="$('.ui.submit.button').prop('disabled', true)"
                  class="ui form center aligned padded segment @if(sizeof($errors->all()) > 0)) error @endif">
                <h1 class="ui teal center aligned header">Change Password</h1>
                <div class="ui clearing divider"></div>

                {{ csrf_field() }}

                @include('layout.errors')

                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                </div>

                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password_confirmation" placeholder="Confirm password">
                    </div>
                </div>

                <button class="ui fluid teal basic submit button">Submit</button>
            </form>
        </div>
    </div>

    <script>
        $('.ui.form')
            .form({
                fields: {
                    password: {
                        identifier: 'password',
                        rules: [
                            {
                                type: 'minLength[8]',
                                prompt: 'The password must be at least 8 characters.'
                            }
                        ]
                    },
                    password_confirmation: {
                        identifier: 'password_confirmation',
                        rules: [
                            {
                                type: 'match[password]',
                                prompt: 'The password confirmation does not match.'
                            }
                        ]
                    }
                },
                onFailure: function () {
                    $('.ui.submit.button').prop('disabled', false);
                    return false;
                }
            });
    </script>
@endsection