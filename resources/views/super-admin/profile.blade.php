@extends('master')

@section('title', 'Edit Profile')

@section('navbar')
    @include('super-admin.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile five wide tablet three wide computer three wide large screen column">
            <div class="ui teal fluid secondary vertical menu">
                @include('super-admin.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile eleven wide tablet thirteen wide computer thirteen wide large screen column">
            <h3 class="ui teal dividing header">
                Account Information
            </h3>

            <div class="ui stackable grid">
                <div class="sixteen wide mobile fourteen wide tablet ten wide computer ten wide large screen column">
                    <form method="POST" action="/profile" onsubmit="$('.ui.submit.button').prop('disabled', true)"
                          class="ui form @if(sizeof($errors->all()) > 0)) error @endif
                          @if (session('status')) success @endif">
                        <h4 class="ui dividing header">
                            Basic Information
                        </h4>
                        {{ csrf_field() }}

                        @include('layout.errors')
                        @include('layout.success')

                        <div class="field">
                            <div class="two fields">
                                <div class="required field">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" placeholder="First Name"
                                           value="{{ $user->first_name }}">
                                </div>
                                <div class="field">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" placeholder="Last Name"
                                           value="{{ $user->last_name }}">
                                </div>
                            </div>
                        </div>

                        <div class="required field">
                            <label>Email</label>
                            <input type="text" name="email" placeholder="E-mail" value="{{ $user->email }}">
                        </div>

                        <div class="required field">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Password">
                        </div>

                        <div class="fields">
                            <div class="two wide field">
                                <button type="reset" class="ui fluid mini basic red button">Cancel</button>
                            </div> &nbsp;
                            <div class="two wide field">
                                <button type="submit" class="ui fluid mini basic blue submit button">Save</button>
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
                    first_name: {
                        identifier: 'first_name',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'The first name field is required.'
                            }]
                    },
                    email: {
                        identifier: 'email',
                        rules: [
                            {
                                type: 'email',
                                prompt: 'The email must be a valid email address.'
                            }]
                    },
                    password: {
                        identifier: 'password',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'The password field is required.'
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