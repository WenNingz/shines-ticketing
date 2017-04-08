@extends('master')

@section('title', 'Edit Profile')

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
                Account Information
            </h3>

            <div class="ui stackable grid">
                <div class="sixteen wide mobile fourteen wide tablet twelve wide computer twelve wide large screen column">
                    <form method="POST" action="/profile" onsubmit="$('.ui.submit.button').prop('disabled', true)"
                          class="ui form @if(sizeof($errors->all()) > 0)) error @endif
                          @if (session('status')) success @endif">
                        <h4 class="ui dividing header">
                            Basic Information
                        </h4>
                        {{ csrf_field() }}

                        @include('layout.errors')
                        @include('layout.success')

                        <label>Name</label>
                        <div class="two fields">
                            <div class="field">
                                <input type="text" name="first_name" placeholder="First Name"
                                       value="{{ $user->first_name }}">
                            </div>
                            <div class="field">
                                <input type="text" name="last_name" placeholder="Last Name"
                                       value="{{ $user->last_name }}">
                            </div>
                        </div>

                        <label>Email</label>
                        <div class="field">
                            <input type="text" name="email" placeholder="E-mail" value="{{ $user->email }}">
                        </div>

                        <label>Password</label>
                        <div class="field">
                            <input type="password" name="password" placeholder="Password">
                        </div>

                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" tabindex="0" class="hidden">
                                <label>Subscribe Newsletter</label>
                            </div>
                        </div>

                        <div class="fields">
                            <div class="two wide field">
                                <button type="reset" class="ui fluid small basic red button">Cancel</button>
                            </div> &nbsp;
                            <div class="two wide field">
                                <button type="submit" class="ui fluid small basic blue submit button">Save</button>
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