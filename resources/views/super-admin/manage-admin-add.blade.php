@extends('master')

@section('title', 'Add Admin')

@section('navbar')
    @include('super-admin.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile five wide tablet three wide computer three wide large screen column">
            <div class="ui fluid secondary vertical menu">
                @include('super-admin.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile eleven wide tablet thirteen wide computer thirteen wide large screen column">
            <h3 class="ui teal dividing header">
                Manage Users
            </h3>

            <div class="ui stackable grid">
                <div class="sixteen wide mobile fourteen wide tablet twelve wide computer twelve wide large screen column">
                    <form method="post" action="/add-admin" onsubmit="$('.ui.submit.button').prop('disabled', true)"
                          class="ui form @if(sizeof($errors->all()) > 0)) error @endif">
                        <h4 class="ui dividing header">
                            Add Admin
                        </h4>
                        {{ csrf_field() }}

                        @include('layout.errors')

                        <div class="two fields">
                            <div class="required field">
                                <label>First Name</label>
                                <input type="text" name="first_name" placeholder="First Name">
                            </div>
                            <div class="field">
                                <label>Last Name</label>
                                <input type="text" name="last_name" placeholder="Last Name">
                            </div>
                        </div>

                        <div class="required field">
                            <label>E-mail</label>
                            <input type="text" name="email" placeholder="E-mail">
                        </div>
                        <div class="two wide field">
                            <button class="ui fluid basic mini blue submit button">Add</button>
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
                    }
                },
                onFailure: function () {
                    $('.ui.submit.button').prop('disabled', false);
                    return false;
                }
            });
    </script>
@endsection