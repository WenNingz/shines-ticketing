@extends('master')

@section('title', 'Edit Profile')

@section('navbar')
    @include('super-admin.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile three wide tablet three wide computer three wide large screen column">
            <div class="ui fluid secondary vertical menu">
                @include('super-admin.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile thirteen wide tablet thirteen wide computer thirteen wide large screen column">
            <h3 class="ui teal dividing header">
                Account Information
            </h3>

            <div class="ui stackable grid">
                <div class="sixteen wide mobile fourteen wide tablet twelve wide computer twelve wide large screen column">
                    <form method="GET" action="admin-profile" class="ui form">
                        <h4 class="ui dividing header">
                            Basic Information
                        </h4>

                        <label>Name</label>
                        <div class="two fields">
                            <div class="field">
                                <input type="text" name="first-name" placeholder="First Name" value="Admin">
                            </div>
                            <div class="field">
                                <input type="text" name="last-name" placeholder="Last Name" value="#1">
                            </div>
                        </div>

                        <label>Email</label>
                        <div class="field">
                            <input type="text" name="email" placeholder="E-mail" value="attendee#1@google.com">
                        </div>

                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" tabindex="0" class="hidden">
                                <label>Subscribe Newsletter</label>
                            </div>
                        </div>

                        <div class="fields">
                            <div class="two wide field">
                                <div class="ui fluid basic red button">Cancel</div>
                            </div>  &nbsp;
                            <div class="two wide field">
                                <div class="ui fluid basic teal button">Save</div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection