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
                <div class="sixteen wide mobile fourteen wide tablet twelve wide computer twelve wide large screen column">
                    <form method="GET" action="profile" class="ui form">
                        <h4 class="ui dividing header">
                            Change Password
                        </h4>

                        <label>Current Password</label>
                        <div class="six wide field">
                            <input type="text" name="currentPassword" placeholder="Current Password">
                        </div>

                        <label>New Password</label>
                        <div class="six wide field">
                            <input type="text" name="newPassword" placeholder="New Password">
                        </div>

                        <label>Verify Password</label>
                        <div class="six wide field">
                            <input type="text" name="newPassword" placeholder="Verify Password">
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