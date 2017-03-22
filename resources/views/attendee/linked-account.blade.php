@extends('master')

@section('title', 'Link Account')

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
                            Linked Account
                        </h4>

                        <table class="ui very basic table">
                            <tbody>
                            <tr>
                                <td><i class="large teal check circle outline icon"></i></td>
                                <td>Google+</td>
                                <td class="right aligned"><a href="https://plus.google.com/">Connected</a></td>
                            </tr>
                            <tr>
                                <td><i class="large red remove circle outline icon"></i></td>
                                <td>Facebook</td>
                                <td class="right aligned"><a href="https://www.facebook.com/">Connect</a></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection