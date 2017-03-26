@extends('master')

@section('title', 'Change Password')

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
                Account Information
            </h3>

            <div class="ui stackable grid">
                <div class="sixteen wide mobile fourteen wide tablet six wide computer six wide large screen column">
                    <form method="POST" action="/change-password"
                          class="ui form @if(sizeof($errors->all()) > 0)) error @endif @if(session('status')) success @endif">
                        <h4 class="ui dividing header">
                            Change Password
                        </h4>
                        {{ csrf_field() }}
                        @include('layout.errors')
                        @include('layout.success')

                        <div class="field">
                            <label>Current Password</label>
                            <input type="password" name="current_password" placeholder="Current Password">
                        </div>

                        <div class="field">
                            <label>New Password</label>
                            <input type="password" name="password" placeholder="New Password">
                        </div>

                        <div class="field">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" placeholder="Confirm Password">
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <button type="reset" class="ui fluid basic red button">Cancel</button>
                            </div> &nbsp;
                            <div class="four wide field">
                                <button type="submit" class="ui fluid basic teal button">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.ui.form')
            .form({
                fields: {
                    current_password: {
                        identifier: 'current_password',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'The current password field is required.'
                            }
                        ]
                    },
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
                }
            });
    </script>
@endsection